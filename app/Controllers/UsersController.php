<?php
namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function show($container, $params)
    {
        $user = new User($container);
        $data = $user->get($params[1]);
        var_dump($data);
        return 'project';
    }
}