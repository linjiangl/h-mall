<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Model\Spec\Spec;
use App\Model\Spec\SpecValue;

class SpecFactory
{
    public static function run()
    {
        $now = time();
        $specInsert = [
            [
                'id' => 1,
                'name' => '颜色',
                'created_time' => $now,
                'updated_time' => $now,
            ],
        ];

        $specValueInsert = [
            [
                'spec_id' => 1,
                'value' => '红色',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'spec_id' => 1,
                'value' => '白色',
                'created_time' => $now,
                'updated_time' => $now,
            ],
            [
                'spec_id' => 1,
                'value' => '黑色',
                'created_time' => $now,
                'updated_time' => $now,
            ],
        ];

        Spec::insert($specInsert);
        SpecValue::insert($specValueInsert);
    }
}
