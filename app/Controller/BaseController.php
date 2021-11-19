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
        return $this->service()->paginate();
    }

    /**
     *  普通列表.
     */
    public function list(): array
    {
        return $this->service()->list();
    }

    /**
     * 详情.
     */
    public function info(): array
    {
        return $this->service()->info();
    }

    /**
     * 创建.
     */
    public function create(): mixed
    {
        return $this->service()->create();
    }

    /**
     * 修改.
     */
    public function update(): mixed
    {
        return $this->service()->update();
    }

    /**
     * 删除.
     */
    public function remove(): bool
    {
        return $this->service()->delete();
    }

    /**
     * 批量删除.
     */
    public function batchRemove(): bool
    {
        return $this->service()->batchDelete();
    }

    protected function block(): BaseBlock
    {
        return new BaseBlock();
    }

    protected function service(): BaseBlock
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_FRONTEND);
    }
}
