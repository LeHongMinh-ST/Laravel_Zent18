<?php

namespace App\Http\Controllers\Frontend;

use App\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::all();
//        $tasks = Task::where('status',1)
//            ->orderBy('deadline','desc')
//            ->take(1)
//            ->get();
        return view('home')->with(['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $data = $request->all();
        $task->name = $data['name'];
        $task->contents = $data['content'];
        $task->status = $data['status'];
        $task->deadline = $data['deadline'];
        $task->priority = $data['priority'];
        $task->save();

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
//        $task = Task::where('id', $id)->first();
//        $task = Task::findOrFail($id);
        return view('detail')->with(['task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('update')->with(['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $data = $request->all();
        $task->name = $data['name'];
        $task->contents = $data['content'];
        $task->status = $data['status'];
        $task->deadline = $data['deadline'];
        $task->priority = $data['priority'];
        $task->save();

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index');
    }

    public function complete($id)
    {
        $task = Task::find($id);
        $task->status = 2;
        $task->save();
        return redirect()->route('task.index');
    }

    public function reComplete($id)
    {
        $task = Task::find($id);
        $task->status = 1;
        $task->save();
        return redirect()->route('task.index');
    }
}
