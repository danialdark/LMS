<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Facades\Verta;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // making endtime persian to latin date
        $date = $request->date;
        $dateyear = intval(substr($date, 0, 4));
        $datemonth = intval(substr($date, 5, 7));
        $dateday = intval(substr($date, 8, 11));
        $datetimearray = Verta::getGregorian($dateyear, $datemonth, $dateday);
        $finaldate = $datetimearray[0] . "-" . $datetimearray[1] . "-" . $datetimearray[2];
        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->name = $request->name;
        $task->date = $finaldate;
        $task->time = $request->time;
        $task->save();
        return redirect()->route("master")->with("success", 'رویداد شما با موفقیت ساخته شد.');
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
        //
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
        $date = $request->date;
        $dateyear = intval(substr($date, 0, 4));
        $datemonth = intval(substr($date, 5, 7));
        $dateday = intval(substr($date, 8, 11));
        $datetimearray = Verta::getGregorian($dateyear, $datemonth, $dateday);
        $finaldate = $datetimearray[0] . "-" . $datetimearray[1] . "-" . $datetimearray[2];
        $task = Task::find($id);
        $task->name = $request->name;
        $task->date = $finaldate;
        $task->time = $request->time;
        $task->save();
        return redirect()->route("master")->with("success", 'رویداد شما با موفقیت ویرایش شد.');
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
        return redirect()->back()->with('danger', "رویداد شما با موفقیت حذف شد.");
    }
}
