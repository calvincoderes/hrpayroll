<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyWaivers extends Model {

	use SoftDeletes;

	protected $table = 'company_waivers';

	protected $dates = ['deleted_at'];

}