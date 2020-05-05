<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        return view("index");
    }

    public function store() {
        $storeTask = new Task();

        $storeTask->user_id = auth()->user()->id;
        $storeTask->task = request()->input("task");

        request()->validate([
            'task' => "required|min:2|max:100",
        ]);

        $storeTask->save();

        return redirect("/");
    }

    public function edit($id) {
        $editTask = Task::find($id);

        return view("edit", compact("editTask"));
    }

    public function update($id) {
        $updateTask = Task::find($id);

        $updateTask->user_id = auth()->user()->id;
        $updateTask->task = request()->input("updateTask");

        $updateTask->save();

        return redirect("/");
    }

    public function delete($id) {
        $deleteTask = Task::find($id);

        $deleteTask->delete();

        return redirect("/");
    }
}
