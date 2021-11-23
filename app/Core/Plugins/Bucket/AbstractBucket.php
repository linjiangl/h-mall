<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Plugins\Bucket;

use App\Core\Service\System\AttachmentService;
use Hyperf\HttpMessage\Upload\UploadedFile;

abstract class AbstractBucket
{
    protected array $config;

    /**
     * cdn地址
     */
    public function cdn(): string
    {
        return $this->config['cdn'];
    }

    /**
     * 文件全路径.
     */
    public function getFullPath(string $key): string
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
     * 生成文件相对路径.
     * @param string $filename 文件名称,取文件后缀
     * @param string $dir 存在目录
     */
    public function generateKey(string $filename, string $dir = 'images'): string
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
     * 上传文件.
     * @param UploadedFile $file 上传的文件对象
     */
    public function upload(UploadedFile $file, string $key = ''): array
    {
        return $this->handleResult($file, '', $key);
    }

    /**
     * 批量删除.
     * @return array ['success' => [...删除成功的key], 'fail' => [...删除失败的key]]
     */
    public function batchDelete(array $keys): array
    {
        return [
            'success' => [],
            'fail' => [],
        ];
    }

    /**
     * 返回结果.
     * @param string $hash 目标资源的hash值，可用于 ETag 头部
     * @param string $key 目标资源的最终名字
     */
    protected function handleResult(UploadedFile $file, string $hash, string $key): array
    {
        // 删除上传文件
        if (file_exists($file->getRealPath())) {
            unlink($file->getRealPath());
        }

        return [
            'hash' => $hash,
            'path' => $key,
            'full_path' => $this->getFullPath($key),
        ];
    }

    /**
     * 检查文件是否上传.
     */
    protected function checkFileExists(UploadedFile $file): bool|array
    {
        $config = config('custom')['attachment'];
        if ($file->getSize() <= $config['encrypt_limit_size']) {
            $md5 = md5_file($file->getRealPath());
            $service = new AttachmentService();
            $info = $service->getInfoByEncrypt($md5);
            if ($info != null) {
                return $this->handleResult($file, $info->hash, $info->key);
            }
        }
        return false;
    }
}
