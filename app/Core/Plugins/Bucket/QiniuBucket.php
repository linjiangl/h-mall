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
use App\Exception\BadRequestException;
use Exception;
use Hyperf\HttpMessage\Upload\UploadedFile;
use Qiniu\Auth;
use Qiniu\Config;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Zone;

class QiniuBucket extends AbstractBucket
{
    public function __construct()
    {
        $this->config = config('custom')['qn'];
    }

    public function upload(UploadedFile $file, string $key = ''): array
    {
        $ret = $this->checkFileExists($file);
        if ($ret != false) {
            return $ret;
        }

        try {
            if (! $key) {
                $key = $this->generateKey($file->getClientFilename(), 'images');
            }
            $uploadMgr = new UploadManager($this->getConfig());
            [$ret, $err] = $uploadMgr->putFile($this->getToken(), $key, $file->getRealPath());
            if ($err !== null) {
                write_logs('上传失败', 'QiniuBucketUpload', $err);
                throw new BadRequestException('上传失败');
            }

            $service = new AttachmentService();
            $service->createUpload($file->toArray(), $ret['hash'], $ret['key']);

            return $this->handleResult($file, $ret['hash'], $ret['key']);
        } catch (Exception $e) {
            throw new BadRequestException('上传错误: ' . $e->getMessage());
        }
    }

    public function batchDelete(array $keys): array
    {
        $bucketManager = new BucketManager($this->getAuth(), $this->getConfig());
        $ops = $bucketManager->buildBatchDelete($this->config['bucket_name'], $keys);
        [$ret, $err] = $bucketManager->batch($ops);
        if ($err) {
            write_logs('删除失败', 'QiniuBucketRemove', $err);
            throw new BadRequestException($err);
        }
        $data = [
            'success' => [],
            'fail' => []
        ];
        foreach ($ret as $k => $v) {
            if ($v['code'] == 200) {
                $data['success'][] = $keys[$k];
            } else {
                $data['fail'][] = $keys[$k];
            }
        }
        return $data;
    }

    public function getAuth(): Auth
    {
        return new Auth($this->config['access_key'], $this->config['secret_key']);
    }

    public function getToken(): string
    {
        return $this->getAuth()->uploadToken($this->config['bucket_name']);
    }

    public function getConfig(): Config
    {
        return new Config(Zone::zonez2());
    }

    public function generateKey(string $filename, $dir = 'images'): string
    {
        $key = parent::generateKey($filename, $dir);
        return substr($key, 1);
    }
}
