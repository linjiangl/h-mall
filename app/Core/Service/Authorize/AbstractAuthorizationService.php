<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */

namespace App\Core\Service\Authorize;

use App\Exception\BadRequestException;
use App\Exception\CacheErrorException;
use DateTimeImmutable;
use DateTimeZone;
use Hyperf\Utils\Str;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Token\RegisteredClaims;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Psr\SimpleCache\InvalidArgumentException;

abstract class AbstractAuthorizationService implements InterfaceAuthorizationService
{
    /**
     * 场景
     * @var string
     */
    protected string $scene = 'default';

    /**
     * 配置
     * @var array
     */
    protected array $config = [];

    protected Plain $plain;

    protected Configuration $configuration;

    public function __construct()
    {
        if ($this->scene == 'default') {
            $this->config = config('jwt');
        } else {
            $this->config = config('jwt')['scene'][$this->scene];
        }

        $this->configuration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::base64Encoded($this->config['secret'])
        );
        assert($this->configuration instanceof Configuration);


    }

    public function logout(): bool
    {
        try {
            return $this->jwt->logout();
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public function setToken(string $token): self
    {
        $this->plain = $this->configuration->parser()->parse($token);
        assert($this->plain instanceof Plain);
        return $this;
    }

    public function createToken(array $user): string
    {
        $now = new DateTimeImmutable();
        $token = $this->configuration
            ->builder()
            ->issuedBy($this->config['issued'])
            ->permittedFor($this->config['issued'])
            ->identifiedBy($this->scene)
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now->modify('+1 second'))
            ->expiresAt($now->modify("+{$this->config['ttl']} second"))
            ->withClaim('auth', $user)
            ->getToken($this->configuration->signer(), $this->configuration->signingKey());

        return $token->toString();
    }

    public function refreshToken(): array
    {
        $user = $this->getParserData(true);
        $token = $this->createToken($user);
        return [
            'token' => $token,
            'exp' => $this->getTTL(),
        ];
    }

    public function getTTL()
    {
        return $this->plain->claims()->get(RegisteredClaims::EXPIRATION_TIME);
    }

    public function validationToken(): bool
    {
        $timezone = new DateTimeZone('Asia/Shanghai');
        $clock = new SystemClock($timezone);
        $this->configuration->setValidationConstraints(new LooseValidAt($clock));
        $constraints = $this->configuration->validationConstraints();

        try {
            $this->configuration->validator()->assert($this->plain, ...$constraints);
        } catch (RequiredConstraintsViolated $e) {
            return false;
        }
        return true;
    }

    public function getParserData(bool $filter = false): array
    {
        $all = $this->plain->claims()->all();
        // 只获取用户数据
        if ($filter) {
            $all = $all['auth'];
        }
        return $all;
    }

    public function generateSalt($length = 10): string
    {
        return Str::random($length);
    }

    public function generatePasswordHash($password, $salt = ''): string
    {
        if ($salt == '') {
            $salt = $this->generateSalt();
        }
        return sha1(substr(md5($password), 0, 16) . $salt);
    }
}
