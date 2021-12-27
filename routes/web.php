<?php


use Illuminate\Support\Facades\Route;
use Classiebit\Addchat\Facades\Addchat;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MasterMessageController;
use App\Http\Controllers\StudentMessageController;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Addchat::routes();

route::get("/", function () {
    return redirect("login");
});
Route::prefix("master")->middleware(['auth:sanctum', 'verified', 'master'])->group(function () {
    route::get("/", [MasterController::class, "index"])->name("master");
    route::get("show/prof/{id}", [ProfileController::class, "showprofile"])->name("prof.show");
    route::get("students", [MasterController::class, "students"])->name("master.students");
    route::post("block", [MasterController::class, "block"])->name("master.block.students");
    route::get("showblock", [MasterController::class, "showblock"])->name("master.show.block.students");
    route::delete("destroyblock/{id}", [MasterController::class, "destroyblock"])->name("master.show.block.students.destroy");

    route::post("task", [TaskController::class, "store"])->name("master.task.store");
    route::delete("taskdelete/{id}", [TaskController::class, "destroy"])->name("master.task.destroy");
    route::post("taskupdate/{id}", [TaskController::class, "update"])->name("master.task.update");


    Route::prefix("dashboard")->group(function () {
        route::get("/", [MasterController::class, "dashboard"])->name("dashboard");
    });

    Route::prefix("profile")->group(function () {
        route::get("/myprofile", [ProfileController::class, "masterme"])->name("profile.master.me");
        route::post("/myprofile/save/degree", [ProfileController::class, "mastermestoredegree"])->name("profile.master.me.store.degree");
        route::post("/myprofile/save/address", [ProfileController::class, "mastermestoreaddress"])->name("profile.master.me.store.address");
        route::post("/myprofile/save/talent", [ProfileController::class, "mastermestoretalents"])->name("profile.master.me.store.talent");
        route::post("/myprofile/save/description", [ProfileController::class, "mastermestoredescription"])->name("profile.master.me.store.description");
    });
    Route::prefix("uploaded")->group(function () {
        route::get("/{id}", [UploadController::class, "index"])->name("master.upload.index");
        route::get("/download/{id}", [UploadController::class, "download"])->name("master.file.download");
        route::post("/store", [UploadController::class, "store"])->name("master.upload.store");
        route::delete("/destroy/{id}", [UploadController::class, "destroy"])->name("master.upload.destroy");
    });

    Route::prefix("class")->group(function () {
        route::get("/", [ClassController::class, "index"])->name("master.class.index");
        route::get("/create", [ClassController::class, "create"])->name("master.class.create");
        route::post("/store", [ClassController::class, "store"])->name("master.class.store");
        route::get("/edit/{id}", [ClassController::class, "edit"])->name("master.class.edit");
        route::post("/update/{id}", [ClassController::class, "update"])->name("master.class.update");
        route::delete("/destroy/{id}", [ClassController::class, "destroy"])->name("master.class.destroy");
        route::get("/timecreate/{id}", [ClassController::class, "timecreate"])->name("master.class.time.create");
        route::post("/timestore/{id}", [ClassController::class, "timestore"])->name("master.class.time.store");
        Route::prefix("videoes")->group(function () {
            route::get("/", [VideoController::class, "index"])->name("master.video.index");
            route::delete("/destroy/{id}", [ClassController::class, "destroy"])->name("master.class.destroy");
            route::post("/store", [VideoController::class, "store"])->name("master.video.store");
        });
    });

    Route::prefix("messages")->group(function () {
        route::get("/", [MasterMessageController::class, "index"])->name("master.message.index");
        route::get("/sent", [MasterMessageController::class, "sent"])->name("master.message.sent");
        route::get("/received", [MasterMessageController::class, "received"])->name("master.message.received");
        route::get("/show/{id}", [MasterMessageController::class, "show"])->name("master.message.show");
        route::get("/create", [MasterMessageController::class, "create"])->name("master.message.create");
        route::post("/store", [MasterMessageController::class, "store"])->name("master.message.store");
        route::get("/edit/{id}", [MasterMessageController::class, "edit"])->name("master.message.edit");
        route::post("/update/{id}", [MasterMessageController::class, "update"])->name("master.message.update");
        route::delete("/destroy/{id}", [MasterMessageController::class, "destroy"])->name("master.message.destroy");
    });
});













Route::prefix("student")->middleware(['auth:sanctum', 'verified', 'student'])->group(function () {
    route::get("/", [StudentController::class, "index"])->name("student");
    route::get("show/profs/{id}", [ProfileController::class, "showprofileforstudent"])->name("profs.show");
    route::post("task", [TaskController::class, "store"])->name("user.task.store");

    route::post("task", [TaskController::class, "store"])->name("student.task.store");
    route::delete("taskdelete/{id}", [TaskController::class, "destroy"])->name("student.task.destroy");
    route::post("taskupdate/{id}", [TaskController::class, "update"])->name("student.task.update");

    Route::prefix("messages")->group(function () {
        route::get("/", [StudentMessageController::class, "index"])->name("student.message.index");
        route::get("/sent", [StudentMessageController::class, "sent"])->name("student.message.sent");
        route::get("/received", [StudentMessageController::class, "received"])->name("student.message.received");
        route::get("/show/{id}", [StudentMessageController::class, "show"])->name("student.message.show");
        route::get("/create", [StudentMessageController::class, "create"])->name("student.message.create");
        route::post("/store", [StudentMessageController::class, "store"])->name("student.message.store");
        route::get("/edit/{id}", [StudentMessageController::class, "edit"])->name("student.message.edit");
        route::post("/update/{id}", [StudentMessageController::class, "update"])->name("student.message.update");
        route::delete("/destroy/{id}", [StudentMessageController::class, "destroy"])->name("student.message.destroy");
    });

    Route::prefix("profile")->group(function () {
        route::get("/myprofile", [ProfileController::class, "studentme"])->name("profile.student.me");
        route::post("/myprofile/save/degree", [ProfileController::class, "studentmestoredegree"])->name("profile.student.me.store.degree");
        route::post("/myprofile/save/address", [ProfileController::class, "studentmestoreaddress"])->name("profile.student.me.store.address");
        route::post("/myprofile/save/talent", [ProfileController::class, "studentmestoretalents"])->name("profile.student.me.store.talent");
        route::post("/myprofile/save/description", [ProfileController::class, "studentmestoredescription"])->name("profile.student.me.store.description");
    });
    Route::prefix("class")->group(function () {
        route::get("/", [ClassController::class, "sindex"])->name("student.class.index");
        Route::prefix("videoes")->group(function () {
            route::get("/{id}", [VideoController::class, "indexs"])->name("student.video.index");
        });
    });
    Route::prefix("uploaded")->group(function () {
        route::get("/{id}", [UploadController::class, "indexs"])->name("student.upload.index");
        route::get("/download/{id}", [UploadController::class, "download"])->name("student.file.download");
    });
});
