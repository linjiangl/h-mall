<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Seeders\Seeder;
use Hyperf\Utils\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->handleImportClass();

        // 系统相关
        DistrictFactory::run();

        // 管理相关
        MenuFactory::run();
        RoleFactory::run();
        AdminFactory::run();

        // 用户相关
        UserFactory::run();

        // 其他
        CategoryFactory::run();
        BrandFactory::run();
        SpecFactory::run();
    }

    protected function handleImportClass()
    {
        $filesystem = container()->get(Filesystem::class);
        $directory = BASE_PATH . '/seeders/factories';
        $files = $filesystem->allFiles($directory);
        foreach ($files as $file) {
            $realPath = $file->getRealPath();
            if ($realPath) {
                require_once "{$realPath}";
            }
        }
    }
}
