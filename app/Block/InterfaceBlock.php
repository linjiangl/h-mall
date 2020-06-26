<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block;

use Hyperf\HttpServer\Contract\RequestInterface;

interface InterfaceBlock
{
    public function index(RequestInterface $request);

    public function show(RequestInterface $request, $id): array;

    public function store(RequestInterface $request): int;

    public function update(RequestInterface $request, $id): array;

    public function destroy(RequestInterface $request, $id): bool;

    public function getCondition(RequestInterface $request): array;
}
