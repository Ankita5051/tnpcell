<?php

namespace App\Http\Controllers;
use Mail;
use App\Models\Preference;
use Illuminate\Http\Request;
use Validator;
use DB;
class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid=session()->get('userid');
      $myPreference=Preference::where('student_id',$userid)->get();
      $data=compact('myPreference');
    return view('pages.setnotification')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validate=Validator::make($req->all(),[
           'ways'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['success'=>false,'msg'=>'please select atleast one  notification method!']);
        }

        $userid=session()->get('userid');
$package=1;
$branch=null;
$type=null;
$field=null;
$batch=null;
$location=null;


$chk="";  
if($req->branch){
foreach($req->branch as $chk1)  
{  
$chk .= $chk1.",";  
} 
$branch=$chk;
}

$chk="";  
if($req->ways){
foreach($req->ways as $chk1)  
{  
$chk .= $chk1.",";  
} 
$ways=$chk;
}


if($req->type !='0')
$type=$req->type;

if($req->field !='0')
$field=$req->field;
if($req->batch != 0)
$batch=$req->batch;

if(isset($req->location) && $req->location != '0'){
    $location = $req->location;
}

elseif(isset($req->other)){
$location=$req->other;
}
        if(isset($req->package))
        $package=$req->package;
      
        $data = [
            'package' => $package,
            'field' => $field,
            'type'=>$type,
            'batch'=>$batch,
            'location'=>$location,
            'branch'=>$branch,
            'ways'=>$ways,
            'student_id'=>$userid,
           
        ];
     
         Preference::updateOrCreate(['student_id' => $userid],[
             'package' => $package,
             'field' => $field,
             'type'=>$type,
             'batch'=>$batch,
             'location'=>$location,
             'branch'=>$branch,
             'ways'=>$ways,
             'student_id'=>$userid,
            
         ]);
   
        return response()->json(['success'=>true,'msg'=>"your preference is set!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function show(Preference $preference)
    {
        //
    }

    public function mailtest(){
        $userid =session()->get('userid');
        $job=DB::select('select * from jobs where id=8');
     $branch= $job[0]->branch;
        $package=$job[0]->package;
        $field=$job[0]->field;
        $batch=$job[0]->batch;
        $type=$job[0]->type;
        $location=$job[0]->work_from;

        $brarr = explode(',', $branch);

        $prefernces=DB::table('preferences as p')->leftJoin('students as s','s.id','=','p.student_id')->select('p.*','s.email','s.contact')->get();
       // dd( $prefernces);
$stdnTOnotify=[];
foreach( $prefernces as $prfrnc){
   if($package >= $prfrnc->package){
    $stdnTOnotify[] = $prfrnc->email;
    continue;
   }elseif($field == $prfrnc->field){
    $stdnTOnotify[] = $prfrnc->email;
    continue;
   }elseif($batch == $prfrnc->batch){
    $stdnTOnotify[] = $prfrnc->email;
    continue;
   }elseif($type ==$prfrnc->type){
    $stdnTOnotify[] = $prfrnc->email;
    continue;
   }elseif($location == $prfrnc->location){
    $stdnTOnotify[] = $prfrnc->email;
    continue;
   }else{
    $setbr=explode(',', $prfrnc->branch);
    foreach($setbr as $br){
        if(in_array($br,$brarr)){
            $stdnTOnotify[] = $prfrnc->email;
            continue;
        }
    }
   }
  
};

foreach($stdnTOnotify as $notify){
 
    $data['email']=$notify;
    
    $data['title']='A new job Posted';
    $data['body']='please click on below link to know more about this job';
    Mail::send('sendNotification',['data'=>$data],function($msg)use($data){
       $msg->to($data['email'])->subject($data['title']);
    
    });
}
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function edit(Preference $preference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preference $preference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preference $preference)
    {
        //
    }
}
