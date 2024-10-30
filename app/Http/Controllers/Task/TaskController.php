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

    /**
     *  Search for a specific task
     * 
     * @param string id
     * 
     *  @return Illuminate\Http\jsonResponse
     */
    public function show(string $id){

        $task = Task::find($id);
        if($task == null){
            return new JsonResponse([
                'message' => 'The task being searched cannot be found'
            ], 404);
        }

        return new JsonResponse([
            'task' => $task
        ]);
    }

    /**
     *  update the task information
     * 
     *  @param string id
     *  @param Request request
     * 
     *  @return Illuminate\Http\jsonResponse
     */
    public function update(Request $request, string $id){

        // validate the form data in request
        $this->validate($request, [
            'title' => 'max:255|unique:tasks',
            'description' => 'string',
            'status' => 'required|in:pending,overdue,canceled,completed',
            'due_date' => 'date|date_format:Y-m-d|after:created_at'
        ]);

        // find the task to be updated
        $task = Task::find($id);

        // thow error if task doesnt exist
        if($task == null){
            return new JsonResponse(['No such task exists'], 404);
        }

        // update value in the database
        $newTask = $task->update([
            'title' => $request['title'] ?? $task->title,
            'description' => $request['description'] ?? $task->description,
            'status' => $request['status'] ?? $task->status,
            'due_date' => $request['due_date'] ?? $task->due_date
        ]);

        // return response
        return new JsonResponse([
            'message' => 'Task updated succesfully'
        ]);
        
    }

    /**
     *  delete task record from storage
     * 
     * @param string id
     * 
     * @return Illuminate\Http\jsonResponse
     */
    public function destroy(string $id){
        //delete task record
        $task = Task::destroy($id);

        if(!$task){
            return new JsonResponse([
                'message' => 'Nothing was deleted'
            ],404);
        }

        return new JsonResponse([
            'message' => 'Task successfully deleted'
        ]);
    }
}