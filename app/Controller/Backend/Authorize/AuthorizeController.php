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

use App\Controller\BackendController;
use App\Core\Block\Backend\Authorize\AuthorizeBlock;
use Hyperf\HttpServer\Contract\RequestInterface;

class AuthorizeController extends BackendController
{
    /**
     * 获取管理员信息
     * @param RequestInterface $request
     * @return array
     */
    public function info(RequestInterface $request)
    {
        /** @var AuthorizeBlock $service */
        $service = $this->service();
        return $service->info($request);
    }

    protected function block()
    {
        return new AuthorizeBlock();
    }
}
