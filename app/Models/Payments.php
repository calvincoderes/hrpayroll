<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model {

	use SoftDeletes;

	protected $table = 'payments';

	protected $dates = ['deleted_at'];

}