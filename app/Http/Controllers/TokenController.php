<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;

class TokenController extends Controller
{
    /**
     * Handles user login.
     *
     * @param Request $data
     * @return mixed
     */
    public function login(Request $data)
    {
        $credentials = $data->only('email', 'password');
        $id = User::where('email', $credentials['email'])->first()->id;

        return [$this->processLogin($credentials), compact('id')];
    }

    /**
     * Handles registration process.
     *
     * @param Request $data
     * @return mixed
     */
    public function register(Request $data)
    {
        $user_data = $data->only('email', 'password', 'name');
        $user_data['password'] = bcrypt($user_data['password']);

        $id = User::create($user_data);

        return [$this->processLogin($data->only('email', 'password')), compact('id')];
    }

    /**
     * Get token or error response based on credentials.
     *
     * @param $credentials
     * @return mixed
     */
    private function processLogin($credentials)
    {
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }
        catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return compact('token');
    }
}
