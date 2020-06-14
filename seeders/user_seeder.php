<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use App\Dao\User\UserDao;
use App\Service\Authorize\UserAuthorizationService;
use Hyperf\Database\Seeders\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userDao = new UserDao();
        $userDao->create([
            'id' => 1,
            'username' => 'hmallgf',
            'nickname' => '系统官方',
            'password' => '',
            'lasted_login_time' => time()
        ]);

        $userDao->create([
            'id' => 10000,
            'username' => 'hmallkf',
            'nickname' => '系统客服',
            'password' => '',
            'lasted_login_time' => time()
        ]);
    }
}
