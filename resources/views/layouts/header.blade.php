@php 
$usertype=session()->get('usertype');
//tpr usertype=2
//admin usertype=3
//student usertype=1
//guest 0
@endphp




<div class="header ">
    <nav class="navbar navbar-expand-lg navbar-light bg-light col-lg-10 offset-lg-1">
  <a class="navbar-brand" >TNP Cell
    <img src="img/logo.png" class="logo" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

      @if(session()->get('usertype')==1 or session()->get('usertype')==2 or session()->get('usertype')==3)
     <li class="nav-item">

        <a class="nav-link" 
        @if($usertype==1) {{--href="/student/profile" --}}onclick="studentPrfl(event)"
         @elseif($usertype==2) href="tpr/profile" 
         @elseif($usertype==3) href="admin/profile"
          @endif>{{session()->get('username')}} <i class="fa-regular fa-user profile"> </i> <span class="sr-only">(current)</span></a>
      </li>
      @endif
    @if($usertype==0 || $usertype==1)
      <li class="nav-item ">
        <a class="nav-link"
         @if($usertype==1)
        {{-- href="/student" --}}
        id="s-view"
         @else href="/" @endif
         {{-- onclick="pageChange(event,'home-pg')" --}}
         >Home</a>
      </li>
   
      <li class="nav-item">
        <a class="nav-link" href="" id="jb-btn" 
        {{-- onclick="pageChange(event,'job-pg')" --}}
        >Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="" id="itrn-btn"
         {{-- onclick="pageChange(event,'intrn-pg')" --}}
         >Internship</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="" id="plcmnt-btn"
         {{-- onclick="pageChange(event,'intrn-pg')" --}}
         >Placement record</a>
      </li>
@endif
 @if(session()->get('usertype')==1)
      <li class="nav-item">
        <a class="nav-link " href=""
{{--         
        onclick="pageChange(event,'qry-pg')"  --}}
        id="qry-btn">Query</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="" id="ntf-btn"
         {{-- onclick="pageChange(event,'ntf-pg')" --}}
         >Set Notification</a>
      </li>
      @endif
@if(session()->get('usertype')==1 or session()->get('usertype')==2 or session()->get('usertype')==3)
     {{-- <li class="nav-item">
        <a class="nav-link" href="#">{{session()->get('username')}} <i class="fa-regular fa-user profile"></i> <span class="sr-only">(current)</span></a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link " href="#"><i class="fa-regular fa-bell"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link " @if($usertype==1) id="logout" @else    href="/logout"  @endif {{--href="/logout"--}} >Logout</a>
      </li> 
    @endif
    </ul>
  </div>
</nav>
</div>

<script>
      $(document).ready(function(){
        $("#logout").click(function(){
            $.ajax({
                url:"http://127.0.0.1:8000/api/user/logout",
                type:"GET",
                headers:{'Authorization':localStorage.getItem('user_token')},
                success:function(data){
                  console.log(data);
                    if(data.success==true){
                   
localStorage.removeItem('user_token');
localStorage.removeItem('user_type');
window.open('/logout','_self');
                    }
                    else{localStorage.removeItem('user_token');
localStorage.removeItem('user_type');
window.open('/logout','_self');
                       // alert(data.msg);
                    }
                 
                }
            })
        });


$("#jb-btn").on('click',function(e){
e.preventDefault();
$.ajax({
  url:"\job",
  type:"GET",
  success:function(data){
  
    $("#home-pg").html(data);
  }
});
});


$("#itrn-btn").on('click',function(e){
e.preventDefault();
 $.ajax({
   url:"\internship",
   type:"GET",
   success:function(data){
     $("#home-pg").html(data);
  
   }
 });
});

$("#qry-btn").on('click',function(e){
e.preventDefault();

 $.ajax({
   //url:"\query",
   url:"{{route('query.index')}}",
   type:"GET",
   success:function(data){
    $("#home-pg").html(data);
    
   }
 });
});

$("#ntf-btn").on('click',function(e){
e.preventDefault();

 $.ajax({
   url:"\set_notification",
   type:"GET",
   success:function(data){

     $("#home-pg").html(data);
    
   }
 });
});

$("#s-view").on('click',function(e){
e.preventDefault();
 $.ajax({
   url:"\student_view",
   type:"GET",
   success:function(data){
     $("#home-pg").html(data);
    
   }
 });
});

var usertype=localStorage.getItem('usertype');
if(usertype==1)
$("#s-view").click();
      });

$("#plcmnt-btn").on('click',function(e){
e.preventDefault();
$.ajax({
  url:"\placement_view",
  type:'GET',
  success:function(data){
    $("#home-pg").html(data);
  }
});
});
</script>