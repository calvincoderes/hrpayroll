<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  required={"id", "name"}
 * )
 */
class UserGroups extends Model
{
    /**
     * @SWG\Property(
     *  property="id",
     *  type="integer",
     *  example=1
     * )
     */

    protected $casts = ['id' => 'integer'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $table = 'user_groups';
}
