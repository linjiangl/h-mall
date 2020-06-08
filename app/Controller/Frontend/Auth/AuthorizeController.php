<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Auth;

use App\Block\Frontend\Auth\AuthorizeBlock;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Contract\RequestInterface;

class AuthorizeController extends AbstractController
{
    public function index(RequestInterface $request)
    {
        $block = new AuthorizeBlock();
        return $block->index($request);
    }
}
