<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use App\Constants\State\MenuState;
use App\Core\Service\MenuService;

/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
class MenuFactory
{
    public static function run()
    {
        $data = [
            [
                'id' => 1,
                'parent_id' => 0,
                'title' => 'dashboard',
                'name' => 'dashboard',
                'icon' => 'dashboard',
                'path' => '/dashboard',
                'status' => MenuState::STATUS_ENABLED,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'title' => '数据统计',
                'name' => 'analysis',
                'icon' => 'smile',
                'path' => '/dashboard/analysis',
                'status' => MenuState::STATUS_ENABLED,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'title' => '工作台',
                'name' => 'workplace',
                'icon' => 'smile',
                'path' => '/dashboard/workplace',
                'status' => MenuState::STATUS_ENABLED,
            ],
            [
                'id' => 4,
                'parent_id' => 0,
                'title' => '用户管理',
                'name' => 'member',
                'icon' => 'warning',
                'path' => '/member',
                'status' => MenuState::STATUS_ENABLED,
            ],
            [
                'id' => 5,
                'parent_id' => 4,
                'title' => '用户列表',
                'name' => 'index',
                'icon' => 'smile',
                'path' => '/member/index',
                'status' => MenuState::STATUS_ENABLED,
            ],
        ];
        $service = new MenuService();
        foreach ($data as $item) {
            $service->create($item);
        }
    }
}
