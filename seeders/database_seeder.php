<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Hyperf\Database\Seeders\Seeder;

require_once "factories/DistrictFactory.php";
require_once "factories/UserFactory.php";
require_once "factories/AdminFactory.php";

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DistrictFactory::run();
        UserFactory::run();
        AdminFactory::run();
    }
}
