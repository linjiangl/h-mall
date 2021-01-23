<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods;

use App\Constants\State\Goods\GoodsState;
use App\Core\Dao\Goods\GoodsDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Goods\Types\AbstractTypesService;
use App\Core\Service\Goods\Types\VirtualService;
use App\Core\Service\Goods\Types\GeneralService;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use Throwable;

class GoodsService extends AbstractService
{
    protected string $dao = GoodsDao::class;

    protected array $mapClass = [
        GoodsState::TYPE_GENERAL => GeneralService::class,
        GoodsState::TYPE_VIRTUAL => VirtualService::class
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
            $service = $this->make($data, $id, $data['type'] ?? GoodsState::TYPE_GENERAL);
            return $service->update();
        } catch (Throwable $e) {
            write_logs('保存失败', $data);
            throw new BadRequestException($e->getMessage(), $e->getCode());
        }
    }

    public function make(array $data, int $id = 0, string $type = GoodsState::TYPE_GENERAL): AbstractTypesService
    {
        if (! in_array($type, array_keys($this->mapClass))) {
            throw new InternalException('商品类型不存在');
        }
        return new $this->mapClass[$type]($data, $id);
    }
}
