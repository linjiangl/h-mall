<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao;

use App\Model\Brand;

class BrandDao extends AbstractDao
{
    protected $model = Brand::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '品牌不存在';
}
