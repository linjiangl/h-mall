<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Admin;

use App\Block\Backend\Admin\AdminBlock;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Contract\RequestInterface;

class AdminController extends AbstractController
{
    public function index(RequestInterface $request)
    {
        return (new AdminBlock())->index($request);
    }

    public function show(RequestInterface $request, $id)
    {
        return (new AdminBlock())->show($request, $id);
    }
}
