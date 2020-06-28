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

use App\Block\Frontend\Authorize\RegisterBlock;
use App\Controller\AbstractController;
use App\Request\Frontend\Authorize\RegisterRequest;

class RegisterController extends AbstractController
{
    public function index(RegisterRequest $request)
    {
        return (new RegisterBlock())->index($request);
    }
}
