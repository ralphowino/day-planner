<?php

namespace RalphowinoPlanner\Http\Controllers;

use Illuminate\Http\Request;
use RalphowinoPlanner\Http\Requests;
use RalphowinoPlanner\Task;
use RalphowinoPlanner\User;

class TasksController extends Controller
{

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'start_at' => ['required', 'date'],
        'due_at' => ['required', 'date'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks'] = Task::get();
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::lists('name', 'id');
        $data['statuses'] = [
            'hold' => 'hold',
            'backlog' => 'backlog',
            'selected' => 'selected',
            'started' => 'started',
            'submitted' => 'submitted',
            'accepted' => 'accepted',
            'rejected' => 'rejected',
            'completed' => 'completed'
        ];
        \Former::withRules($this->rules);
        return view('tasks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $data = $request->only([
            'name',
            'description',
            'start_at',
            'due_at',
            'assigned_to',
            'status'
        ]);
        $data['created_by'] = \Auth::user()->id;
        Task::create($data);
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['task'] = Task::findOrFail($id);
        return view('tasks.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['task'] = Task::findOrFail($id);
        $data['users'] = User::lists('name', 'id');
        $data['statuses'] = [
            'hold' => 'hold',
            'backlog' => 'backlog',
            'selected' => 'selected',
            'started' => 'started',
            'submitted' => 'submitted',
            'accepted' => 'accepted',
            'rejected' => 'rejected',
            'completed' => 'completed'
        ];
        \Former::withRules($this->rules);
        \Former::populate($data['task']);
        return view('tasks.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);
        $task = Task::findOrFail($id);
        $data = $request->only([
            'name',
            'description',
            'start_at',
            'due_at',
            'assigned_to',
            'status'
        ]);
        $task->update($data);
        return redirect(route('tasks.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect(route('tasks.index'));
    }
}
