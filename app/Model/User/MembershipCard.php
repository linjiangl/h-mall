<?php

declare (strict_types=1);
namespace App\Model\User;

use Hyperf\DbConnection\Model\Model;
/**
 * @property \Carbon\Carbon $created_at 
 * @property int $current_exp 
 * @property int $grade 
 * @property string $id_card 
 * @property string $mobile 
 * @property string $password 
 * @property string $real_name 
 * @property string $serial_no 
 * @property int $status 
 * @property int $total_exp 
 * @property \Carbon\Carbon $updated_at 
 * @property int $user_id 
 */
class MembershipCard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'membership_card';
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
    protected $casts = ['created_at' => 'datetime', 'current_exp' => 'integer', 'grade' => 'integer', 'status' => 'integer', 'total_exp' => 'integer', 'updated_at' => 'datetime', 'user_id' => 'integer'];
}