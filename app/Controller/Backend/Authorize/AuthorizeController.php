<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Controller\BackendController;
use App\Core\Block\Backend\Authorize\AuthorizeBlock;

class AuthorizeController extends BackendController
{
    /**
     * 获取管理员信息
     * @return array
     */
    public function show(): array
    {
        /** @var AuthorizeBlock $service */
        $service = $this->service();
        return $service->show();
    }

    protected function block(): AuthorizeBlock
    {
        return new AuthorizeBlock();
    }
}
