<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskModel;
    private $projectModel;

    public function __construct()
    {
        $this->taskModel = new Task();
        $this->projectModel = new Project();
    }

    /**
     *  Display a lists of tasks.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = $this->taskModel->getAllData($request->all());
        $projects = $this->projectModel->pluck('name', 'id');
        return view('tasks.index', compact('tasks', 'projects'));
    }


    /**
     * Update the priority order of the tasks
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function taskPriorityChange(Request $request)
    {
        $data = $request->input('tasks');
        foreach ($data as $index => $id) {
            $this->taskModel->where('id', $id)->update(['priority' => $index]);
        }

        return response()->json([
            'message' => 'Task priority changed successfully.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = $this->projectModel->pluck('name', 'id');
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required'
        ]);

        $data = $request->all();
        $data['priority'] = $this->taskModel->getNextPriority();
        $this->taskModel->create($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->taskModel->find($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->taskModel->find($id);
        $projects = $this->projectModel->pluck('name', 'id');
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required'
        ]);

        $task = $this->taskModel->find($id);
        $task->update($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $task = $this->taskModel->find($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }
}
