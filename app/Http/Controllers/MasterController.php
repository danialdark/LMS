<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use App\Models\ClassInformation;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\Notif;
use App\Models\Course;
use App\Models\CourseFile;
use App\Models\CourseInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Facades\Verta;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coursenumber = count(Course::where("master_id", auth()->user()->id)->get());
        $courses = Course::where("master_id", auth()->user()->id)->get();
        $usernumber = 0;
        foreach ($courses as $course) {
            $usernumber += count($course->users);
        }
        $nowtime = now('Asia/Tehran');
        $incomingclasses = Course::where([["start_date", "<=", $nowtime], ["end_date", ">=", $nowtime], ["master_id", auth()->user()->id]])->get();
        $tasks = Task::where([["user_id", auth()->user()->id]])->orderBy("date", "asc")->get();
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("ostad.index", compact("coursenumber", "usernumber", "tasks", "courses", "unsee", "incomingclasses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    public function students()
    {
        $courses = Course::where("master_id", auth()->user()->id)->get();
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view('ostad.students', compact("unsee", "courses"));
    }

    public function block(Request $request)
    {
        $blockdata = new BlockedUser();
        $blockdata->user_id = $request->user_id;
        $blockdata->course_id = $request->course_id;
        $blockdata->master_id = $request->master_id;
        $blockdata->save();
        $user = User::find($request->user_id);
        $user->courses()->detach($request->course_id);
        return redirect()->route("master.students")->with("success", "دانشجو با موفقیت از کلاس حذف شد.");
    }

    public function showblock(Request $request)
    {
        $users = BlockedUser::where("master_id", auth()->user()->id)->get();
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("ostad.blocked", compact("users", "unsee"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Course::find($request->class_id);
        $info = new CourseFile();
        $info->course_id = $request->class_id;
        $info->file_name = $request->file_name;
        $extension = $request->file->extension();
        $name = time() . "." . $extension;
        $filename = $course->name . "." . $request->class_id;
        if ($extension == "png" || $extension == "jpeg" || $extension == "tmp") {
            $request->file->move(public_path("assets/uploadedfiles/photos/$filename/"), $name);
            $info->file_path = "assets/uploadedfiles/photos/$filename/" . $name;
        }
        if ($extension == "PDF" || $extension == "pdf") {
            $request->file->move(public_path("assets/uploadedfiles/Pdfs/$filename/"), $name);
            $info->file_path = "assets/uploadedfiles/Pdfs/$filename/" . $name;
        }
        $info->save();
        return redirect()->route("master")->with("success", "فایل شما با موفقیت آپلود شد.");
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

    public function destroyblock($id)
    {
        $user = BlockedUser::find($id);
        $user->delete();
        return redirect()->route("master.show.block.students")->with("success", "دانشجو با موفقیت از لیست مسدودی ها حذف شد.");
    }
}
