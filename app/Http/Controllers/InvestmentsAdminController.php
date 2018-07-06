<?php

namespace App\Http\Controllers;

use Sentinel;
use Redirect;
use Alert;
use App\Investment;
use App\User;
use App\InvestmentsAdmin;
use App\Services\InvestmentsAdmin\InvestmentsAdminService;
use App\Http\Requests\InvestorRequest;
use App\Http\Controllers\JoshController;
use App\Http\Requests\CreateInvestmentsRequest;
use App\Transformers\InvestmentsAdminTransformer;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager as FractalManager;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 **/
class InvestmentsAdminController extends Controller
{
    const USER_INVESTOR_ROLE = 'admin_investitions';

    /**
     * @var InvestmentsAdminTransformer
     */
    protected $investmentsAdminTransformer;

    /**
     * @var \App\Services\InvestmentsAdmin\InvestmentsAdminService
     */
    private $service;

    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * InvestmentsAdminController
     *
     * @param InvestmentsAdminService $investmentsAdminService
     * @param InvestmentsAdminTransformer $investmentsAdminTransformer
     * @param FractalManager $fractal
     */
    public function __construct(
        InvestmentsAdminService $investmentsAdminService,
        InvestmentsAdminTransformer $investmentsAdminTransformer,
        FractalManager $fractalManager
    ) {
        $this->service = $investmentsAdminService;
        $this->investmentsAdminTransformer = $investmentsAdminTransformer;
        $this->fractal = $fractalManager;
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
            return redirect::route('investments-admin-dashboard');
        }

        // Show the page
        return view('investments-admin.login');
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
            return view('investments-admin.login')->with('error', 'Your email or password are not correct!');
        }

        try {
            // Try to log the user in
            if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {
                // Redirect to the dashboard page
                return Redirect::route("investments-admin-dashboard")
                    ->with('success', trans('auth/message.signin.success'));
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
        if (Sentinel::check()) {
            return view('investments-admin.index');
        } else {
            return view('investments-admin.login')->with('error', 'You must be logged in!');
        }
    }

    /**
     * Account investor sign up form processing.
     *
     * @return Redirect
     */
    public function postSignup(InvestorRequest $request)
    {
        $permissions = [
            'admin_investitions' => 1,
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
            $role = Sentinel::findRoleById(6);
            $role->users()->attach($user);


            // Log the user in
            Sentinel::login($user, false);

            // Redirect to the dashboard page
            return Redirect::route("investments-admin-dashboard")
                ->with('success', trans('auth/message.signin.success'));
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
     * Show the form for creating a new investments.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investments-admin.create_new_investments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvestmentsRequest $request)
    {
        $inputs = $request->all();

        $this->service->storeInvestments($inputs);

        return Redirect::route("investments-admin-all-investments")
            ->with('success', 'Created new investments successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();
        $editInvestment = $this->service->getInvestment($id);

        // selected investment is not included
        $transformedInvestment = null;

        return view('investments-admin.all_investments', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(CreateInvestmentsRequest $request, $id)
    {
        $inputs = $request->except(['_token', 'btnSubmit']);

        $this->service->updateInvestment($inputs, $id);

        return Redirect::route("investments-admin-all-investments")
            ->with('success', 'Updated investment successfully!');
    }

    /**
     * Display a listing of the all investments.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllInvestments()
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected and edit investment is not included
        $transformedInvestment = null;
        $editInvestment = null;

        return view('investments-admin.all_investments', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Display a listing of the all investments and selected investment.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllInvestmentsAndSelected($id)
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included
        $transformedInvestment = $this->service->getInvestmentFromTransformer($id);

        // edit investment is not included
        $editInvestment = null;

        return view('investments-admin.all_investments', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Approve investment
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function approveOrUnApproveInvestment($id)
    {
        $this->service->approveOrUnApproveInvestment($id);

        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included
        $transformedInvestment = $this->service->getInvestmentFromTransformer($id);

        // edit investment is not included
        $editInvestment = null;

        return view('investments-admin.all_investments', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Reject or delete investment
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function rejectOrDelete($id)
    {
        $this->service->rejectOrDelete($id);

        $allInvestments = $this->service->getAllInvestmentsFromTransformer();

        // selected investment is included and check is maybe deleted
        $transformedInvestment = false;
        $investment = $this->service->getInvestment($id);
        if ($investment) {
            $transformedInvestment = $this->service->getInvestmentFromTransformer($id);
        }

        // edit investment is not included
        $editInvestment = null;

        return view('investments-admin.all_investments', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            ]));
    }

    /**
     * Before confirm investments fill up with more data
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function beforeConfirm($id)
    {
        $allInvestments = $this->service->getAllInvestmentsFromTransformer();
        $editInvestment = $this->service->getInvestment($id);
        $allOwners = $this->service->getAllOwners();

        // selected investment is not included
        $transformedInvestment = null;

        return view('investments-admin.before-production.selected', compact([
            'allInvestments',
            'transformedInvestment',
            'editInvestment',
            'allOwners'
        ]));
    }

    /**
     * Confirm investment and save in project
     *
     * @param  \App\InvestmentsAdmin  $investmentsAdmin
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, $id)
    {
        $request->validate([
            'owner_id' => 'required|integer',
        ]);

        $inputs = $request->all();

        $isCreated = $this->service->createProject($inputs, $id);

        if (!$isCreated) {
            return Redirect::back()->with('error', 'This investment is already on production!');
        }

        return $this->getAllInvestments();
    }

    /**
     * Logout page and redirect to chose status.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Sentinel::logout(Sentinel::getUser());

        return Redirect::route("chose-status")->with('success', 'You have successfully logged out!');
    }
}
