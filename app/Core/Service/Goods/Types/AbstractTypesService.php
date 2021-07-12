<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Types;

use App\Constants\State\Goods\GoodsState;
use App\Core\Dao\Goods\GoodsDao;
use App\Core\Dao\Goods\GoodsParameterDao;
use App\Core\Dao\Goods\GoodsTimerDao;
use App\Exception\BadRequestException;
use App\Model\Goods\Goods;
use Hyperf\DbConnection\Db;
use Throwable;

abstract class AbstractTypesService implements InterfaceTypesService
{
    /**
     * 商品id.
     */
    protected int $id = 0;

    /**
     * 表单数据.
     */
    protected array $post = [];

    /**
     * 是否是创建.
     */
    protected bool $isCreated = false;

    /**
     * 商品信息.
     */
    protected Goods $goods;

    public function __construct(array $data, int $id = 0)
    {
        $this->id = $id;
        $this->post = $data;
    }

    public function create(): int
    {
        $this->isCreated = true;

        Db::beginTransaction();
        try {
            // 创建商品
            $data = $this->handleGoodsData();
            $goodsDao = new GoodsDao();
            $this->id = $goodsDao->create($data);

            $this->goods = $goodsDao->info($this->id);
            $this->syncParameter();
            $this->syncTimer();
            $this->syncSku();

            Db::commit();
            return $this->id;
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    public function update(): array
    {
        Db::beginTransaction();
        try {
            // 创建商品
            $data = $this->handleGoodsData();
            $goodsDao = new GoodsDao();
            $goodsDao->update($this->id, $data);

            $this->goods = $goodsDao->info($this->id);
            $this->syncParameter();
            $this->syncTimer();
            $this->syncSku();

            Db::commit();
            return $this->goods->toArray();
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 保存商品sku数据.
     */
    protected function syncSku(): void
    {
    }

    /**
     * 保存商品参数.
     */
    protected function syncParameter(): void
    {
        (new GoodsParameterDao())->createOrUpdate(['goods_id' => $this->id], $this->post['parameter']);
    }

    /**
     * 保存商品定时.
     */
    protected function syncTimer(): void
    {
        (new GoodsTimerDao())->createOrUpdate(['goods_id' => $this->id], $this->post['timer']);
    }

    protected function handleGoodsData(): array
    {
        $sku = $this->post['sku'];
        $skuPrice = array_column($sku, 'price');
        sort($skuPrice);
        $minPrice = $skuPrice[0];
        $maxPrice = end($skuPrice);

        if ($this->post['images'] && is_array($this->post['images'])) {
            $this->post['images'] = implode(',', $this->post['images']);
        }

        return [
            'shop_id' => $this->post['shop_id'],
            'title' => $this->post['title'],
            'sub_title' => $this->post['sub_title'],
            'images' => $this->post['images'],
            'description_id' => $this->post['description_id'] ?? 0,
            'shipping_required' => $this->post['shipping_required'],
            'category_id' => $this->post['category_id'],
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'type' => GoodsState::TYPE_GENERAL,
            'buy_limit' => $this->post['buy_limit'],
            'buy_limit_total' => $this->post['buy_limit_total'],
        ];
    }
}
