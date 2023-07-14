<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\DB;
use App\Models\Tpr;
use App\Models\Admin;
use Session;
use App\Models\Chat;
use App\Models\Message;
class admincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $user_name=$req->session()->get('username');
        $usertype=session()->get('usertype');
        if($usertype==3)
        {
           // return redirect('/admin');
           if($user_name){
            $tprs=Tpr::all();
            $data=compact('tprs');
            return view('admin-view.adminPanel')->with($data); 
        }
        }
        elseif($usertype==2){
            return redirect('/tpr');
       }
        elseif($usertype==1)
       {
      //    echo (session()->get('usertype'));
     return redirect('/student');
       }
        else{
          session()->put('usertype','0');
  return redirect('/');
 //echo "error";
        }

        
      
        
    }
    public function tpr_tab(){
        $tprs=Tpr::all();
        $data=compact('tprs');

        return view('admin-view.tprsec')->with($data);   
    }
    public function login(Request $req){
      
        $username=$req['username'];
        $pass=$req['pass'];
    $user_pass=DB::select("select password from admins where name='$username'");
  $userpass=($user_pass[0]->password);
 
    //echo "hii";
  if(Hash::check($pass,$userpass)){
    $user_data=DB::select("select * from admins where name='$username'");
    // print_r($user_data);
    $user_name=$user_data[0]->name;
    $user_email=$user_data[0]->email;
    $user_id=$user_data[0]->id;
    $user_type=3;
    $req->session()->put('username',$user_name);
    $req->session()->put('usertype',$user_type);
    $req->session()->put('userid',$user_id);
    $req->session()->put('useremail',$user_email);
   // Session::put('$user', $username);
   //return view('admin-view.adminPanel');  

   return  redirect('/admin');
  }
  else 
  {
    $msg="invalid credential";   
    return redirect()->back()->with('msg');  
  }
  //return view('pages.adminPanel');  
 // return redirect('/admin'); 

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
    public function update(Request $req)
    {
       
            $validate=Validator::make($req->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'email'=>'required|email|string',
            'contact'=>'required',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $user=Admin::find($req->id);
        $user->name=$req->name;
        if($user->email != $req->email){
        $user->is_verified=0;
        }
        $user->email=$req->email;
        $user->contact=$req->contact;
        
        $user->save();


        return response()->json(['success'=>true,'msg'=>'data updated successfully!','data'=>$user]);
        
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
    public function removetpr($id){
      
        $tpr=Tpr::find($id);
        if(!is_null($tpr)){
            $tpr->delete();
        }
        return redirect()->back();
    }
    public function jobpost(){
        return view('admin-view.job_post');
    }
    public function forget(){
     
       return view('include.forgetpass') ;
    }

    //notice added header_register_callback
    public function noticeStore(Request $request){

    $request->validate([
        'serial_number'=>'required'
   ]);

   $noticeData = new Notice();
   $noticeData->serial_no = $request->serial_no;
   $noticeData->notice = $request->notice;
   $noticeData->expire_date = date('Y-m-d',strtotime($request->expiry_date));
   $noticeData->description = $request->description;
   $noticeData->save();

   return redirect()->back();
  
}

public function notice(){
    // $notice =Notice:: get();
    // $data=compact('notice');
    return view('admin-view.pass_change');

    }
     public function delete($id){
        $notice=Notice::find($id)->delete();
        $notice->delete();
        return redirect('notice');
     }
     

}
