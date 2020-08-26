<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Seeders\Seeder;
use Hyperf\Utils\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->handleImportClass();

        // 系统相关
        // DistrictFactory::run();

        // 管理相关
        MenuFactory::run();
        RoleFactory::run();
        AdminFactory::run();

        // 用户相关
        UserFactory::run();
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
