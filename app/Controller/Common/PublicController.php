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
use App\Exception\HttpException;
use App\Service\Utils\CaptchaService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class PublicController extends AbstractController
{
    /**
     * 系统配置
     * @return string[]
     */
    public function config()
    {
        return [
            'system' => 'h-mall'
        ];
    }

    /**
     * 图形验证码
     * @return array
     */
    public function captcha()
    {
        try {
            $service = new CaptchaService();
            return $service->generate();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 文件上传
     * @param RequestInterface $request
     * @return array
     */
    public function upload(RequestInterface $request)
    {
        $file = $request->file('file');
        return $file->toArray();
    }
}
