<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use App\Block\InterfaceBlock;
use Hyperf\HttpServer\Contract\RequestInterface;

class RestController extends AbstractController
{
    /**
     * @var InterfaceBlock
     */
    protected $block;

    public function index(RequestInterface $request)
    {
        return (new $this->block())->index($request);
    }

    public function show(RequestInterface $request, $id)
    {
        return (new $this->block())->show($request, $id);
    }

    public function store(RequestInterface $request)
    {
        return (new $this->block())->store($request);
    }

    public function update(RequestInterface $request, $id)
    {
        return (new $this->block())->update($request, $id);
    }

    public function destroy(RequestInterface $request, $id)
    {
        return (new $this->block())->destroy($request, $id);
    }

    public function condition(RequestInterface $request)
    {
        return (new $this->block())->getCondition();
    }
}