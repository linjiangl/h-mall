<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Auth;

use Phper666\JWTAuth\JWT;

abstract class AbstractAuthBlock
{
    /**
     * @var JWT
     */
    protected $jwt;

    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }
}
