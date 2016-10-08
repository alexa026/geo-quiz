<?php

namespace App\Http\Controllers;

use App\Location;
use Event;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

use App\Http\Requests;
use App\Events\UserLocationChanged;

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

    /**
     * Return a loged in user.
     *
     * @return mixed
     */
    public function getUser()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        return compact('user');
    }

    /**
     * Broadcast new user location.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLocation(Request $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $location = new Location;
        $location->longitude = $request->get('longitude');
        $location->latitude = $request->get('latitude');
        Event::fire(new UserLocationChanged($user, $location));

        return \Response::json(['ok'], 200);
    }
}
