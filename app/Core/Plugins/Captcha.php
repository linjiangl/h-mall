<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Plugins;

use App\Exception\BadRequestException;
use Gregwar\Captcha\CaptchaBuilder;
use Throwable;

/**
 * 图片验证码
 * Class Captcha.
 */
class Captcha
{
    public int $length = 4; // 验证码长度

    public array $color = [255, 255, 255]; // 颜色

    public int $width = 111; // 宽度

    public int $height = 43; // 长度

    /**
     * 生成.
     */
    public function generate(): array
    {
        $builder = new CaptchaBuilder($this->length);
        $builder->setBackgroundColor($this->color[0], $this->color[1], $this->color[2]);
        $builder->build($this->width, $this->height);

        try {
            $key = md5($builder->getPhrase());
            redis()->set($this->getCacheKey($key), $builder->getPhrase(), 600); //验证码10分钟有效
            return [
                'img' => $builder->inline(), // img base64
                'key' => $key,
            ];
        } catch (Throwable $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    /**
     * 验证
     * @param $key
     * @param $code
     */
    public function validate($key, $code): bool
    {
        $cacheKey = $this->getCacheKey($key);
        $cacheCode = redis()->get($cacheKey);
        if (! empty($cacheCode)) {
            redis()->del($cacheKey);

            $builder = new CaptchaBuilder($cacheCode);
            if ($builder->testPhrase($code)) {
                return true;
            }
        }
        return false;
    }

    private function getCacheKey($key): string
    {
        return 'captcha_code_' . md5($key);
    }
}
