<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\ClassVideo;
use Illuminate\Http\Request;

class VideoController extends Controller
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

    public function indexs($id)
    {
        $videos = ClassVideo::where("course_id", $id)->get();
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();

        return view("student.class.sessionlist", compact("videos", "unsee"));
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
        $video = new ClassVideo();
        $video->course_id = $request->course_id;
        $video->video_name = $request->video_name;
        $video->video_path = $request->video_path;
        $video->save();
        return redirect()->back()->with("success", "جلسه شما با موفقیت بارگزاری شد");
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
