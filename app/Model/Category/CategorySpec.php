<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Category;

use App\Model\Spec\Spec;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property int $spec_id
 * @property-read Spec $spec
 */
class CategorySpec extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_spec';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'category_id', 'spec_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'category_id' => 'integer', 'spec_id' => 'integer'];

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }
}