<?php


namespace App\Controller\Frontend\User;


use App\Block\Frontend\User\UserBlock;
use App\Controller\RestController;

class UserController extends RestController
{
    protected $block = UserBlock::class;
}
