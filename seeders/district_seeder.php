<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Carbon\Carbon;
use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = BASE_PATH . '/seeders/data/district.json';
        $data = json_decode(file_get_contents($path), true);
        $data = array_chunk($data, 2000);
        $now = Carbon::now()->toDateTimeString();
        foreach ($data as $chunk) {
            $insert = [];
            foreach ($chunk as $item) {
                $item['created_at'] = $item['updated_at'] = $now;
                $insert[] = $item;
            }

            Db::table('district')->insert($insert);
        }
    }
}
