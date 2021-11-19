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
     * 获取管理员信息.
     */
    public function info(): array
    {
        /** @var AuthorizeBlock $service */
        $service = $this->getBlock();
        return $service->info();
    }

    protected function setBlock(): AuthorizeBlock
    {
        return new AuthorizeBlock();
    }
}
