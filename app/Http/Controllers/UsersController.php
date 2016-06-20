<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    /**
     * Return a required user.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
}