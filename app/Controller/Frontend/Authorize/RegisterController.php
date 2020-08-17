<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Controller\AbstractController;
use App\Core\Block\Frontend\Authorize\RegisterBlock;
use App\Request\Frontend\Authorize\RegisterRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class RegisterController extends AbstractController
{
    public function index(RegisterRequest $request)
    {
        $request->validated();
        return (new RegisterBlock())->index($request->post());
    }
}
