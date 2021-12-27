<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use Illuminate\Http\Request;

class StudentMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $notifications = Notif::where("sender_id", auth()->user()->id)->orWhere("receiver_id", auth()->user()->id)->orderby("created_at", "desc")->get();
        $unseen = count(Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get());
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.messages.index", compact("notifications", "unseen", "unsee"));
    }

    public function sent()
    {
        // dd("hi");
        $user = auth()->user();
        $notifications = Notif::where([["sender_id", auth()->user()->id]])->orderBy("created_at", "desc")->get();
        $unseen = count(Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get());
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.messages.sent", compact("notifications", "unseen", "unsee"));
    }

    public function received()
    {

        $user = auth()->user();
        $notifications = Notif::where([["receiver_id", auth()->user()->id]])->orderBy("created_at", "desc")->get();
        $unseen = count(Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get());
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.messages.received", compact("notifications", "unseen", "unsee"));
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
        $notif = new Notif();
        $notif->text = $request->text;
        $notif->subject = $request->subject;
        $notif->receiver_id = $request->receiver_id;
        $notif->sender_id = $request->sender_id;
        $notif->save();
        return redirect()->route("student.message.sent")->with("success", "پیام شما با موفقیت ارسال شد");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notif = Notif::find($id);
        $notif->status = 1;
        $notif->save();
        $unseen = count(Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get());
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.messages.show", compact("notif", "unseen", "unsee"));
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
        $notif = Notif::find($id);
        $notif->delete();
        return redirect()->route("student.message.index")->with("danger", "پیام شما با موفقیت حذف شد");
    }
}
