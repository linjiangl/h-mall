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
use DateTime;
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
use Throwable;

abstract class AbstractAuthorizationService implements InterfaceAuthorizationService
{
    /**
     * 场景.
     */
    protected string $scene = 'default';

    /**
     * 配置.
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

        $this->configuration = Configuration::forSymmetricSigner(new Sha256(), InMemory::base64Encoded($this->config['secret']));
    }

    public function authorize(): array
    {
        return $this->getParserData(true);
    }

    public function logout(): bool
    {
        return true;
    }

    public function parseToken(string $token): self
    {
        try {
            $this->plain = $this->configuration->parser()->parse($token);
        } catch (Throwable $e) {
            throw new BadRequestException('token 解析错误');
        }
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

        $token = $token->toString();
        $this->parseToken($token);

        return $token;
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
        $expData = (array) $this->plain->claims()->get(RegisteredClaims::EXPIRATION_TIME);
        try {
            $from = $expData['timezone_type'] != 3 ? 'UTC' : $expData['timezone'];
            $datetime = new DateTime($expData['date'], new DateTimeZone($from));
            $datetime->setTimezone(new DateTimeZone('Asia/Shanghai'));
            $date = $datetime->format('Y-m-d H:i:s');
            return strtotime($date) - time();
        } catch (Throwable $e) {
            return -1;
        }
    }

    public function validationToken(): bool
    {
        $timezone = new DateTimeZone('Asia/Shanghai');
        $clock = new SystemClock($timezone);
        $this->configuration->setValidationConstraints(new LooseValidAt($clock));
        $constraints = $this->configuration->validationConstraints();

        try {
            $this->configuration->validator()->assert($this->plain, ...$constraints);
            return true;
        } catch (RequiredConstraintsViolated $e) {
            return false;
        }
    }

    public function getParserData(bool $filter = false): array
    {
        $all = $this->plain->claims()->all();
        // 只获取授权用户数据
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

    public function getHeader()
    {
        return $this->config['header'];
    }

    public function getRequestToken(): string
    {
        return request()->getHeaderLine($this->getHeader()) ?? '';
    }
}
