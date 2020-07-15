<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend;

use App\Core\Block\AbstractBlock;
use Hyperf\HttpServer\Contract\RequestInterface;

class BackendBlock extends AbstractBlock
{
    protected function handleQueryParams(RequestInterface $request)
    {
        $this->page = intval($request->query('current', $this->page));
        $this->limit = intval($request->query('pageSize', $this->limit));
    }
}
