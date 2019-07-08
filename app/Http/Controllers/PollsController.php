<?php

namespace App\Http\Controllers;

use App\Poll;
use App\Http\Resources\Poll as PollResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PollsController extends Controller
{
    /**
     * return json array of all Polls
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Poll::paginate(1), 200);
    }

    /**
     * return json object for a specific Poll
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $poll = Poll::with('questions')->findOrFail($id);
        $response['poll'] = $poll;
        $response['questions'] = $poll->questions;
        return response()->json($response, 200);
    }

    /**
     * store a requested poll
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

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

    public function questions(Poll $poll)
    {
        return response()->json($poll->questions, 200);
    }
}
