<?php

namespace App\Http\Controllers;

use App\GeoCalculator;
use App\Http\Requests;
use App\Question;
use Illuminate\Http\Request;
use JWTAuth;

class GeoController extends Controller
{
    /**
     * Return questions within a radius.
     *
     * @param Request $request
     * @return array
     */
    public function inRadius(Request $request)
    {
        $defaultRadius = 200;
        $data = $request->only('lat', 'long');

        if (!$user = JWTAuth::parseToken()->authenticate()) 
            return response()->json(['user_not_found'], 404);
        
        $questions = Question::where('user_id', '<>', $user->id)
                               ->where('answered', 0)
                               ->get();

        $geoCalculator = new GeoCalculator($data['lat'], $data['long']);

        $questions = $questions->filter(function($question) use ($geoCalculator, $defaultRadius) {
           return $geoCalculator->inRadius($question->latitude, $question->longitude, $defaultRadius);
        });

        return compact('questions');
    }
}
