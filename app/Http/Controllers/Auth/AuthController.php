<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Users;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      //dd($data);
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required',
            'mobile_number' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
    	$userAuth;
    		
    	\DB::beginTransaction();
    	try {
    		
    	$userAuth = User::create([
    				'firstname' => $data['firstname'],
    				'lastname' => $data['lastname'],
    				'email' => $data['email'],
    				'password' => bcrypt($data['password']),
    		]);
    		
    		//CommonActions::writeHistory($this->table, $id, $action, $data_changes, $old_user_data, $comment, $data['auth_user_id']);
    	} catch (Exception $e) {
    		\DB::rollback();
    		throw $e;
    	}
    	\DB::commit();
      	
    		$oauth_user_id =  User::select('id')->where([ 'email' => $data['email'] ])->value('id');
       
     		 $this->createUsers($data,$oauth_user_id);
     		 
     		 
    	return $userAuth;
        
    }
 
    
    private function createUsers($data, $oauth_user_id){
    	
    	
    	$user_data = [
    		'OAUTH_USER_id' => $oauth_user_id,
    		'firstname' => $data['firstname'],
    		'lastname' => $data['lastname'],
    		'email' => $data['email'],
    		'status' => 'active',
    		'type_engineer' => 1,
    		'gender' => $data['gender'],
    		'civil_status' => 'single',
    		'mobile_number' => $data['mobile_number'],
    		'created_by' => $oauth_user_id, 			
    	];
    	
    	\DB::beginTransaction();
    	try {
    	
    	Users::forceCreate($user_data);
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		return $data;
    	}
    	\DB::commit();
    	
    }
}
