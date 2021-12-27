<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Notif;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $coursenumber = count($user->courses);
        $courses = $user->courses;
        $nowtime = now('Asia/Tehran');
        $incomingclasses = array();
        foreach ($courses as $course) {
            if ($course->start_date <= $nowtime && $course->end_date >= $nowtime) {
                array_push($incomingclasses, $course);
            }
        }
        $tasks = Task::where([["user_id", auth()->user()->id]])->orderBy("date", "asc")->get();
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.index", compact("coursenumber", "incomingclasses", "tasks", "unsee", "courses"));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
