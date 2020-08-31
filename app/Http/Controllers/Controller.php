<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Task;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        $task= new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);

    }

    public function store(Request $request)
    {
        //
        $task = new Task;
        $task->content = $request->content;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);

    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->content = $request->content;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}