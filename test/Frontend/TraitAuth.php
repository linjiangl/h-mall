<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend;

trait TraitAuth
{
    protected $token;

    protected $filename = '/runtime/testing_token.txt';

    public function setToken($token)
    {
        file_put_contents(BASE_PATH . $this->filename, $token);
    }

    public function getToken()
    {
        return file_get_contents(BASE_PATH . $this->filename);
    }

    public function getHeaders()
    {
        return [
            'Authorization' => $this->getToken()
        ];
    }
}
