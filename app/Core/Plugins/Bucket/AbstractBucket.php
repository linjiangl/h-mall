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

use Hyperf\HttpMessage\Upload\UploadedFile;

abstract class AbstractBucket
{
    public function save(UploadedFile $file, string $path)
    {
        return $path;
    }
}
