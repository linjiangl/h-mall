<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Spec;

use App\Constants\Message\GoodsMessage;
use App\Core\Dao\Goods\GoodsSkuSpecValueDao;
use App\Core\Dao\Goods\Spec\SpecValueDao;
use App\Core\Service\AbstractService;
use App\Exception\InternalException;

class SpecValueService extends AbstractService
{
    protected string $dao = SpecValueDao::class;

    protected bool $softDelete = false;

    public function getListBySpecId(int $specId): array
    {
        $dao = new SpecValueDao();
        return $dao->getListBySpecId($specId);
    }

    public function remove(int $id): bool
    {
        $goodsSkuSpecValueDao = new GoodsSkuSpecValueDao();
        if ($goodsSkuSpecValueDao->checkSpecValueIdHasGoods($id)) {
            throw new InternalException(GoodsMessage::getMessage(GoodsMessage::CHECK_SPEC_VALUE_ID_HAS_GOODS));
        }

        return parent::remove($id);
    }

    /**
     * 创建规格值
     * @param int $specId
     * @param array $specValues
     */
    public function createSpecValues(int $specId, array $specValues): void
    {
        $now = time();
        $insert = [];
        foreach ($specValues as $item) {
            $insert[] = [
                'spec_id' => $specId,
                'value' => $item,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        $this->batchInsert($insert);
    }

    /**
     * 更新规格值
     * @param array $spec
     * @param array $specValues
     */
    public function updateSpecValues(array $spec, array $specValues)
    {
        $dao = new SpecValueDao();
        $oldSpecValues = $dao->getListBySpecId($spec['id']);
        $oldValues = array_column($oldSpecValues, 'value');

        // 删除规格值
        $deleteValues = array_diff($oldValues, $specValues);
        if (count($deleteValues)) {
            $oldSpecValuesData = array_column($oldSpecValues, 'value', 'id');
            $deleteSpecValue = array_filter($oldSpecValuesData, function ($val) use ($deleteValues) {
                return in_array($val, $deleteValues);
            });
            $dao->deleteByPrimaryKeys(array_keys($deleteSpecValue));
        }

        // 新增规格值
        $insertValues = array_diff($specValues, $oldValues);
        if (count($insertValues)) {
            $this->createSpecValues($spec['id'], $insertValues);
        }
    }

    public function removeBySpecId(int $specId): void
    {
        $dao = new SpecValueDao();
        $dao->deleteByCondition([['spec_id', '=', $specId]]);
    }
}
