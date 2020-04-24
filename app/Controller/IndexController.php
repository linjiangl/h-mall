<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Carbon\Carbon;
use Hyperf\Snowflake\IdGenerator;
use Hyperf\Di\Annotation\Inject;

class IndexController extends AbstractController
{
    /**
     * @Inject
     * @var IdGenerator\SnowflakeIdGenerator
     */
    protected $idGenerator;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'id' => $this->idGenerator->generate(),
			'now' => Carbon::now()->toDateTimeString(),
        ];
    }
}
