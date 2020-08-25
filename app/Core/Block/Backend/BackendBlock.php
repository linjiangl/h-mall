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
        parent::handleQueryParams($request);
        $sort = $request->query('sorter', '');
        if ($sort) {
            $sort = json_decode($sort, true);
            $orderBy = '';
            foreach ($sort as $key => $value) {
                $value = str_replace('end', '', $value);
                $orderBy = $orderBy . "{$key} {$value}";
            }
            $this->orderBy = $orderBy;
        }
    }
}
