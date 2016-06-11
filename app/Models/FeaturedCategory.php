<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FeaturedCategory extends Model {

	use SoftDeletes;

	protected $table = 'featured_category';

	protected $dates = ['deleted_at'];

}