<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product;

use App\Constants\State\ProductState;
use App\Core\Dao\Product\ProductDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Product\Types\AbstractTypesService;
use App\Core\Service\Product\Types\CouponService;
use App\Core\Service\Product\Types\GeneralService;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use Throwable;

class ProductService extends AbstractService
{
    protected $dao = ProductDao::class;

    protected $mapClass = [
        ProductState::TYPE_GENERAL => GeneralService::class,
        ProductState::TYPE_COUPON => CouponService::class
    ];

    public function create(array $data): int
    {
        try {
            $service = $this->make($data, 0, $data['type']);
            return $service->create();
        } catch (Throwable $e) {
            write_logs('创建失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function update(int $id, array $data): array
    {
        try {
            $service = $this->make($data, $id, $data['type']);
            return $service->update();
        } catch (Throwable $e) {
            write_logs('保存失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function make(array $data, int $id = 0, string $type = ProductState::TYPE_GENERAL): AbstractTypesService
    {
        if (! in_array($type, array_keys($this->mapClass))) {
            throw new InternalException('商品类型不存在');
        }
        return new $this->mapClass[$type]($data, $id);
    }
}
