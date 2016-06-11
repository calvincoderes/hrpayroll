<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	use SoftDeletes;

	protected $table = 'products';

	protected $dates = ['deleted_at'];

}