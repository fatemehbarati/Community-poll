<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PollsController extends Controller
{
    /**
     * return json array of all Polls
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Poll::get(), 200);
    }

    /**
     * return json object for a specific Poll
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return response()->json(Poll::find($id), 200);
    }
}
