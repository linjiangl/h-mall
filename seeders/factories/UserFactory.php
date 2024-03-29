<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Constants\State\User\UserState;
use App\Core\Service\Authorize\UserAuthorizationService;
use App\Model\User\User;
use Faker\Factory;
use Hyperf\DbConnection\Db;

class UserFactory
{
    public static function run()
    {
        $faker = Factory::create();
        $service = new UserAuthorizationService();
        $password = '123456';
        $service->register('hmallgf', $password, $password, [
            'nickname' => '系统官方',
            'email' => $faker->unique()->safeEmail,
            'is_system' => UserState::IS_SYSTEM_TRUE,
        ]);

        $user = new User();
        $userTableName = get_table_name($user->getTable());
        Db::statement(sprintf('ALTER TABLE `%s` AUTO_INCREMENT = 10000', $userTableName));

        $service->register('hmallkf', $password, $password, [
            'nickname' => '系统客服',
            'email' => $faker->unique()->safeEmail,
            'is_system' => UserState::IS_SYSTEM_TRUE,
        ]);

        $num = 100;
        while ($num > 0) {
            $service->register($faker->userName, $password, $password, [
                'nickname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'is_system' => UserState::IS_SYSTEM_FALSE,
            ]);
            --$num;
        }
    }
}
