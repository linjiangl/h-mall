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
     *  列表.
     */
    public function index(): array
    {
        return $this->service()->index();
    }

    /**
     * 详情.
     */
    public function show(): array
    {
        return $this->service()->show();
    }

    /**
     * 创建.
     */
    public function store(): mixed
    {
        return $this->service()->store();
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
    public function destroy(): bool
    {
        return $this->service()->destroy();
    }

    /**
     * 批量删除.
     */
    public function batchDestroy(): bool
    {
        return $this->service()->batchDestroy();
    }

    protected function block(): BaseBlock
    {
        return new BaseBlock();
    }

    protected function service()
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_FRONTEND);
    }
}
