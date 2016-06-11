<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model {

	use SoftDeletes;

	protected $table = 'sizes';

	protected $dates = ['deleted_at'];

}