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

abstract class AbstractStockChangeService implements InterfaceStockChangeService
{
    protected array $params = [];

    public function setParams(array $data): static
    {
        $this->params = $data;

        return $this;
    }

    /**
     * 创建占用记录.
     * @param string $moduleType 模块类型
     * @param array $moduleData 模块数据
     * @param array $sourceData 源数据
     * @param string $remark 备注
     */
    protected function createStockOccupy(string $moduleType, array $moduleData, array $sourceData, string $remark = ''): void
    {
    }

    /**
     * 修改占用记录.
     * @param string $moduleType 模块类型
     * @param array $moduleData 模块数据
     * @param array $sourceData 源数据
     * @param string $remark 备注
     */
    protected function updateStockOccupy(string $moduleType, array $moduleData, array $sourceData, string $remark = ''): void
    {
    }

    /**
     * 创建库存明细.
     * @param string $moduleType 模块类型
     * @param array $moduleData 模块数据
     * @param array $sourceData 源数据
     * @param string $remark 备注
     */
    protected function createStockReport(string $moduleType, array $moduleData, array $sourceData, string $remark = ''): void
    {
    }
}
