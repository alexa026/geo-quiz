<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;

use JWTAuth;
use App\Http\Requests;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();

        $questions->load('user');
        return compact('questions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('question', 'latitude', 'longitude', 'points', 'answer');

        $data['answer'] = strtolower('answer');

        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $user->decreasePoints($data['points']);

        $q = $user->questions()->create($data);
        return $q;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        return $question;
    }

    /**
     * Try to answer question.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|int|mixed
     */
    public function answerIt(Request $request)
    {
        $data = $request->only('id', 'answer');
        $data['answer'] = strtolower($data['answer']);

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        $question = Question::findOrFail($data['id']);
        
        $result = $question->checkAnswer($data['answer']);
        
        return !$result ? -1 : $this->calculatePoints($user, $question->user, $question);
    }

    /**
     * Exchange points in case that question is answered.
     *
     * @param User $user_answered
     * @param User $user_owner
     * @param Question $question
     * @return mixed
     */
    public function calculatePoints(User $user_answered, User $user_owner, Question $question)
    {
        $points = $question->points;
        $user_owner->decreasePoints($points);

        if ($user_owner->isFriendWith($user_answered->id))
            $points *= 2;

        $user_answered->increasePoints($points);
        $question->answered = true;
        $question->save();

        return $points;
    }
}
