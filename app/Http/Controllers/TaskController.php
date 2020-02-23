<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\TaskCreate;
use App\Http\Requests\TaskEdit;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Folder $folder)
    {
        $folders = Auth::user()->folders()->get();

        $tasks = $folder->tasks()->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(Folder $folder)
    {
        return view('tasks.create',[
            'folder_id' => $folder->id,
        ]);
    }

    public function create(Folder $folder, TaskCreate $request, Task $task)
    {
        $task->title = $request->title;
        $task->limit_date = $request->limit_date;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    public function showEditForm(Folder $folder, Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function edit(Folder $folder, Task $task, TaskEdit $request)
    {
        $task->title = $request->title;
        $task->status = $request->status;
        $task->limit_date = $request->limit_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }
}
