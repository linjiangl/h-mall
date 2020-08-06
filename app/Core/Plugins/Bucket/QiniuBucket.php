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

use App\Exception\BadRequestException;
use Exception;
use Hyperf\HttpMessage\Upload\UploadedFile;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiniuBucket extends AbstractBucket
{
    protected $config;

    protected $auth;

    public function __construct()
    {
        $this->config = config('custom')['qn'];
        $this->auth = new Auth($this->config['access_key'], $this->config['secret_key']);
    }

    public function getToken()
    {
        return $this->auth->uploadToken($this->config['bucket_name']);
    }

    public function getDomain()
    {
        return $this->config['domain'];
    }

    public function getFullPath(string $hash)
    {
        return $this->config['domain'] . $hash;
    }

    public function save(UploadedFile $file, string $key = '')
    {
        try {
            if (! $key) {
                $key = $this->generateFilepath($file, 'images');
            }
            $uploadMgr = new UploadManager();
            [$ret, $err] = $uploadMgr->putFile($this->getToken(), $key, $file->getRealPath());
            if ($err !== null) {
                throw new BadRequestException($err);
            }
            return $ret;
        } catch (Exception $e) {
            throw new BadRequestException('上传错误: ' . $e->getMessage());
        }
    }

    public function generateFilepath(UploadedFile $file, $type = 'public')
    {
        $suffix = '.' . $file->getExtension();
        $key = floor(microtime(true) * 1000);
        return $type . DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR . $key . $suffix;
    }
}
