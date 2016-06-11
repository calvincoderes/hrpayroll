<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model {

	use SoftDeletes;

	protected $table = 'draft';

	protected $dates = ['deleted_at'];

}
