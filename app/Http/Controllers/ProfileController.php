<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notif;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function masterme()
    {
        $user = User::find(auth()->user()->id);
        $degree = $user->degree;
        $address = $user->address;
        $talents = explode(" ", $user->talent);
        $description = $user->description;
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("ostad.profile", compact("degree", "address", "talents", "description", "unsee"));
    }

    public function mastermestoredegree(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->degree = $request->degree;
        $user->save();
        return redirect()->route("profile.master.me")->with("success", "تحصیلات شما با موفقیت اضافه شد.");
    }

    public function mastermestoreaddress(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->address = $request->degree;
        $user->save();
        return redirect()->route("profile.master.me")->with("success", "آدرس شما با موفقیت اضافه شد.");
    }

    public function mastermestoretalents(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->talent = $request->degree;
        $user->save();
        return redirect()->route("profile.master.me")->with("success", "مهارت های شما شما با موفقیت اضافه شد.");
    }
    public function mastermestoredescription(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->description = $request->degree;
        $user->save();
        return redirect()->route("profile.master.me")->with("success", "توضیحات های شما شما با موفقیت اضافه شد.");
    }

    public function studentme()
    {
        $user = User::find(auth()->user()->id);
        $degree = $user->degree;
        $address = $user->address;
        $talents = explode(" ", $user->talent);
        $description = $user->description;
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("student.profile", compact("degree", "address", "talents", "description", "unsee"));
    }

    public function studentmestoredegree(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->degree = $request->degree;
        $user->save();
        return redirect()->route("profile.student.me")->with("success", "تحصیلات شما با موفقیت اضافه شد.");
    }

    public function studentmestoreaddress(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->address = $request->degree;
        $user->save();
        return redirect()->route("profile.student.me")->with("success", "آدرس شما با موفقیت اضافه شد.");
    }

    public function studentmestoretalents(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->talent = $request->degree;
        $user->save();
        return redirect()->route("profile.student.me")->with("success", "مهارت های شما شما با موفقیت اضافه شد.");
    }
    public function studentmestoredescription(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->description = $request->degree;
        $user->save();
        return redirect()->route("profile.student.me")->with("success", "توضیحات های شما شما با موفقیت اضافه شد.");
    }


    public function showprofile($id)
    {
        $user = User::find($id);
        $degree = $user->degree;
        $address = $user->address;
        $talents = explode(" ", $user->talent);
        $description = $user->description;
        $photo = $user->profile_photo_path;
        $name = $user->name;
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("profile", compact("degree", "address", "talents", "description", "name", "photo", "id", "unsee"));
    }

    public function showprofileforstudent($id)
    {
        $user = User::find($id);
        $degree = $user->degree;
        $address = $user->address;
        $talents = explode(" ", $user->talent);
        $description = $user->description;
        $photo = $user->profile_photo_path;
        $name = $user->name;
        $unsee = Notif::where([["receiver_id", auth()->user()->id], ["status", 0]])->get();
        return view("profiles", compact("degree", "address", "talents", "description", "name", "photo", "id", "unsee"));
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
