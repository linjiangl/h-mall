<?php

declare (strict_types=1);
namespace App\Model\Message;

use Hyperf\DbConnection\Model\Model;
/**
 * @property \Carbon\Carbon $created_at 
 * @property string $deleted_at 
 * @property int $id 
 * @property int $message_id 
 * @property int $status 
 * @property \Carbon\Carbon $updated_at 
 * @property int $user_id 
 */
class MessageReceiver extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_receiver';
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
    protected $casts = ['created_at' => 'datetime', 'id' => 'int', 'message_id' => 'integer', 'status' => 'integer', 'updated_at' => 'datetime', 'user_id' => 'integer'];
}