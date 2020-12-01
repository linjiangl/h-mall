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

    public const CREATED_AT = '';

    public function freshTimestamp()
    {
        return time();
    }

    public function fromDateTime($value)
    {
        return (string)$value;
    }

    public function getDateFormat()
    {
        return 'U';
    }
}
