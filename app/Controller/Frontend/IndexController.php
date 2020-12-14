<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend;

use App\Controller\FrontendController;
use App\Core\Block\Frontend\IndexBlock;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class IndexController extends FrontendController
{
    protected function block(): IndexBlock
    {
        return new IndexBlock();
    }
}
