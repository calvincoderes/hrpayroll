<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $current_user;
    
    
    
    public function __construct(){
    	
    	$users = new \App\Models\Users;
    	
    	$this->current_user = $users->where('OAUTH_USER_id', \Auth::user()->id)->first();
    	
    }
}
