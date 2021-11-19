<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\User;

use App\Controller\FrontendController;
use App\Core\Block\Common\User\UserBlock;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class UserController extends FrontendController
{
    protected function setBlock(): UserBlock
    {
        return new UserBlock();
    }
}
