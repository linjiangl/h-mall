<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Command\Tools;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * @Command()
 */
class PhpunitCommand extends HyperfCommand
{
    protected $name = 'tools:phpunit';

    public function configure()
    {
        parent::configure();
        $this->addOption('filter', 'f',InputOption::VALUE_OPTIONAL, '测试类型,单个指定,默认测试全部', 'all');
        $this->setDescription('单元测试');
    }

    public function handle()
    {
        $filter = $this->input->getOption('filter');
        $testExec = 'vendor/bin/co-phpunit -c phpunit.xml --colors=always';
        if ($filter != 'all') {
            $testExec = "{$testExec} '--filter={$filter}'";
        }
        exec("rm -rf runtime/container");
        exec($testExec, $output);
        foreach ($output as $row) {
            $this->line($row);
        }
    }
}