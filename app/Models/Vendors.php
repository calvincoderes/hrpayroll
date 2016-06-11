<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Vendors extends Model {

	use SoftDeletes;

	protected $table = 'vendors';

	protected $dates = ['deleted_at'];

}