<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Types;

use App\Constants\State\Product\ProductState;
use App\Exception\InternalException;

class TypesService
{
    protected int $id;

    protected array $post;

    protected InterfaceTypesService $class;

    protected array $mapClass = [
        ProductState::TYPE_GENERAL => GeneralService::class,
        ProductState::TYPE_VIRTUAL => VirtualService::class,
    ];

    public function __construct(array $data, int $id = 0)
    {
        $this->id = $id;
        $this->post = $data;

        if (! in_array($data['type'], array_keys($this->mapClass))) {
            throw new InternalException('商品类型不存在');
        }

        $this->class = new $this->mapClass[$data['type']]($this->post, $this->id);
    }

    public function getInstance()
    {
        return $this->class;
    }
}
