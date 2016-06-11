<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model {

	use SoftDeletes;

	protected $table = 'hotels';

	protected $dates = ['deleted_at'];

}