<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Stock\Change;

interface InterfaceStockChangeService
{
    /**
     * 设置附加参数.
     */
    public function setParams(array $data): static;

    /**
     * 创建操作.
     * @param array $user 用户
     * @param int $relationId 关联业务ID
     * @param string $remark 备注
     */
    public function created(array $user, int $relationId, string $remark = ''): void;

    /**
     * 修改操作.
     * @param array $user 用户
     * @param int $relationId 关联业务ID
     * @param string $remark 备注
     */
    public function updated(array $user, int $relationId, string $remark = ''): void;

    /**
     * 恢复操作.
     * @param array $user 用户
     * @param int $relationId 关联业务ID
     */
    public function recovery(array $user, int $relationId): void;

    /**
     * 完成操作.
     * @param array $user 用户
     * @param int $relationId 关联业务ID
     * @param string $remark 备注
     */
    public function completed(array $user, int $relationId, string $remark = ''): void;
}
