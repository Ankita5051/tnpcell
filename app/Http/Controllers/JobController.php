<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Job;
use Mail;
use Validator;
use App\Models\Preference;
use Illuminate\Support\Facades\DB;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  //Project::orderBy('name')->get();
        $checkForExpiry=Job::all();
        $expirationDate=null;
      foreach($checkForExpiry as $expiredjob){
        $Deadline = $expiredjob['deadline'];
        if($Deadline)
             $expirationDate = Carbon::parse($Deadline);
             echo $expirationDate;
        if ($expirationDate && $expirationDate->isPast()) {
        $expiredjob['status']="expired";
        $expiredjob->save();
        }
      };
        $jobs=Job::orderBy('id','desc')->get();
        $data=compact('jobs');
        return view('admin-view.display_job')->with($data);
    }

    public function internship(){
        $interns=DB::select("select * from jobs where type='internship' order by id desc");
        $data=compact('interns');
        return view('admin-view.display_internship')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function create(Request $req)
    {

            if($req['status']=="active"){
                $req->validate(
                    [
                     
                        'job_link'=>'required|unique:jobs',
                        'type'=>'required',
                        'work_from'=>'nullable',
                        'batch'=>'nullable',
                        'field'=>'required',
                        'branch'=>'required',
                        'package'=>'required',
                        'company_name'=>'required',
                        'company_location'=>'required',
                        'about_company'=>'nullable',
                        'post'=>'required',
                        'deadline'=>'nullable',
                        'requirement'=>'required',
                        'job_description'=>'nullable',
                        'instruction'=>'nullable',
                        'attachment'=>'nullable',
                        'additional'=>'nullable',                  
                    ]
                    );
            }
            elseif($req['status']=="inactive"){ $req->validate(
                [
                 
                    'job_link'=>'required|unique:jobs',
                    'type'=>'nullable',
                    'work_from'=>'nullable',
                    'batch'=>'nullable',
                    'branch'=>'nullable',
                    'package'=>'nullable',
                    'field'=>'nullable',
                    'company_name'=>'nullable',
                    'company_location'=>'nullable',
                    'about_company'=>'nullable',
                    'post'=>'nullable',
                    'deadline'=>'nullable',
                    'requirement'=>'nullable',
                    'job_description'=>'nullable',
                    'instruction'=>'required',
                    'attachment'=>'nullable',
                    'additional'=>'nullable',
    
                ]
                );    

            }
          
            $job = new JOb;


            $job->job_link=$req['job_link'];
            
            $job->type=$req['type'];
            $job->work_from=$req['work_from'];
            $job->experience=$req['experience'];
            $job->batch=$req['batch'];
            $job->field=$req['field'];
         
            $job->package=$req['package'];
            $job->company_name=$req['company_name'];
            $job->company_location=$req['company_location'];
            $job->about_company=$req['about_company'];
            $job->post=$req['post'];
            $job->deadline=$req['deadline'];
            $job->requirement=$req['requirement'];
            $job->job_description=$req['job_description'];
            $job->instruction=$req['instruction'];
            $job->additional=$req['additional'];
          //  $job->attachment=$req['attachment'];
            $job->status=$req['status'];
           
         
$jobid=time();
$job->job_id=$jobid;

            $file=$req->attachment;

            if($file)
            {
            $filename=time().'.'.$file->getClientOriginalExtension();
            $req->attachment->move('uploads',$filename);
            $job->attachment=$filename;
        }

         // foreach($request->file('file') as $pdf){
        //     $filename=$pdf->getClientOriginalName();
        //     $pdf->move(public_path().'/uploaded/',$filename);
        //     $fileNames[]=$filename;
        // }
        // $pdfs=json_encode($fileNames);
//$chechbox1=$req->branch('branch');
        $chk="";  
        if($req->branch){
foreach($req->branch as $chk1)  
   {  
      $chk .= $chk1.",";  
   } 
   $job->branch=$chk;
}else $job->branch=$req->branch;
          // echo($chk);
            $job->save();
            

            if($req['status']=="active"){
          // $job=DB::select('select * from jobs where id=8');
          $joblink=$req['job_link'];
       $branch=$req->branch;
          $package=$req->package;
          $field=$req->field;
          $batch=$req->batch;
          $type=$req->type;
          $location=$req->work_from;
          $stdnTOnotify=[];
         // $brarr = explode(',', $branch);
         $brarr=[];
       // $brarr = explode(',', $branch);
       if( !empty($req->branch))
       $brarr= $req->branch;
        //dd($brarr);
          $prefernces=DB::table('preferences as p')->leftJoin('students as s','s.id','=','p.student_id')->select('p.*','s.email','s.contact')->get();
         // dd( $prefernces);

         $students=DB::select('select email,contact from students where id NOT IN (select student_id from preferences)');
        // dd($students);
         foreach($students as $stdn){
            $stdnTOnotify[] = $stdn->email;
         }
 
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
      $data['url']=$joblink;
      $data['title']='A new job For You';
      $data['body']='please click on below link to know more about this job';
      Mail::send('sendNotification',['data'=>$data],function($msg)use($data){
         $msg->to($data['email'])->subject($data['title']);
     
  
      });
  }

 // dd("sent");
}
        return back();
      

    }



    public function mailtest( $req){
        $userid =session()->get('userid');
        // $job=DB::select('select * from jobs where id=8');
     $branch=$req->branch;
        $package=$req->package;
        $field=$req->field;
        $batch=$req->batch;
        $type=$req->type;
        $location=$req->work_from;
$brarr=[];
       // $brarr = explode(',', $branch);
       if( $req->branch)
       $brarr= $req->branch;
      // dd($brarr);
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
    dd("sent");

    });
}
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
        $jb_dtl=DB::select("select * from jobs where job_id='$id'");
$jb=$jb_dtl[0];
        $data=compact('jb');
      return view('admin-view.jobDetail')->with($data);
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
    public function update(Request $req, $id)
    {
        
        $job =Job::find($id);
//$job=$jobdetail[0];

     $job->job_link=$req->job_link;
   //  $job->status='active';
    $job->type=$req['type'];
   
    $job->work_from=$req['work_from'];
    $job->experience=$req['experience'];
    $job->batch=$req['batch'];
    $job->field=$req['field'];
 
    $job->package=$req['package'];
    $job->company_name=$req['company_name'];
    $job->company_location=$req['company_location'];
    $job->about_company=$req['about_company'];
    $job->post=$req['post'];
    $job->deadline=$req['deadline'];
    $job->requirement=$req['requirement'];
    $job->job_description=$req['job_description'];
    $job->instruction=$req['instruction'];
    $job->additional=$req['additional'];
 

    $file=$req->attachment;

    if($file)
    {
    $filename=time().'.'.$file->getClientOriginalExtension();
    $req->attachment->move('uploads',$filename);
    $job->attachment=$filename;
}

 // foreach($request->file('file') as $pdf){
//     $filename=$pdf->getClientOriginalName();
//     $pdf->move(public_path().'/uploaded/',$filename);
//     $fileNames[]=$filename;
// }
// $pdfs=json_encode($fileNames);
//$chechbox1=$req->branch('branch');
$chk="";  
if($req->branch){
foreach($req->branch as $chk1)  
{  
$chk .= $chk1.",";  
} 
$job->branch=$chk;
}else $job->branch=$req->branch;

$expirationDate=null;
$Deadline = $req['deadline'];
if($Deadline)
     $expirationDate = Carbon::parse($Deadline);
if ($expirationDate && $expirationDate->isPast()) {
$job['status']="expired";

}

if($job['status' !='expired']){

  if($job->job_link && $job->type && $job->field && $job->branch && $job->package && $job->company_name && $job->company_location && $job->post && $job->requirement)
            { 
                $job->status='active';
                
            }elseif($job->job_link && $job->instruction){
                $job->status='inactive';
           
            }else{
              
                return response()->json(['success'=>true,'msg'=>'Please fill details to make inactive atleast!']);
            }

        }
        else{
            $job->save();
            return response()->json(['success'=>true,'msg'=>'This job is expired now!']);
        }
    $job->save();

   
if($job->status =='active'){
    return response()->json(['success'=>true,'msg'=>'This job is active now!']);
}else{
    return response()->json(['success'=>false,'msg'=>'This job is inactive now! ']);
}
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobtobedel=DB::select("select id from jobs where job_id='$id'");
       $i= $jobtobedel[0]->id;
        if(!is_null($i)){

            Job::find($i)->delete();
        }

        return back();
    }
    public function search($key){
        $jobs=Job::where('package',$key)
        ->orWhere('branch',$key)
        ->orWhere('post',$key)
        ->orWhere('company_name',$key)
        ->orWhere('status',$key)
        ->orWhere('job_id',$key)
        ->orWhere('type',$key)
        ->orWhere('job_link',$key)
        ->orWhereDate('deadline',$key)
        ->orWhere('work_from',$key)->get();

        
          // ->orWhere(`CAST(deadline as date)`,$key)
        //SELECT  CONVERT(date, deadline, 101) style 101 means MM/DD/YYYY  ->orWhereDate('deadline',$key)

        // $jobs=DB::select("select * from jobs where package='$key' or branch ='$key' or post='$key' or company_name='$key' or status='$key' or job_id='$key' or type='$key' or work_from='$key' or experience='$key' or batch='$key' ");
       // $job=DB::select("SELECT * FROM `jobs` WHERE CAST(deadline as date)='$key'");
        //print_r($jobs[0]->type);

        //$jobs=Job::where('status',$key)->get();
        $data=compact('jobs');
        //return $data;
        return view('admin-view.display_job')->with($data);

    }
    public function displaJob(){
        $jobs=Job::where('type','job')->where('status','active')->orderBy('id','desc')->get();
        $data=compact('jobs');
        return view('pages.job')->with($data);
      
    }
    public function desplaIternship(){
        $jobs=Job::where('type','internship')->where('status','active')->orderBy('id','desc')->get();
        $data=compact('jobs');
        return view('pages.internship')->with($data);  
    }
    public function findJob($id){
        $job=Job::find($id);
        $data=compact('job');
        return view('pages.vcncydetail')->with($data);
    }
    public function internshipFilter(Request $req){
       
        if(empty( $req->except('_token') ) ){
            $jobs=Job::where('status','active')->where('type','internship')->get();
            $data=compact('jobs');
            return view('include.jobs')->with($data);
          }
      
          else
        {
            $query=[];
            
            if($req->company){
          $query=['company_name'=>$req->company];
         
            
            }
            if($req->post){
                $query +=['post'=>$req->post];    
                }
    
               
                    if($req->package){
                        $query +=['package'=>$req->package];    
                        }
                        if($req->location){
                            $query +=['company_location'=>$req->location];    
                            }
          
    
            $jb=Job::where('status','active')->where('type','internship')->whereNotNull('company_name')->whereNotNull('company_location')->whereNotNull('package')->whereNotNull('post')->whereNotNull('deadline')->whereNotNull('branch')->where($query)->get();
    
           
            $jobs=[];
            $branch=[];
            if($req->branch){
                if($jb){
                    $n=count($jb);
                    $j=0;
                    for($i=0;$i<$n;$i++){
                        
                        $brnc =explode(',', $jb[$i]->branch);
                        if(in_array($req->branch,$brnc))
                        $jobs[$j++] = $jb[$i];
                        }
                       // return $jobs;
                        $data=compact('jobs');
                      return view('include.jobs')->with($data);
                }else{
                  $jobs=$jb;
                 // return $jobs;
                  $data=compact('jobs');
                  return view('include.jobs')->with($data);
                }
                 
                }
                else
                {  $jobs=$jb;
                    $data=compact('jobs');
                    return view('include.jobs')->with($data);
                }
            }    
    }
    public function jobFilter(Request $req){
      if(empty( $req->except('_token') ) ){
        $jobs=Job::where('status','active')->where('type','job')->get();
        $data=compact('jobs');
        return view('include.jobs')->with($data);
      }
  
      else
    {
        $query=[];
        
        if($req->company){
      $query=['company_name'=>$req->company];
     
        
        }
        if($req->post){
            $query +=['post'=>$req->post];    
            }

           
                if($req->package){
                    $query +=['package'=>$req->package];    
                    }
                    if($req->location){
                        $query +=['company_location'=>$req->location];    
                        }
      

        $jb=Job::where('status','active')->where('type','job')->whereNotNull('company_name')->whereNotNull('company_location')->whereNotNull('package')->whereNotNull('post')->whereNotNull('deadline')->whereNotNull('branch')->where($query)->get();

       
        $jobs=[];
        $branch=[];
        if($req->branch){
            if($jb){
                $n=count($jb);
                $j=0;
                for($i=0;$i<$n;$i++){
                    
                    $brnc =explode(',', $jb[$i]->branch);
                    if(in_array($req->branch,$brnc))
                    $jobs[$j++] = $jb[$i];
                    }
                   // return $jobs;
                    $data=compact('jobs');
                  return view('include.jobs')->with($data);
            }else{
              $jobs=$jb;
             // return $jobs;
              $data=compact('jobs');
              return view('include.jobs')->with($data);
            }
             
            }
            else
            {  $jobs=$jb;
                $data=compact('jobs');
                return view('include.jobs')->with($data);
            }
          
        
      //  $jobs=Job::where('status','active')->where('type','job')->whereNotNull('company_name')->whereNotNull('company_location')->whereNotNull('package')->whereNotNull('post')->whereNotNull('deadline')->whereNotNull('branch')->Where('post',$req->post)->Where('branch',$req->branch)->Where('package',$req->package)->Where('company_location',$req->location)->WhereDate('deadline',$req->deadline)->get();
       //$jobs=DB::select("select * from jobs where status='active' and type='job' and company_name='$req->company' and company_location='$req->location' and branch='$req->branch' and package='$req->package' and post='$req->post' ");
       // return $jobs;
    }
     

    }
    public function download($file){
        $headers = [
            'Content-Type' => 'application/pdf',
         ];
    
    return response()->download(public_path('uploads/'.$file));
    }
}
