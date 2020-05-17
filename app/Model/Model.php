<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

abstract class Model extends BaseModel implements CacheableInterface
{
    use Cacheable;
}
