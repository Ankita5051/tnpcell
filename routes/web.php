<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\Tprcontroller;
use App\Http\Controllers\JobController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlacementController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\NoticeController;
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
Route::post('/broadcasting/auth', function () {
    return Auth::user();
 });
Route::get('/path', [UserController::class,'path']);

Route::get('/', [UserController::class,'index']);
// Route::get('/job',function(){
//     return view('pages.job');
// });
Route::get('/job',[JobController::class,'displaJob']);
// Route::get('/internship',function(){
//     return view('pages.internship');
// });
Route::get('/jobdetail/{id}',[JobController::class,'findJob']);
Route::post('/job/filter',[JobController::class,'jobFilter']);
Route::post('/internship/filter',[JobController::class,'internshipFilter']);
Route::get('/internship',[JobController::class,'desplaIternship']);

// Route::get('/student_view',function(){
//     return view('student-view.index');
// });
Route::get('/student_view',[StudentController::class,'studentView']);
Route::get('/admin/students',[StudentController::class,'studentList']);
Route::get('/admin',[admincontroller::class,'index']);
Route::get('/admin/remove-student/{id}',[StudentController::class,'destroyStudent']);
Route::post('/admin/login',[admincontroller::class,'login']);

Route::get('/aloginform',function(){
return view('include.aloginform');
});
Route::get('/sloginform',function(){
    return view('include.sloginform');
    });
Route::get('/register',[StudentController::class,'register']);
Route::get('/addtpr',function(){
    return view('include.tprform');
});
Route::post('/addtpr',[Tprcontroller::class,'create']);

Route::get('/admin/removetpr/{id}',[admincontroller::class,'removetpr']);


Route::get('/job_Post_tab',[admincontroller::class,'jobpost']);

// Route::get('/job_tab',function(){
//     return view('admin-view.display_job');
// });
Route::get('/job_tab',[JobController::class,'index']);
// Route::get('/intern_tab',function(){
//     return view('admin-view.display_internship');
// });
Route::get('/intern_tab',[JobController::class,'internship']);

Route::get('/tpr_tab',[admincontroller::class,'tpr_tab']);
Route::get('/ntf_tab',function(){
    return view('admin-view.notification');
});
Route::get('/prfl_tab',[Tprcontroller::class,'profile']);
    //return view('admin-view.profile');}

// Route::get('/pass_tab',function(){
//     return view('admin-view.pass_change');
// });

Route::post('/create_job',[JobController::class,'create']);

Route::get('get-all-session',function(){
$session=session()->all();
echo "<pre>";
print_r($session);
echo("</pre>");
});

Route::get("set-session",function(Request $req){
$req->session()->put('user','ankita');
return redirect('get-all-session');
});
Route::get("destroy-session",function(){
    session()->forget('usertype');
    return redirect('get-all-session');
});

Route::get('/logout',function(){
    session()->flush();
    return redirect('/');
});

Route::get('/job/remove/{id}',[JobController::class,'destroy']);
Route::get('job/detail/{id}',[JobController::class,'show']);
Route::post('/job/update/{id}',[JobController::class,'update']);
Route::get('/job/search/{key}',[JobController::class,'search']);

Route::post('/student/create',[StudentController::class,'create']);

Route::get('/student',[StudentController::class,'index']);
//for session set
Route::get('student/set/{id}',[StudentController::class,'set']);
Route::post('/student',[StudentController::class,'login']);
Route::get('/student/profile',[StudentController::class,'profile']);

Route::get('student-home',function(){
    return view('student-view.index');
});
Route::post('student/delete',[StudentController::class,'delete']);
Route::post('student/update',[StudentController::class,'update']);
Route::get('/tpr',[Tprcontroller::class,'index']);
Route::post('/tpr',[Tprcontroller::class,'login']);
Route::get('/tprlogin',function(){
    return view('include.tprloginform');
});
Route::get('tpr/detail/{id}',[Tprcontroller::class,'tprDetail']);
Route::post('/tpr/edit-detail',[Tprcontroller::class,'UpdateDetail']);
Route::get('admin/forgetpass',[admincontroller::class,'forget']);

Route::post('admin/update',[admincontroller::class,'update']);
Route::post('tpr/update',[tprcontroller::class,'update']);

Route::get('/placement_view',[PlacementController::class,'index']);

Route::get('/add-placement',[PlacementController::class,'createview']);

Route::post('/create-record',[PlacementController::class,'createRecord']);
Route::get('/edit-view/{id}',[PlacementController::class,'updateView']);
Route::get('/remove-record/{id}',[PlacementController::class,'destroyRecord']);

Route::get('/download/{file}',[JobController::class,'download']);
Route::post('/update-record/{id}',[PlacementController::class,'editRecord']);


///resourece route

// Route::get('/query',function(){
//     return view('pages.query');
// });
//Route::get('/query-form/{id}',[ChatController::class,'quryFrmLoad']);
// Route::get('/sendQuery',[ChatController::class,'saveQuery']);
Route::resource('/query',ChatController::class);
Route::get('/query/{id}/query-form/',[ChatController::class,'quryFrmLoad'])->name('query.quryFrmLoad');
Route::post('query/Query-list',[ChatController::class,'queryList'])->name('query.list');
Route::post('query/save-chat',[ChatController::class,'storeMessage'])->name('query.save');
Route::get('query/get-all-message',[ChatController::class,'getAllMessage'])->name('query.getmess');



// Route::get('/set_notification',function(){
//     return view('pages.setnotification');
// });

 Route::resource('/set_notification',PreferenceController::Class);
//  Route::get('/set_notification',[PreferenceController::Class,'mailtest'])->name('send.mail');




Route::get('/pass_tab',[admincontroller::class,'notice'])->name('notice');

// Route::post('/notice-store',[admincontroller::class,'noticeStore'])->name('notice.store');

// Route::get('/notice-store/delete/{id}',[admincontroller::class,'delete'])->name('notice.delete');

Route::resource('/notice',NoticeController::class);