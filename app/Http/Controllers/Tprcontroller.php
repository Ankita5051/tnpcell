<?php

namespace App\Http\Controllers;
use App\Models\Tpr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Mail;

class Tprcontroller extends Controller
{
    //
    public function create(Request $req){

        $req->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:tprs',
                'contact'=>'required|digits:10|unique:tprs',
                'year'=>'required|digits:1',
                'branch'=>'required',
            ]
            );

            $tpr = new TPR;
            $tpr->name=$req['name'];
            $tpr->branch=$req['branch'];
            $tpr->year=$req['year'];
            $tpr->contact=$req['contact'];
            $tpr->email=$req['email'];

            $tpr->save();

            $data['url']="localhost:3000";
            $data['email']=$req['email'];
            $data['name']=$req['name'];
            $data['title']='TNP Cell';
            $data['body']='Please reset your password and login with your credentials!';
          Mail::send('mail-view.new_tpr',['data'=>$data],function($msg)use($data){
               $msg->to($data['email'])->subject($data['title']);
            
            });
            if (Mail::failures()) {
                return response()->json(['success'=>false,'msg'=>'Some error occured Please try again!']);
            }else{
                return response()->json(['success'=>true,'msg'=>'Tpr added successfully!']);
            }

      
            //return ["msg"=>"Data inserted"];
    //         // create the validation rules ------------------------
    // $rules = array(
    //     'name'             => 'required',                        // just a normal required validation
    //     'email'            => 'required|email|unique:ducks',     // required and must be unique in the ducks table
    //     'password'         => 'required',
    //     'password_confirm' => 'required|same:password'           // required and has to match the password field
    // );

    // // do the validation ----------------------------------
    // // validate against the inputs from our form
    // $validator = Validator::make(Input::all(), $rules);

    // // check if the validator failed -----------------------
    // if ($validator->fails()) {

    //     // get the error messages from the validator
    //     $messages = $validator->messages();

    //     // redirect our user back to the form with the errors from the validator
    //     return Redirect::to('home')
    //         ->withErrors($validator);

    // }

    // 'password' => [
    //     'required',
    //     'min:6',
    //     'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
    //     'confirmed'
    // ]

    }

    public function index(Request $req){
        
        $usertype=$req->session()->get('usertype');

        if($usertype==3){
          
            return redirect('/admin'); 
        }
        elseif($usertype==1){
            return redirect('/student');
         
        }
        elseif($usertype==2){
          return view('admin-view.adminpanel');
        }
        else{
           session()->put('usertype','0');
        
        return redirect('/');
        }
    }
    public function login(Request $req){
   
        $userid=$req->userid;
        $pass=$req->password;
      //$hashpass=Hash::make($pass);
        $tpr_pass=DB::select("select password from tprs where email='$userid'");
        if(isset($tpr_pass[0])){
$userpass= $tpr_pass[0]->password;
//echo $hashpass;
        if(Hash::check($pass,$userpass)){
        $tpr=DB::select("select * from tprs where email='$userid'");
        
        session()->put('username',$tpr[0]->name);
  
      session()->put('userid',$tpr[0]->id);
      session()->put('useremail',$tpr[0]->email);
     session()->put('usertype','2');
    return response()->json(['success'=>true,'ulr'=>'/tpr']);
    //redirect('/tpr');
        }
    else return back();
    }
    else return back();

    }

    public function profile(){

$useremail=session()->get('useremail');
$usertype=session()->get('usertype');
if($usertype==2){
    $tprdata=DB::select("select * from tprs where email='$useremail'");
    $user=$tprdata[0];
    $data=compact('user');
    //print_r($data);
    return view('admin-view.profile')->with($data);
}
if($usertype==3){
    $admin=DB::select("select * from admins where email='$useremail'");
    $user=$admin[0];
    $data=compact('user');
    return view('admin-view.profile')->with($data);
   //return "hii";
}

    }


    public function update(Request $req){
        
        $validate=Validator::make($req->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'email'=>'required|email|string',
            'contact'=>'required',
            'branch'=>'required',
            'year'=>'required',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $user=Tpr::find($req->id);
        $user->name=$req->name;
        if($user->email != $req->email){
        $user->is_verified=0;
        }
        $user->email=$req->email;
        $user->contact=$req->contact;
        $user->branch=$req->branch;
        $user->year=$req->year;
        
        $user->save();


        return response()->json(['success'=>true,'msg'=>'data updated successfully!','data'=>$user]);
      
    }
    public function tprDetail($id){
        $tpr=Tpr::find($id);
       // echo $tpr;
        if($tpr){
            $data=compact('tpr');
           // return response()->json(['success'=>true,'data'=>$data,'msg'=>'edit']);
        return view('include.tprform')->with($data);

        }else{
            return response()->json(['success'=>false,'msg'=>'Tpr not found']);
        }
    }
    public function UpdateDetail(Request $req){
        
        $validate=Validator::make($req->all(),[
            'id'=>'required|exists:tprs',
            'email'=>'required|email',
            'contact'=>'required',
            'name'=>'required',
            'year'=>'required',
            'branch'=>'required'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }
       // return $req->id;
        
        $tpr=Tpr::find($req->id);
       
        $tpr->name=$req->name;
        $tpr->contact=$req->contact;
        $tpr->year=$req->year;
        $tpr->branch=$req->branch;
        $tpr->email=$req->email;

        $tpr->save();
        return response()->json(['success'=>true,'msg'=>'data Saved successfully!']);
    }
}
