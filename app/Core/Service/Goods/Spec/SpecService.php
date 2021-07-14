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
use App\Core\Dao\Goods\Category\CategorySpecDao;
use App\Core\Dao\Goods\GoodsSkuSpecValueDao;
use App\Core\Dao\Goods\Spec\SpecDao;
use App\Core\Service\AbstractService;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use Throwable;

class SpecService extends AbstractService
{
    protected string $dao = SpecDao::class;

    public function create(array $data): int
    {
        try {
            // 创建规格
            $id = parent::create($data);

            // 保存规格值
            if (! empty($data['spec_values'])) {
                $specValues = is_array($data['spec_values']) ? $data['spec_values'] : explode(',', $data['spec_values']);
                $specValueService = new SpecValueService();
                $specValueService->createSpecValues($id, $specValues);
            }

            return $id;
        } catch (Throwable $e) {
            write_logs('创建失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function update(int $id, array $data): array
    {
        try {
            // 修改规格
            $spec = parent::update($id, $data);

            // 保存规格值
            if (! empty($data['spec_values'])) {
                $specValues = is_array($data['spec_values']) ? $data['spec_values'] : explode(',', $data['spec_values']);
                $specValueService = new SpecValueService();
                $specValueService->updateSpecValues($spec, $specValues);
            }

            return $spec;
        } catch (Throwable $e) {
            write_logs('保存失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function remove(int $id): bool
    {
        $categorySpecDao = new CategorySpecDao();
        if ($categorySpecDao->checkSpecIdHasCategory($id)) {
            throw new InternalException(GoodsMessage::getMessage(GoodsMessage::CHECK_SPEC_ID_HAS_GOODS));
        }

        $skuSpecValueDao = new GoodsSkuSpecValueDao();
        if ($skuSpecValueDao->checkSpecIdHasGoods($id)) {
            throw new InternalException(GoodsMessage::getMessage(GoodsMessage::CHECK_SPEC_ID_HAS_GOODS));
        }

        try {
            // 删除规格值
            $specValueService = new SpecValueService();
            $specValueService->removeBySpecId($id);

            // 删除规格
            return parent::remove($id);
        } catch (Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }
}
