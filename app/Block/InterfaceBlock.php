<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Block;

use Hyperf\HttpServer\Contract\RequestInterface;

interface InterfaceBlock
{
    public function index(RequestInterface $request);

    public function show(RequestInterface $request, $id);

    public function store(RequestInterface $request);

    public function update(RequestInterface $request, $id);

    public function destroy(RequestInterface $request, $id);

    public function getCondition(RequestInterface $request): array;
}
