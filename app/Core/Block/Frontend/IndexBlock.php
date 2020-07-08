<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend;

use Hyperf\HttpServer\Contract\RequestInterface;

class IndexBlock
{
    protected $page = 1;

    public function index(RequestInterface $request)
    {
        $page = $request->query('page', 1);
        $this->page = $this->page + $page;

        return $this->page;
    }
}
