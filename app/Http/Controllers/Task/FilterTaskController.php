<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class FilterTaskController extends Controller
{

    /**
     *  Display a list of tasks
     * 
     * @param Int page_size
     * @return Illuminate\Http\jsonResponse
     */
    public function __invoke(Request $request){
        // check if it has status or due_date
        if(!$request->has('status') && !$request->has('due_date')){
            return new JsonResponse([
                'message' => 'Cannot filter without data'
            ], 400);
        }

        // validate status and due_date
        $this->validate($request,[
            'status' => 'in:pending,completed,canceled,overdue',
            'due_date' => 'date|date_format:Y-m-d'
        ]);

        $status = $request['status'];
        $due_date = $request['due_date'];

        $filteredTask = DB::table('tasks')
                            ->whereDate('due_date', $due_date)
                            ->orWhere('status', $status)
                            ->paginate();

        return $filteredTask;
    }

   
}