<?php

namespace App\Http\Controllers;
use App\Models\Tpr;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function path(){
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
     
      return redirect('/student');
       }
        else{
            session()->put('usertype','0');
  return redirect('/index');

        }
    }
    public function index()
    {
       
         $usertype=session()->get('usertype');

         if($usertype==3){
          
             return redirect('/admin'); 
         }
         elseif($usertype==1){
             return redirect('/student');
         
         }elseif($usertype==2){
             return redirect('/tpr');
          }
         else{
            session()->put('usertype','0');
        return view('index');        
         }   
    }
}
