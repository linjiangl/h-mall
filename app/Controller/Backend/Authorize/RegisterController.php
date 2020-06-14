<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Block\Backend\Authorize\RegisterBlock;
use App\Controller\AbstractController;
use App\Request\Backend\Authorize\RegisterRequest;

class RegisterController extends AbstractController
{
    public function index(RegisterRequest $request)
    {
        return (new RegisterBlock())->index($request);
    }
}
