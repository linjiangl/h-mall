<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Command\Tools;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\DB\DB;

/**
 * @Command
 * 注意事项:
 *  - 表名不要复数,比如用户表应该设计成`user`,不要设计成`users`,否则生成模型就有问题
 */
class ModelCommand extends HyperfCommand
{
    protected $name = 'tools:gen-model';

    /**
     * 迁移表的表名.
     */
    protected string $migrateTable = 'migrations';

    /**
     * 数据模型的模块.
     * @var string[]
     */
    protected array $module = [
        'admin',
        'user',
        'shop',
        'category',
        'product',
        'order',
        'refund',
        'message',
        'statistics',
        'role',
        'payment',
        'parameter',
    ];

    /**
     * 指定的数据表.
     */
    protected array $specifyTables = [
        // 'brand',
    ];

    public function configure()
    {
        parent::configure();
        $this->setDescription('根据表名生成对应的模型类文件');
    }

    public function handle()
    {
        if (! function_exists('exec')) {
            $this->error('[x] 请启用PHP`exec()`函数');
            return;
        }

        $tables = $this->getAllTables();
        foreach ($tables as $table) {
            $tempArr = explode('_', $table);
            if (in_array($tempArr[0], $this->module)) {
                $this->genModelExec($table, ucfirst($tempArr[0]));
            } else {
                $this->genModelExec($table);
            }
        }

        $this->phpCsFixerModel();
    }

    protected function genModelExec($table, $path = '')
    {
        $config = config('databases');
        $basePath = $config['default']['commands']['gen:model']['path'];
        $path = $path ? $basePath . '/' . $path : $basePath;
        $genModelExec = sprintf('php bin/hyperf.php gen:model %s --path=%s --inheritance=Model --uses=App\\\\Model\\\\Model --with-comments --force-casts --refresh-fillable', $table, $path);
        exec($genModelExec);
        $this->info(sprintf('`%s` table generation model class successful', $table));
    }

    protected function phpCsFixerModel()
    {
        $this->line('');
        $appPath = BASE_PATH;
        $fixerExec = sprintf('%s/vendor/bin/php-cs-fixer --config=%s/.php-cs-fixer.php --verbose fix %s/app/Model', $appPath, $appPath, $appPath);
        exec($fixerExec);
    }

    protected function getAllTables(): array
    {
        if (empty($this->specifyTables)) {
            /** @var DB $db */
            $db = container()->get(DB::class);
            $database = config('databases')['default']['database'];
            $tables = $db->query('show tables');
            $tables = array_column($tables, 'Tables_in_' . $database);
            $index = array_search($this->migrateTable, $tables);
            unset($tables[$index]);
            return array_values($tables);
        }
        return $this->specifyTables;
    }
}
