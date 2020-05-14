<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Command\Common;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\DB\DB;
use Psr\Container\ContainerInterface;

/**
 * @Command
 * 注意事项:
 *  - 表名不要复数,比如用户表应该设计成`user`,不要设计成`users`,否则生成模型就有问题
 */
class ModelCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected $migrateTable = 'migrations';

    /**
     * 数据模型的模块.
     * @var string[]
     */
    protected $module = [
        'user',
        'shop',
        'category',
        'option',
        'product',
        'order',
        'refund',
        'message',
        'log',
        'statistics',
    ];

    protected $specifyTables = [
        'customer_service'
    ];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('custom:gen-model');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Model classes that generate all tables');
    }

    public function handle()
    {
        if (! function_exists('exec')) {
            $this->error('[x] 请取消禁用exec函数');
            return;
        }

        $tables = $this->getAllTables();
        foreach ($tables as $table) {
            $tmpArr = explode('_', $table);
            if (in_array($tmpArr[0], $this->module)) {
                $this->genModelExec($table, ucfirst($tmpArr[0]));
            } else {
                $this->genModelExec($table);
            }
        }

        $this->phpCsFixerModel();
    }

    protected function genModelExec($table, $path = '')
    {
        $config = config('databases');
        $basePath = $config['default']['commands']['db:model']['path'];
        $path = $path ? $basePath . '/' . $path : $basePath;
        $genModelExec = "php bin/hyperf.php gen:model {$table} --path={$path} --with-comments --force-casts --refresh-fillable";
        exec($genModelExec);
        $this->info("`{$table}` table generation model class successful");
    }

    protected function phpCsFixerModel()
    {
        $this->line('');
        $appPath = BASE_PATH;
        $fixerExec = "{$appPath}/vendor/bin/php-cs-fixer --config={$appPath}/.php_cs --verbose fix {$appPath}/app/Model";
        exec($fixerExec);
    }

    protected function getAllTables()
    {
        if (empty($this->specifyTables)) {
            $tables = DB::query('show tables');
            $tables = array_column($tables, 'Tables_in_hyperf-mall');
            $index = array_search($this->migrateTable, $tables);
            unset($tables[$index]);
            return array_values($tables);
        }
        return $this->specifyTables;
    }
}
