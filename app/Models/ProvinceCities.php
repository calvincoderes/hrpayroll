<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *  required={"id", "name"}
 * )
 */
class ProvinceCities extends Model
{
    use SoftDeletes;

    /**
     * @SWG\Property(
     *  property="id",
     *  type="integer",
     *  example=1
     * )
     */

    protected $casts = ['id' => 'integer'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $table = 'province_cities';
}
