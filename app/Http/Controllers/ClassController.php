<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Notif;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseInformation;
use Hekmatinasser\Verta\Facades\Verta;




class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where("master_id", auth()->user()->id)->get();
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("ostad.class.index", compact("courses", "unsee"));
    }

    public function sindex()
    {
        $user = User::find(auth()->user()->id);
        $courses = $user->courses;

        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.class.index", compact("courses", "unsee"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();

        return view("ostad.class.create", compact("unsee"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // making starttime persian to latin date
        $starttime = $request->start_date;
        $startyear = intval(substr($starttime, 0, 4));
        $startmonth = intval(substr($starttime, 5, 7));
        $startday = intval(substr($starttime, 8, 11));
        $starttimearray = Verta::getGregorian($startyear, $startmonth, $startday);
        $finalstartdate = $starttimearray[0] . "-" . $starttimearray[1] . "-" . $starttimearray[2];

        // making endtime persian to latin date
        $endtime = $request->end_date;
        $endyear = intval(substr($endtime, 0, 4));
        $endmonth = intval(substr($endtime, 5, 7));
        $endday = intval(substr($endtime, 8, 11));
        $endtimearray = Verta::getGregorian($endyear, $endmonth, $endday);
        $finalenddate = $endtimearray[0] . "-" . $endtimearray[1] . "-" . $endtimearray[2];

        // saving data
        $course = new Course();
        $course->name = $request->name;
        $course->student_link = $request->student_link;
        $course->master_link = $request->master_link;
        $course->master_id = auth()->user()->id;
        $course->start_date = $finalstartdate;
        $course->end_date = $finalenddate;
        $course->save();
        return redirect()->route("master")->with("success", 'کلاس شما با موفقیت ساخته شد لطفا برای تکمیل آن به بخش کلاس های من در منو بروید.');
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
        $course = Course::find($id);
        $endtime = $course->end_date;
        $endyear = intval(substr($endtime, 0, 4));
        $endmonth = intval(substr($endtime, 5, 7));
        $endday = intval(substr($endtime, 8, 11));
        $endtimearray = Verta::getJalali($endyear, $endmonth, $endday);
        $finalenddate = $endtimearray[0] . '-' . $endtimearray[1] . '-' . $endtimearray[2];

        $starttime = $course->start_date;
        $startyear = intval(substr($starttime, 0, 4));
        $startmonth = intval(substr($starttime, 5, 7));
        $startday = intval(substr($starttime, 8, 11));
        $starttimearray = Verta::getJalali($startyear, $startmonth, $startday);
        $finalstartdate = $starttimearray[0] . '-' . $starttimearray[1] . '-' . $starttimearray[2];
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("ostad.class.edit", compact("course", "finalstartdate", "finalenddate", "unsee"));
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

        // making starttime persian to latin date
        $starttime = $request->start_date;
        $startyear = intval(substr($starttime, 0, 4));
        $startmonth = intval(substr($starttime, 5, 7));
        $startday = intval(substr($starttime, 8, 11));
        $starttimearray = Verta::getGregorian($startyear, $startmonth, $startday);
        $finalstartdate = $starttimearray[0] . "-" . $starttimearray[1] . "-" . $starttimearray[2];

        // making endtime persian to latin date
        $endtime = $request->end_date;
        $endyear = intval(substr($endtime, 0, 4));
        $endmonth = intval(substr($endtime, 5, 7));
        $endday = intval(substr($endtime, 8, 11));
        $endtimearray = Verta::getGregorian($endyear, $endmonth, $endday);
        $finalenddate = $endtimearray[0] . "-" . $endtimearray[1] . "-" . $endtimearray[2];

        $course = Course::find($id);
        $course->name = $request->name;
        $course->start_date = $finalstartdate;
        $course->end_date = $finalenddate;
        $course->save();
        return redirect()->route("master.class.index")->with("success", 'اطلاعات کلاس شما با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->back()->with('danger', "کلاس شما با موفقیت حذف شد.");
    }




    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function timecreate($id)
    {
        $course = Course::find($id);
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("ostad.class.time", compact("course", "unsee"));
    }

    public function timestore(Request $request, $id)
    {
        $courseinfo = new CourseInformation();
        $courseinfo->course_id = $id;
        $courseinfo->day_name = $request->time;
        $courseinfo->start_time = $request->startclock;
        $courseinfo->end_time = $request->endclock;
        $courseinfo->save();
        return redirect()->route("master.class.index")->with("success", 'ساعت کلاس شما با موفقیت اضافه شد برای مشاهده آن از روی دکمه مشخصات گزینه مشاهده مشخصات کلاس را انتخاب کنید.');
    }
}
