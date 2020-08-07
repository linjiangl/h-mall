<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Common;

use App\Controller\AbstractController;
use App\Core\Plugins\Bucket\QiniuBucket;
use App\Core\Plugins\Captcha;
use App\Core\Plugins\UEditor;
use App\Exception\BadRequestException;
use App\Exception\HttpException;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;
use Throwable;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class PublicController extends AbstractController
{
    // 系统配置
    public function config()
    {
        return [
            'system' => 'h-mall'
        ];
    }

    // 图形验证码
    public function captcha()
    {
        try {
            $captcha = new Captcha();
            return $captcha->generate();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    // 文件上传
    public function upload(RequestInterface $request)
    {
        $file = $request->file('file');
        $bucket = new QiniuBucket();
        return $bucket->upload($file);
    }

    // 百度编辑器
    public function ueditor(RequestInterface $request)
    {
        $action = $request->input('action', 'config');
        $config = config('custom')['ueditor'];
        switch ($action) {
            case 'config':
                return $this->response->json($config);
            /* 上传图片 */
            case 'uploadimage':
                $uploadConfig = array(
                    'pathFormat' => $config['imagePathFormat'],
                    'maxSize' => $config['imageMaxSize'],
                    'allowFiles' => $config['imageAllowFiles']
                );
                $fieldName = $config['imageFieldName'];
                $up = new UEditor($fieldName, $uploadConfig, 'upload');
                return $this->response->json($up->getFileInfo());
            default:
                throw new BadRequestException('不支持的操作');
        }
    }
}
