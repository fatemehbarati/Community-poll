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

    /**
     * store a requested poll
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $poll = Poll::create($request->all());
        return response()->json($poll, 201);
    }

    /**
     * update a record
     * @param Request $request
     * @param Poll $poll
     * @return JsonResponse
     */
    public function update(Request $request, Poll $poll)
    {
        $poll->update($request->all());
        return response()->json($poll, 200);
    }

    /**
     * delete a record
     * @param Request $request
     * @param Poll $poll
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Poll $poll)
    {
        $poll->delete();
        return response()->json(null, 204);
    }
}
