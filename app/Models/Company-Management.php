<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company-Management extends Model {

	use SoftDeletes;

	protected $table = 'company-management';

	protected $dates = ['deleted_at'];

}