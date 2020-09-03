<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $request->validate([
            'status' => 'requires|max:10',
            'content' => 'requires|max:255',
            ]);
        //
        $task = new Task;
        $task->status = $request->status;
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
        $request->validate([
            'status' => 'requires|max:10',
            'content' => 'requires|max:255',
            ]);

        $task = Task::findOrFail($id);
        $task->status = $request->status;
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
