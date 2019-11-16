<?php

declare (strict_types=1);
namespace App\Model\Message;

use Hyperf\DbConnection\Model\Model;
/**
 * @property string $content 
 * @property int $id 
 * @property string $title 
 */
class MessageText extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_text';
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
    protected $casts = ['id' => 'int'];
}