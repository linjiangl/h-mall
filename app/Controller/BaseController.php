<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use App\Constants\BlockSinceConstants;
use App\Core\Block\BaseBlock;

class BaseController extends AbstractController
{
    /**
     *  分页列表.
     */
    public function paginate(): array
    {
        return $this->getBlock()->paginate();
    }

    /**
     *  普通列表.
     */
    public function list(): array
    {
        return $this->getBlock()->list();
    }

    /**
     * 详情.
     */
    public function info(): array
    {
        return $this->getBlock()->info();
    }

    /**
     * 创建.
     */
    public function create(): mixed
    {
        return $this->getBlock()->create();
    }

    /**
     * 修改.
     */
    public function update(): mixed
    {
        return $this->getBlock()->update();
    }

    /**
     * 删除.
     */
    public function remove(): bool
    {
        return $this->getBlock()->delete();
    }

    /**
     * 批量删除.
     */
    public function batchRemove(): bool
    {
        return $this->getBlock()->batchDelete();
    }

    protected function setBlock(): BaseBlock
    {
        return new BaseBlock();
    }

    protected function getBlock(): BaseBlock
    {
        return $this->setBlock()->setSince(BlockSinceConstants::SINCE_FRONTEND);
    }
}
