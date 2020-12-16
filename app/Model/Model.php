<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

abstract class Model extends BaseModel implements CacheableInterface
{
    use Cacheable;

    public function getUpdatedAtColumn(): ?string
    {
        return 'updated_time';
    }

    protected function updateTimestamps()
    {
        if (! $this->isDirty('updated_time')) {
            $this->updated_time = time();
        }

        if (! $this->exists && ! $this->isDirty('created_time')) {
            $this->created_time = time();
        }
    }
}
