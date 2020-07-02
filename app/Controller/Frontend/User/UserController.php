<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\User;

use App\Block\Frontend\User\UserBlock;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Contract\RequestInterface;

class UserController extends AbstractController
{
    public function index(RequestInterface $request)
    {
        return (new UserBlock())->index($request);
    }

    public function show(RequestInterface $request, $id)
    {
        return (new UserBlock())->show($request, $id);
    }

    public function store(RequestInterface $request)
    {
        return (new UserBlock())->store($request);
    }

    public function update(RequestInterface $request, $id)
    {
        return (new UserBlock())->update($request, $id);
    }

    public function destroy(RequestInterface $request, $id)
    {
        return (new UserBlock())->destroy($request, $id);
    }

    public function condition(RequestInterface $request)
    {
        return (new UserBlock())->getCondition($request);
    }
}
