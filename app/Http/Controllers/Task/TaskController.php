<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Task;

class TaskController extends Controller
{

    /**
     *  Display a list of tasks
     * 
     * @param Int page_size
     * @return Illuminate\Http\jsonResponse
     */
    public function index(Request $request){

        // customize number of task in each pagination
        $pageSize = $request->page_size ?? 20;

        $tasks = Task::query()->paginate($pageSize);

        return new JsonResponse(['tsks' => $tasks]);
    }

    /**
     *  Store new task in the db
     * 
     *  @param \Illuminate\Http\Request $request
     * 
     *  @return Illuminate\Http\jsonResponse
     */
    public function store(Request $request){

        // validate request input
        $this->validate($request, [
            'title' => 'required|unique:tasks|max:255',
            'description' => 'string',
            'due_date' => 'required|date|date_format:Y-m-d|after:now'
        ]);
        
        // add a new task to db
        $task = Task::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'due_date' => $request['due_date'],
        ]);

        // return the task value as response
       
        return new JsonResponse([
            "message" => "New task successfully added",
            "task" => $task
        ], 201);
    }

    
}