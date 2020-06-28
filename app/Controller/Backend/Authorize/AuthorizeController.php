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

use App\Block\Backend\Authorize\AuthorizeBlock;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Contract\RequestInterface;

class AuthorizeController extends AbstractController
{
    public function index(RequestInterface $request)
    {
        return (new AuthorizeBlock())->index($request);
    }
}
