<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Core\Dao\Shop\ShopDao;

class ShopFactory
{
    public static function run()
    {
        $dao = new ShopDao();
        $dao->create([
            'user_id' => 1,
            'name' => '系统店铺',
            'logo' => '',
            'status' => 1,
        ]);
    }
}
