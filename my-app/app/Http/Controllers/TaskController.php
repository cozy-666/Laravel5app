<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::getActiveTasks();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $request -> validate([
            'task_name' => 'required|max:255',
            // 'due_date' => 'required|date',
        ]);
        Task::create([
            'task_name' => $request->task_name,
            'due_date' => $request->due_date,
        ]);
        return redirect()->route('tasks.index');
    }

    public function maskAsDeleted($id)
    {
        Task::maskAsDeleted($id);
        return redirect()->route('tasks.index');
    }

    public function trash()
    {
        $tasks = Task::getTrashTasks();
        return view('tasks.trash', ['tasks' => $tasks]);
    }

    public function recover($id)
    {
        Task::recoverTask($id);
        return redirect()->route('tasks.index');
    }

    public function deleteTrash()
    {
        Task::deleteTrashTaskPermanently();
        return redirect()->route('tasks.index');
    }
}
