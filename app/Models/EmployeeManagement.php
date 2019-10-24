<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EmployeeManagement extends Model {

	use SoftDeletes;

	protected $table = 'users';

	protected $dates = ['deleted_at'];

}