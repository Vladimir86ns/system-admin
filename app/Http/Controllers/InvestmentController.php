<?php

namespace App\Http\Controllers;

use App\User;
use Redirect;
use Sentinel;
use App\Investment;
use Illuminate\Http\Request;
use App\Http\Requests\InvestorRequest;
use App\Http\Controllers\JoshController;
use App\Services\Investment\InvestmentValidationService;

class InvestmentController extends JoshController
{
    const USER_INVESTOR_ROLE = 'Investor';

    /**
     * @var InvestmentValidationService
     */
    protected $investmentValidationService;

    /**
     * InvestmentController
     *
     */
	public function __construct(
        InvestmentValidationService $investmentValidationService
    ) {
		$this->investmentValidationService = $investmentValidationService;
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

        $available = $this->investmentValidationService->isEmailAvailable($request->get('email'));

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        //
    }
}
