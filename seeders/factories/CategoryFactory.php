<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Model\Category\Category;

class CategoryFactory
{
    public static function run()
    {
        $now = time();
        $insert = [
            [
                'id' => 1,
                'parent_id' => 0,
                'name' => '手机',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'name' => '小米',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'name' => '华为',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'id' => 4,
                'parent_id' => 0,
                'name' => '电脑',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'id' => 5,
                'parent_id' => 4,
                'name' => '华硕',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'id' => 6,
                'parent_id' => 4,
                'name' => '苹果',
                'created_time' => $now,
                'updated_time' => $now,
            ],
        ];
        Category::insert($insert);
    }
}
