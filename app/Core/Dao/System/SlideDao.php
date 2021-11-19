<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Slide;
use Hyperf\Database\Model\Model;

class SlideDao extends AbstractDao
{
    protected string|Model $model = Slide::class;

    protected string $notFoundMessage = '幻灯片不存在或已删除';
}
