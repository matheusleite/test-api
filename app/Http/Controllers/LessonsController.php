<?php

namespace App\Http\Controllers;

use App\Lesson as Lesson;
use Request;
use Illuminate\Http\Response;

use App\Http\Requests;

class LessonsController extends Controller
{
    function __construct()
    {
      $this->middleware('auth.basic');
    }

    public function index()
    {
      $lessons = Lesson::all();
      return response()->json([
        'data' => $this->transform($lessons)
      ],200);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
          return response()->json([
            'error' => [
              'message' => 'Lesson does not exist'
            ]
          ],404);
        } else {
          return response()->json([
            'data' => $lesson->toArray()
          ],200);
        }
    }

    public function store(Request $request)
    {
      if (! $request::all()) 
      {
        //return error and message
        return response()->json([
              'error' => 'failed',
              'message' => 'Parameters failed to create a lesson'
          ],422);
      }

      Lesson::create($request::all());
      return response()->json([
            'status' => 'success',
            'message' => 'Lesson sucessfully created'
          ],422);
    }

    public function transform($lessons)
    {
      return array_map(function($lesson)
      {
        return [
            'title' => $lesson['title'],
            'body' => $lesson['body'],
            'active' => (boolean) $lesson['some_bool']
        ];
      }, $lessons-> toArray());
    }
}
