<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use Hyperf\DbConnection\Db;

class DistrictFactory
{
    public static function run()
    {
        $path = BASE_PATH . '/seeders/data/district.json';
        $data = json_decode(file_get_contents($path), true);
        $data = array_chunk($data, 2000);
        $now = time();
        foreach ($data as $chunk) {
            $insert = [];
            foreach ($chunk as $item) {
                $item['created_time'] = $item['updated_time'] = $now;
                $insert[] = $item;
            }

            Db::table('district')->insert($insert);
        }
    }
}
