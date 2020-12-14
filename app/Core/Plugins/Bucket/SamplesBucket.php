<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Plugins\Bucket;

use App\Constants\State\AttachmentState;
use App\Exception\BadRequestException;

class SamplesBucket
{
    protected array $classes = [
        AttachmentState::SYSTEM_QINIU => QiniuBucket::class,
    ];

    public function make(string $system = AttachmentState::SYSTEM_QINIU): AbstractBucket
    {
        if (! in_array($system, array_keys(AttachmentState::getSystem()))) {
            throw new BadRequestException('存储实例不存在');
        }
        return new $this->classes[$system]();
    }
}
