<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestForm;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\Validation;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\CommonMark\Node\Inline\Newline;
use Symfony\Component\HttpFoundation\RedirectResponse;

use function PHPUnit\Framework\returnSelf;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::orderBy('created_at', 'DESC')->get();

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task.name' => ['required', 'string', 'max:5', 'regex:/^[a-zA-Z]+$/'],
            'task.description' => ['required', 'string', 'max:15', 'regex:/^[a-zA-Z]+$/'],
        ]);

        $newTask = new Task();
        $newTask->name = $validatedData['task']['name'];
        $newTask->description = $validatedData['task']['description'];
        $newTask->save();

        return $newTask;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oldTask = Task::find($id);
        if ($oldTask) {
            $oldTask->completed = $request->task['completed'] ? true : false;
            $oldTask->completed_at = $request->task['completed'] ? Carbon::now() : null;
            $oldTask->save();
            return $oldTask;
        }
        return "Task not found";

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oldTask = Task::find($id);
        if ($oldTask) {
            $oldTask->delete();
            return "Task successfully deleted.";
        }
        return "Task not found";
    }
}