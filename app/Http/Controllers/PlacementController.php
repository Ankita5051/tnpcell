<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Placement;
use Validator;
class PlacementController extends Controller
{
public function index(){
    $records=Placement::all();
    $data=compact('records');
  //what compact do in laravel
    return view('placement_record')->with($data);
}
public function createview(){
    return view('include.placement_frm');
}
public function editRecord(Request $req, $id){
    $validate=Validator::make($req->all(),[
       
        'name'=>'required|string',
         'company'=>'required|string|max:100|min:2',
         'package'=>'required|integer',
         'post'=>'required|string|max:100|min:2',
         'branch'=>'required|string|max:3|min:2',
        'batch'=>'required|integer'
    ]);
if($validate->fails()){
    return response()->json(['error'=>$validate->errors(),'success'=>false]);
}

$record=Placement::find($id);
$record->name=$req->name;
$record->company=$req->company;
$record->branch=$req->branch;
$record->batch=$req->batch;
$record->package=$req->package;
$record->post=$req->post;

$record->save();

return response()->json(['success'=>true,'msg'=>'Record saved successfully']);
}
public function updateView($id){
    $record=Placement::find($id);
    $data=compact('record');
    return view('include.placement_frm')->with($data);
}
public function createRecord(Request $req){
    $validate=Validator::make($req->all(),[
       
        'name'=>'required|string',
         'company'=>'required|string|max:100|min:2',
         'package'=>'required|integer',
         'post'=>'required|string|max:100|min:2',
         'branch'=>'required|string|max:3|min:2',
        'batch'=>'required|integer'
    ]);
if($validate->fails()){
    return response()->json(['error'=>$validate->errors(),'success'=>false]);
}


$record=Placement::create([
    'name'=>$req->name,
    'company'=>$req->company,
    'package'=>$req->package,
    'branch'=>$req->branch,
    'batch'=>$req->batch,
    'post'=>$req->post,
   
]);
return response()->json(["success"=>true,'msg'=>"record added successfully"]);
}
public function destroyRecord($id){
$record=Placement::find($id);
if($record){
    $record->delete();
    return response()->json(['success'=>true,'msg'=>"record deleted successfully!"]);
}else{
    return response()->json(['success'=>false,'err'=>"Record not found!"]);
}

}
}

