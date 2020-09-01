<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Types;

/**
 * 普通商品
 */
class GeneralService extends AbstractTypesService
{
    public function __construct(array $data, int $id = 0)
    {
        parent::__construct($data, $id);
    }


}
