<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Model\Brand;

class BrandFactory
{
    public static function run()
    {
        $now = time();
        $insert = [
            [
                'id' => 1,
                'name' => '小米',
                'logo' => '',
                'created_time' => $now,
                'updated_time' => $now,
            ],
        ];

        Brand::insert($insert);
    }
}
