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
    protected $config;

    /**
     * cdn地址
     * @return string
     */
    public function cdn(): string
    {
        return $this->config['cdn'];
    }

    /**
     * 文件全路径
     * @param string $key
     * @return string
     */
    public function getFullPath(string $key)
    {
        $cdn = $this->cdn();
        if (substr(strrchr($cdn, DIRECTORY_SEPARATOR), 0) == DIRECTORY_SEPARATOR) {
            $cdn = substr($cdn, 0, -1);
        }
        if (substr($key, 0, 1) != DIRECTORY_SEPARATOR) {
            $key = DIRECTORY_SEPARATOR . $key;
        }
        return $cdn . $key;
    }

    /**
     * 生成文件相对路径
     * @param string $filename 文件名称,取文件后缀
     * @param string $dir 存在目录
     * @return string
     */
    public function generateKey(string $filename, $dir = 'public')
    {
        $suffix = '.jpg';
        if ($filename) {
            $path = pathinfo($filename);
            $suffix = isset($path['extension']) ? '.' . $path['extension'] : $suffix;
        }
        $key = floor(microtime(true) * 1000) . rand(10, 99);
        return DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR . $key . $suffix;
    }

    /**
     * 上传文件
     * @param UploadedFile $file 上传的文件对象
     * @param string $key
     * @return array
     */
    public function upload(UploadedFile $file, string $key = '')
    {
        return $this->handleResult('', '');
    }

    /**
     * 返回结果
     * @param string $hash 目标资源的hash值，可用于 ETag 头部。
     * @param string $key 目标资源的最终名字。
     * @return array
     */
    protected function handleResult(string $hash, string $key)
    {
        return [
            'hash' => $hash,
            'path' => $key,
            'full_path' => $this->getFullPath($key)
        ];
    }
}
