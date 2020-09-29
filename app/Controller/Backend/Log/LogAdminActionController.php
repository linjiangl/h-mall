<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Log;

use App\Constants\BlockSinceConstants;
use App\Controller\AbstractController;
use App\Core\Block\Common\Log\LogAdminActionBlock;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class LogAdminActionController extends AbstractController
{
    /**
     * 管理员操作日志
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new LogAdminActionBlock)->setSince(BlockSinceConstants::SINCE_BACKEND)->index($request);
    }
}
