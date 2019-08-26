<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Task;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;

//use Illuminate\Database\Eloquent\Model;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       // $tasks = Task::simplepaginate(3);
       //return view('tasks.index', compact('tasks'));

            $task = Task::all();
            //$id = -1001369245082;

            $date = new Carbon();
            foreach($task as $t){
                $datetime1 = strtotime($date);
                $datetime2 = strtotime($t->to_do_date);
                $secs = $datetime2 - $datetime1;
                $days = $secs / 86400;
                if($days<10){
                        $test = "$t->name\n"
                        ."$t->description\n";
                        Telegram::sendMessage([
                            'chat_id' => env('TELEGRAM_CHANNEL_ID','-1001369245082'),
                            'parse_mode' => 'HTML',
                            'text' => $test
    
                        ]);
                } 

            }

            $task = Task::orderBy('to_do_date','asc')->paginate(5);
            return view('tasks.index')->with('tasks',$task);

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:1000|min:10',
            'to_do_date' => 'required|date'
        ]);
        $task = new Task;
       //echo $request['name'];
       //echo $request['discription'];
       //echo $request['todo_date'];
        $task->name = $request->name;
        $task->description=$request->description;
        $task->to_do_date=$request->to_do_date;

        $task->save();

        Session::flash('success', 'Created Task Successfully');
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->with('task',$task);
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
        $this->validate($request,[
            'name' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:1000|min:10',
            'to_do_date' => 'required|date'
        ]);
        $task = Task::find($id);
       //echo $request['name'];
       //echo $request['discription'];
       //echo $request['todo_date'];
        $task->name = $request->name;
        $task->description=$request->description;
        $task->to_do_date=$request->to_do_date;

        $task->save();

        Session::flash('success', 'Saved Task Successfully');
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        Session::flash('success','Deleted Task Successully');
        return redirect()->route('task.index');
    }
}
