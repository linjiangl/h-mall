<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Menu;

class MenuDao extends AbstractDao
{
    protected string $model = Menu::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '菜单不存在';

    public function info(int $id, array $with = []): Menu
    {
        return parent::info($id, $with);
    }

    /**
     * 根据状态获取菜单
     * @param mixed $status 状态
     * @param string $select
     * @return array
     */
    public function getListByStatus($status = null, string $select = '*'): array
    {
        $condition = [];
        if ($status != null) {
            $condition[] = ['status', '=', $status];
        }
        return $this->getListByCondition($condition, [], $select, 'parent_id asc, sorting asc');
    }
}
