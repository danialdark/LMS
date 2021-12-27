<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\Course;
use App\Models\CourseFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        $Uploadedfiles = CourseFile::where("course_id", $id)->get();
        return view("ostad.upload.index", compact("unsee", "Uploadedfiles"));
    }


    public function indexs($id)
    {
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        $Uploadedfiles = CourseFile::where("course_id", $id)->get();
        return view("student.upload.index", compact("unsee", "Uploadedfiles"));
    }

    public function download($id)
    {
        $file = CourseFile::find($id);
        $path = $file->file_path;
        return response()->download($path);
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
        $course = Course::find($request->class_id);
        $info = new CourseFile();
        $info->course_id = $request->class_id;
        $info->file_name = $request->file_name;
        $extension = $request->file->extension();
        $name = time() . "." . $extension;
        $filename = $course->name . "." . $request->class_id;
        if ($extension == "png" || $extension == "jpeg" || $extension == "tmp" || $extension == "jpg") {
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
        $file = CourseFile::find($id);
        File::delete($file->file_path);
        $file->delete();
        return redirect()->back()->with("danger", "فایل شما با موفقیت حذف شد");
    }
}
