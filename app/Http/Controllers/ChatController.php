<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Chat;
use Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Message;
class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $chats=DB::table('chats')->join('students','chats.sender_id','=','students.id')->select('chats.*','students.name')->get();
       
        // $data=compact('chats');
     
       return view('pages.query');
    }

    public function quryFrmLoad($id){
        // $user = Auth::user();
        // print_r($user);
        $userId=session()->get('userid');
       
        $data=compact('id','userId');
        return view('include.queryForm')->with($data);
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
    public function store(Request $req)
    {
       $usertype=session()->get('usertype');
       $forward=0;
        $validate=Validator::make($req->all(),[
            'subject'=>'required|min:2|max:1000',
            'question'=>'required|min:3|max:64000',
        ]);
        if($validate->fails()){
            return response()->json(['error'=>$validate->errors(),'success'=>false]);
        }
      if($req->jobId==0){
        $req->jobId=Null;
        if($usertype==2){
            $forward=1;
        }
      }
     
     
        $chat=Chat::create([
            'job_id'=>$req->jobId,
            'sender_id'=>$req->senderId,
            'subject'=>$req->subject,
            'query'=>$req->question,
            'status'=>0,
            'forwarded'=>$forward,
            'is_expired'=>0,
            'usertype'=>$usertype,
        ]);
        //return $chat;
        //return auth()->guard('student')->user();
       return response()->json(['success'=>true,'msg'=>'your query submited successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $usertype=session()->get('usertype');
        $chatdetail=Chat::where('id',$id)->get();
        $usertype=$chatdetail[0]->usertype;
        $query=[];
  
        if($usertype==1){
            $usertable='students';
            $username='students.name';
            $userId='students.id';
            
        }elseif($usertype==2){
            $usertable='tprs';
            $username='tprs.name';
            $userId='tprs.id';
         

        }else{
            $usertable='admins';
            $username='admins.name';
            $userId='admins.id';         
        }
      
        $oldchat=DB::table('chats')->join($usertable,'chats.sender_id','=',$userId)->where('chats.id',$id)->select('chats.*',$username)->get();

        $message=Message::where('chat_id',$id)->get();
//dd($message);
        $data=compact('oldchat','message');
      
return view('include.message')->with($data);
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function getAllMessage($id){

     }
    public function edit($id)
    {
        $usertype=session()->get('usertype');

        $chat = Chat::findOrFail($id);
      
       
if($chat){
    if($usertype==2){
        $chat->forwarded=1;
        $chat->status==0;
        $msg="Query forwarded to admin! ";
        $success=true;
    }elseif($usertype==3){
        if($chat->status==1){
            $chat->forwarded=0;
            $msg="Query removed from your end! ";
            $success=true;
        }else{
            $chat->forwarded=1;
            $msg="Please reply first! ";
            $success=false;
        }
        
    }
 
    $chat->save();
    return response()->json(['success'=>$success,'msg'=>$msg]);
}else{
    return response()->json(['success'=>$success,'msg'=>'Some error occured!']);
}
      
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
    public function queryList(Request $req){
        $userid=session()->get('userid');
        $usertype=session()->get('usertype');
        if($usertype==1){
            $usertable='students';
            $username='students.name';
            $userId='students.id';
            
        }elseif($usertype==2){
            $usertable='tprs';
            $username='tprs.name';
            $userId='tprs.id';

        }else{
            $usertable='admins';
            $username='admins.name';
            $userId='admins.id';
        }

        if($req->list=='all'){
            if($usertype==3){
                $chats = DB::table('chats as c')
                ->select('c.*', DB::raw('CASE WHEN c.usertype = 1 THEN s.name WHEN c.usertype = 2 THEN t.name END AS name'))
                ->leftJoin('students as s', function ($join) {
                    $join->on('c.sender_id', '=', 's.id')
                        ->where('c.usertype', '=', 1)
                        ->where('c.forwarded','=',1);
                })
                ->leftJoin('tprs as t', function ($join) {
                    $join->on('c.sender_id', '=', 't.id')
                        ->where('c.usertype', '=', 2)->where('c.forwarded','=',1);
                })->where('forwarded',1)->orderBy('c.usertype','desc')->orderBy('created_at', 'desc')
                ->get();
                $data=compact('chats');
         
                return view('include.queryList')->with($data);
            }elseif($usertype==2){
                $chats = DB::table('chats as c')
                ->select('c.*', DB::raw('CASE WHEN c.usertype = 1 THEN s.name WHEN c.usertype = 3 THEN t.name END AS name'))
                ->leftJoin('students as s', function ($join) {
                    $join->on('c.sender_id', '=', 's.id')
                        ->where('c.usertype', '=', 1)
                        ->where('c.forwarded','=',0);
                })
                ->leftJoin('admins as t', function ($join) {
                    $join->on('c.sender_id', '=', 't.id')
                        ->where('c.usertype', '=', 3)->where('c.forwarded','=',0);
                })->where('forwarded',0)->orderBy('c.usertype','desc')->orderBy('created_at', 'desc')->where('c.usertype','!=',2)
                ->get();
                $data=compact('chats');
         
                return view('include.queryList')->with($data);   
            }else{
                $chats=DB::table('chats')->join('students','chats.sender_id','=','students.id')->select('chats.*','students.name')->where('sender_id','!=',$userid)->get();
       
                $data=compact('chats');
             
                return view('include.queryList')->with($data);
            }
           
        }
        if($req->list=='my'){
            $chats=DB::table('chats')->join($usertable,'chats.sender_id','=',$userId)->where('sender_id',$userid)->select('chats.*',$username)->get();
       
          //  dd($chats);
        $data=compact('chats');
         
           return view('include.queryList')->with($data);
        }
       
    }

    public function storeMessage(Request $req){
        $senderId=session()->get('userid');
        $usertype=session()->get('usertype');
    
        if($usertype==3){
          
            $changeChatStatus=Chat::find($req->chat_id);
            $changeChatStatus->status=1;
            $changeChatStatus->save();
        }
        //return $sender_id;
        $validate=Validator::make($req->all(),[
            'chat_id'=>'required',
            'message'=>'required'
        ]);
        if($validate->fails()){
           // return response()->json(['success'=>false,'msg'=>'some error occured']);
           return response()->json($validate->errors());
        }
$message=Message::create([
'replyer_id'=>$senderId,
'chat_id'=>$req->chat_id,
'message'=>$req->message,
'status'=>0,
'usertype'=>$usertype,
]);

return response()->json(['success'=>true,'msg'=>$req->message]);
    }
}
