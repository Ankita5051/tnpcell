<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tpr;
use App\Models\Student;
use Carbon;
use App\Models\Job;
use App\Models\Chat;
use App\Models\Message;
class StudentController extends Controller
{
    public function set(Request $req){
      
        return  $this->setsession($req->id);
    }
    protected function setsession($id){
       
         session()->put('usertype','1');
         session()->put('userid',$id);
        return response("session set");
      //  return redirect('/student');
    }
    public function studentList(){
        $students=DB::select('select * from students');
        $data=compact('students');
        return view('student-view.studentList')->with($data);
    }
    public function index(){
    
          $usertype=session()->get('usertype');
          if($usertype==3)
          {
              return redirect('/admin');
          }
          elseif($usertype==2){
              return redirect('/tpr');
         }
          elseif($usertype==1)
         {
        //    echo (session()->get('usertype'));
   //     $today = Carbon\Carbon::now();
 //$todaydate=$today->toDateString();
 //echo $todaydate;
   //  $jobs=DB::table('jobs')->whereDate('deadline',$todaydate)->get();
   
// echo $today;
// $date= Carbon\Carbon::now()->format('y-m-d');
// print($jobs);

return view('student-view.home');
         }
          else{
            session()->put('usertype','0');
    return redirect('/');
   //echo "error";
          }
      
    }
   public function studentView(){
    $jobs=Job::whereDate('created_at', '=', DB::raw('curdate()'))->where('status','active')->get();
    $data=compact('jobs');
  
    return view('student-view.index')->with($data);
   }

    public function register(){
return view('student-view.register');
    }
    public function create(Request $req){
        $req->validate([
            'name'=>'required',
            'rollno'=>'required|unique:students',
            'email'=>'required|email|unique:students',
            'gender'=>'required',
            'branch'=>'required',
            'year'=>'required',
            'password' => 'required|string|min:6'    
        ], [
    'email.required' => 'The email is required.',
    'email.email' => 'The email needs to have a valid format.',
    'email.exists' => 'The email is not registered in the system.',
    'password.required'=>'password required',
    'rollno.unique'=>'rollno already',
    'password.min'=>'min length 6',
]);
        
// $validator = Validator::make($request->all(), [
//     'password' => ['required', 'confirmed',Password::min(6)
//     ->letters()
//     ->mixedCase()
//     ->numbers()
//     ->symbols()
//     ],
// ]);
// if ($validator->fails()) {
//     return redirect()->back()
//                 ->withErrors($validator)
//                 ->withInput();
// }


// $validator = Validator::make($req->all(), $rules, $messages);
// if ($validator->fails()) {
//     $errors=$validator->errors()->all();
//     return back()->with($errors);
// }
        $student=new Student;
        $student->name=$req['name'];
        $student->rollno=$req['rollno'];
        $student->email=$req['email'];
        $student->gender=$req['gender'];
        $student->branch=$req['branch'];
        $student->year=$req['year'];
        //hash encreption $password = Hash::make('yourpassword');
$student->password=Hash::make($req['password']);
        $student->save();
        session()->put('username',$req->name);
        session()->put('userid',$req->email);
        session()->put('usertype','1');
        //ō
        return redirect('/student');
    }
    public function login(Request $req){

        $userid=$req->userid;
        $pass=$req->password;
      //$hashpass=Hash::make($pass);
        $stdn_pass=DB::select("select password from students where email='$userid'");
        if(isset($stdn_pass[0])){
$userpass= $stdn_pass[0]->password;
//echo $hashpass;
        if(Hash::check($pass,$userpass)){
            echo "hii";
        $stdn=DB::select("select * from students where email='$userid'");
        
        //print_r($stdn);
        session()->put('username',$stdn[0]->name);
        session()->put('userid',$stdn[0]->email);
        session()->put('usertype','1');
    return redirect('/student');
        }
   //     echo "fail";
     else return back();
    }
     else return back();
        
    }


public function destroyStudent($id){
    $remChatid=Chat::where('sender_id',$id)->select('id')->get();
    $remChat=Chat::where('sender_id',$id)->select('id');
//dd($remChats[0]->id);
    $remMess=Message::where('replyer_id',$id)->orWhere('chat_id',$remChatid[0]->id);
  //dd($remMess);
  $remMess->delete();
  $remChat->delete();
    $student=Student::find($id);
   $student->delete();
    return response()->json(['success'=>true,'msg'=>"student deleted successfully!"]);
}
    public function profile(){
        return view('student-view.profile');
    }

    public function delete(Request $req){
        $user=Student::find($req->id);
        if(Hash::check($req->password,$user->password)){
            $user->delete();
            session()->flush();
            return response()->json(['success'=>true,'msg'=>'Account deleted successfully!']);
        }else{
            return response()->json(['success'=>false,'msg'=>'Invalid password']);
        }
    }


    public function update(Request $req){
        $validate=Validator::make($req->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'email'=>'required|email|string',
            'contact'=>'required',
            'rollno'=>'required|integer',
            'branch'=>'required|string|max:3|min:2',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $user=Student::find($req->id);
        $user->name=$req->name;
        if($user->email != $req->email){
        $user->is_verified=0;
        }
        $user->email=$req->email;
        $user->contact=$req->contact;
        $user->rollno=$req->rollno;
        $user->branch=$req->branch;
        $user->year=$req->year;
        
        $user->save();


        return response()->json(['success'=>true,'msg'=>'data updated successfully!','data'=>$user]);
    }

}
