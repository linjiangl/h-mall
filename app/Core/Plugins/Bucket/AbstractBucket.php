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

use App\Core\Service\AttachmentService;
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
    public function generateKey(string $filename, $dir = 'images')
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
        return $this->handleResult($file, '', '');
    }

    /**
     * 返回结果
     * @param UploadedFile $file
     * @param string $hash 目标资源的hash值，可用于 ETag 头部。
     * @param string $key 目标资源的最终名字。
     * @return array
     */
    protected function handleResult(UploadedFile $file, string $hash, string $key)
    {
        // 删除上传文件
        if (file_exists($file->getRealPath())) {
            unlink($file->getRealPath());
        }

        return [
            'hash' => $hash,
            'path' => $key,
            'full_path' => $this->getFullPath($key)
        ];
    }

    /**
     * 检查文件是否上传
     * @param UploadedFile $file
     * @return array|bool
     */
    protected function checkFileExists(UploadedFile $file)
    {
        $config = config('custom')['attachment'];
        if ($file->getSize() <= $config['check_md5']) {
            $md5 = md5_file($file->getRealPath());
            $service = new AttachmentService();
            $info = $service->getInfoByMd5($md5);
            if ($info != null) {
                return $this->handleResult($file, $info->hash, $info->key);
            }
        }
        return false;
    }
}
