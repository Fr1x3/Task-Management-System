<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Task;

class SearchTaskController extends Controller
{

    /**
     *  Search for tasks by their title
     * 
     * @param Request request
     * @return Illuminate\Http\jsonResponse
     */
    public function __invoke(Request $request){

        // valiadate the search input
        $this->validate($request,[
            'search_title' => 'required| min:4'
        ]);

        $queryString = $request['search_title'];

        $tasks = Task::where('title', 'LIKE',"%$queryString%")->paginate();

        return new JsonResponse(['tasks' => $tasks]);
    }

   
}