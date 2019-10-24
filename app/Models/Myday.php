<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Myday extends Model {

	use SoftDeletes;

	protected $table = 'myday';

	protected $dates = ['deleted_at'];

}