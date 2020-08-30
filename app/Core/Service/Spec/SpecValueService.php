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
        $install = [];
        foreach ($specValues as $item) {
            $install[] = [
                'spec_id' => $specId,
                'value' => $item,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        $dao = new SpecValueDao();
        $dao->batchInsert($install);
    }

    /**
     * 更新规格值
     * @param int $specId
     * @param array $specValues
     */
    public function updateSpecValues(int $specId, array $specValues)
    {
        $dao = new SpecValueDao();
        $oldSpecValues = $dao->getListBySpecId($specId);
        $oldValues = array_column($oldSpecValues, 'value');

        // 删除规格值
        $deleteValues = array_diff($oldValues, $specValues);
        if (! empty($deleteValues)) {
            $oldSpecValuesData = array_column($oldSpecValues, 'value', 'id');
            $deleteSpecValueIds = array_filter($oldSpecValuesData, function ($val) use ($deleteValues) {
                return in_array($val, $deleteValues);
            });
            $dao->deleteByPrimaryKeys($deleteSpecValueIds);
        }

        // 新增规格值
        $installValues = array_diff($specValues, $oldValues);
        if (! empty($installValues)) {
            $this->createSpecValues($specId, $installValues);
        }
    }

    public function removeBySpecId(int $specId): void
    {
        $dao = new SpecValueDao();
        $dao->deleteByCondition([['spec_id', '=', $specId]]);
    }
}
