<?php

namespace App\Http\Controllers;

use App\User;
use Redirect;
use Sentinel;
use Charts;
use App\Investment;
use Illuminate\Http\Request;
use App\Http\Requests\InvestorRequest;
use App\Http\Controllers\JoshController;
use App\Services\Investment\InvestmentService;
use App\Services\Investment\InvestmentValidationService;

class InvestmentController extends JoshController
{
    const USER_INVESTOR_ROLE = 'Investor';

    /**
     * @var InvestmentValidationService
     */
    protected $validationService;

    /**
     * @var InvestmentService
     */
    protected $service;

    /**
     * InvestmentController
     *
     */
	public function __construct(
        InvestmentValidationService $investmentValidationService,
        InvestmentService $investmentService
    ) {
        $this->validationService = $investmentValidationService;
        $this->service = $investmentService;
	}

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignIn()
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return redirect::route('investor-dashboard');
        }

        // Show the page
        return view('investor.login');
    }


    /**
     * Account sign in form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postSignIn(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return view('investor.login')->with('error', 'Your email or password are not correct!');
        }

        try {
            // Try to log the user in
            if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {
                // Redirect to the dashboard page
                return Redirect::route("investor-dashboard")->with('success', trans('auth/message.signin.success'));
            }

            $this->messageBag->add('email', trans('auth/message.account_not_found'));

        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_activated'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', trans('auth/message.account_suspended', compact('delay')));
        }
    }

    public function showHome()
    {
        if(Sentinel::check())
			return view('investor.index');
		else
			return view('investor.login')->with('error', 'You must be logged in!');
    }

    /**
     * Account investor sign up form processing.
     *
     * @return Redirect
     */
    public function postSignup(InvestorRequest $request)
    {
        $user = Sentinel::authenticate($request->only(['email', 'password']));

        if ($user) {
            $permissions = $user->permissions;

            $permissions['investor'] = 1;
            $user->permissions = $permissions;
            $user->update();

            return Redirect::route("investor-dashboard")->with('success', trans('auth/message.signin.success'));
        }

        $available = $this->validationService->isEmailAvailable($request->get('email'));

        if ($available) {
            return view('investor.login')->with('error', trans('auth/message.account_already_exists'));
        }

        $permissions = [
            'investor' => 1,
        ];

        try {
            // Register the user as investor
            $user = Sentinel::registerAndActivate([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'permissions' => $permissions
            ]);

            //add user to 'User' group as Investor
            $role = Sentinel::findRoleById(1);
            $role->users()->attach($user);


            // Log the user in
            Sentinel::login($user, false);

            // Redirect to the dashboard page
            return Redirect::route("investor-dashboard")->with('success', trans('auth/message.signin.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }


    /**
     * Get all investments from Serbia
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSerbia()
    {
        $allInvestments = $this->service->getAllFromTransformer(Investment::SERBIA);

        // selected investment not included
        $transformedInvestment = null;

        return view('investor.find.show_all_investments', compact(['allInvestments', 'transformedInvestment']));
    }

    /**
     * Invest in ivestion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invest(Request $request, $id)
    {
        $request->validate([
            'total_investment' => 'required|numeric'
        ]);

        $attributes = $request->all();

        $investment = $this->service->updateInvestment($id, $attributes);

        return $this->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allInvestments = $this->service->getAllFromTransformer(Investment::SERBIA);

        $transformedInvestment = $this->service->getInvestmentFromTransformer($id);

        return view('investor.find.show_all_investments', compact(['allInvestments', 'transformedInvestment']));
    }

    /**
     * Display all user investments.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function getUserAllInvestments()
    {
        $allUserInvestments = $this->service->findAllUserInvestments();
        $allUserAdminInvestments = $this->service->findAllUserAdminInvestments($allUserInvestments);

        $transformedInvestments = $this->service->useInvestmentsTransformer($allUserInvestments);
        $transformedAdminInvestments = $this->service->useInvestmentsAdminTransformer($allUserAdminInvestments);

        $pie = Charts::create('pie', 'fusioncharts')
            ->title('Name of investition')
            ->labels(['Invested', 'Collected'])
            //    ->responsive(true)
            ->values([10000,54000])
            ->dimensions(0,400);

        return view('investor.show.index', compact([
            'transformedAdminInvestments',
            'transformedInvestments',
            'pie'
        ]));
    }
}
