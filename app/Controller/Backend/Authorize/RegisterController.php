<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Block\Backend\Authorize\RegisterBlock;
use App\Controller\AbstractController;
use App\Request\Backend\Authorize\RegisterRequest;

class RegisterController extends AbstractController
{
    /**
     * 注册
     * @param RegisterRequest $request
     * @return array
     */
    public function index(RegisterRequest $request)
    {
        $request->validated();
        return (new RegisterBlock())->index($request->post());
    }
}
