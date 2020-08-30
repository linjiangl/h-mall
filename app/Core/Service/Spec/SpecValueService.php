<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Spec;

use App\Constants\Message\ProductMessage;
use App\Core\Dao\Product\ProductSkuSpecValueDao;
use App\Core\Dao\Spec\SpecValueDao;
use App\Core\Service\AbstractService;
use App\Exception\InternalException;
use Carbon\Carbon;

class SpecValueService extends AbstractService
{
    protected $dao = SpecValueDao::class;

    public function remove(int $id): bool
    {
        $productSkuSpecValueDao = new ProductSkuSpecValueDao();
        if ($productSkuSpecValueDao->checkSpecValueIdHasProduct($id)) {
            throw new InternalException(ProductMessage::getMessage(ProductMessage::CHECK_SPEC_VALUE_ID_HAS_PRODUCT));
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
        $now = Carbon::now()->toDateTimeString();
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
