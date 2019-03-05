<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::paginate(15);
        return view('usersList' , ['users' => $users]);
    }
}
