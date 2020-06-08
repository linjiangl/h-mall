<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Block\Frontend\Auth\RegisterBlock;
use App\Controller\AbstractController;
use App\Request\Frontend\Auth\RegisterRequest;

class RegisterController extends AbstractController
{
    public function index(RegisterRequest $request)
    {
        $block = new RegisterBlock();
        return $block->index($request);
    }
}
