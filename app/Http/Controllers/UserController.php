<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use App\User;
use Config;
use Crypt;
use App\Helpers\Helper;
use myhelper;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;
use App\Dashboard;

/**
 * UserController Class
 *
 * @package
 * @subpackage            UserController
 * @category              Controller
 * @DateOfCreation        17 August 2018
 * @ShortDescription      This class contains all the function related to user functionality
 */

class UserController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
        $this->dashboardObj = new Dashboard();
    }

    /**
     * @DateOfCreation         30 aug 2018
     * @ShortDescription       Load the login view for user
     * @return                 View
     */
    public function index()
    {
        $id=  Auth::user()->id;
        return view('user.welcome')->with($id);
    }

    /**
     * @DateOfCreation         23 Aug 2018
     * @ShortDescription       Load users view with list of all users
     * @return                 View
     */
    public function users()
    {
        /**
         *@ShortDescription Blank array for the data for sending the array to the view.
         *
         * @var Array
         */
        $data['users'] = $this->dashboardObj->queryData();
        return view('user.users', $data);
    }

    /**
     * @DateOfCreation         27 Aug 2018
     * @ShortDescription       Load user maintanence view with list of that user whoes log in
     * @return                 View
     */
    public function userrMaintenance($id, $user_id=null)
    {
    	$data['user_id'] = Crypt::decrypt($id);
        $data['user_maintenance'] = $this->dashboardObj->showUser($data['user_id']);
        return view('user.userMaintenance', $data)->with('no', Config::get('constants.S_NO'));
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       view user registration from
    * @return                 View
    */
    public function register()
    {
        return view('user.register');
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Register user from user side
    * @param Request $request [HTTP Request Object]
    * @return                 View
    */
    public function userRegister(Request $request)
    {
        $rules = array(
                    'tenant_full_name' => 'required|max:50',
                    'flat_number'     => 'required|max:50',
                    'carpet_area'     => 'required|max:50',
                    'user_email'      => 'required|string|email|max:255|unique:users',
                    'password'        => 'required|string|min:6|confirmed'
                );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            if (empty($id)) {
                $insertData = array(
                                    'tenant_full_name' => $request->input('tenant_full_name'),
                                    'flat_number'     => $request->input('flat_number'),
                                    'carpet_area'     => $request->input('carpet_area'),
                                    'user_email'      => $request->input('user_email'),
                                    'password'        => bcrypt($request->input("password")),
                                    'user_status'     => $request->input('status'),
                                    'user_role_id'    => Config::get('constants.USER_ROLE')
                                );
                $user = User::create($insertData);
                if ($user) {
                    return redirect('/')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            }
        }
    }
}
