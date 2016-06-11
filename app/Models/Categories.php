<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

	use SoftDeletes;

	protected $table = 'categories';

	protected $dates = ['deleted_at'];

}