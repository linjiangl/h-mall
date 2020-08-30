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
use App\Core\Dao\Product\ProductSpecDao;
use App\Core\Dao\Spec\SpecDao;
use App\Core\Service\AbstractService;
use App\Exception\BadRequestException;
use App\Exception\InternalException;

class SpecService extends AbstractService
{
    protected $dao = SpecDao::class;

    public function create(array $data): int
    {
        try {
            // 创建规格
            $id = parent::create($data);

            // 保存规格值
            if (empty($data['spec_values'])) {
                $optionValues = is_array($data['spec_values']) ? $data['spec_values'] : explode(',', $data['spec_values']);
                $specValueService = new SpecValueService();
                $specValueService->createSpecValues($id, $optionValues);
            }

            return $id;
        } catch (\Throwable $e) {
            write_logs('规格创建失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function update(int $id, array $data): array
    {
        try {
            // 修改规格
            $option = parent::update($id, $data);

            // 保存规格值
            if (empty($data['spec_values'])) {
                $optionValues = is_array($data['spec_values']) ? $data['spec_values'] : explode(',', $data['spec_values']);
                $specValueService = new SpecValueService();
                $specValueService->updateSpecValues($id, $optionValues);
            }

            return $option;
        } catch (\Throwable $e) {
            write_logs('规格保存失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function remove(int $id): bool
    {
        $productSpecDao = new ProductSpecDao();
        if ($productSpecDao->checkSpecIdHasProduct($id)) {
            throw new InternalException(ProductMessage::getMessage(ProductMessage::CHECK_SPEC_ID_HAS_PRODUCT));
        }

        try {
            // 删除规格值
            $specValueService = new SpecValueService();
            $specValueService->removeBySpecId($id);

            // 删除规格
            return parent::remove($id);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }
}
