<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property string $avatar 
 * @property \Carbon\Carbon $created_at 
 * @property string $email 
 * @property int $id 
 * @property string $lasted_login_at 
 * @property string $mobile 
 * @property string $nickname 
 * @property string $password 
 * @property int $role 
 * @property string $salt 
 * @property int $sex 
 * @property int $status 
 * @property \Carbon\Carbon $updated_at 
 * @property string $username 
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'datetime', 'id' => 'int', 'role' => 'integer', 'sex' => 'integer', 'status' => 'integer', 'updated_at' => 'datetime'];
}