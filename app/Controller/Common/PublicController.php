<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Common;

use App\Controller\AbstractController;
use App\Core\Plugins\Bucket\SamplesBucket;
use App\Core\Plugins\Captcha;
use App\Core\Plugins\UEditor;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use Hyperf\HttpMessage\Upload\UploadedFile;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class PublicController extends AbstractController
{
    // 系统配置
    public function config(): array
    {
        return [
            'system' => 'h-mall',
        ];
    }

    // 图形验证码
    public function captcha(): array
    {
        $captcha = new Captcha();
        return $captcha->generate();
    }

    // 文件上传
    public function upload(RequestInterface $request): array
    {
        $file = $request->file('file');
        if (!($file instanceof UploadedFile)) {
            throw new InternalException('上传文件错误');
        }

        $bucket = (new SamplesBucket())->make();
        return $bucket->upload($file);
    }

    // 百度编辑器
    public function ueditor(RequestInterface $request)
    {
        $action = $request->input('action', 'config');
        $config = config('custom')['ueditor'];
        switch ($action) {
            case 'config':
                return $this->returnResponseSourceData($config);
            /* 上传图片 */
            case 'uploadimage':
                $uploadConfig = [
                    'pathFormat' => $config['imagePathFormat'],
                    'maxSize' => $config['imageMaxSize'],
                    'allowFiles' => $config['imageAllowFiles'],
                ];
                $fieldName = $config['imageFieldName'];
                $up = new UEditor($fieldName, $uploadConfig, 'upload');
                return $this->returnResponseSourceData($up->getFileInfo());
            default:
                throw new BadRequestException('不支持的操作');
        }
    }
}
