<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Rentals extends Model {

	use SoftDeletes;

	protected $table = 'rentals';

	protected $dates = ['deleted_at'];

}