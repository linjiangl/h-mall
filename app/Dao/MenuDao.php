<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao;

use App\Model\Menu;

class MenuDao extends AbstractDao
{
    protected $model = Menu::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '菜单不存在';
}
