<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model {

	use SoftDeletes;

	protected $table = 'holidays';

	protected $dates = ['deleted_at'];

}