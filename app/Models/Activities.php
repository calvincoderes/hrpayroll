<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model {

	use SoftDeletes;

	protected $table = 'activities';

	protected $dates = ['deleted_at'];

}