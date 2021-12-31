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
use App\Core\Block\BaseBlock;

class AuthorizeController extends BackendController
{
    /**
     * 获取管理员信息.
     */
    public function info(): array
    {
        return $this->getBlock()->info();
    }

    protected function setBlock(): AuthorizeBlock
    {
        return new AuthorizeBlock();
    }

    /**
     * @return AuthorizeBlock
     */
    protected function getBlock(): BaseBlock
    {
        return parent::getBlock();
    }
}
