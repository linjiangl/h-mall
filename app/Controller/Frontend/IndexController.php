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

use App\Block\Frontend\IndexBlock;
use App\Controller\AbstractController;
use App\Request\UserRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class IndexController extends AbstractController
{
    public function index(UserRequest $request)
    {
        $request->validated();
        return (new IndexBlock())->index($request);
    }
}
