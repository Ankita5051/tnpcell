@php $usertype=session()->get('usertype');
@endphp
<section id="stdn-prfl">
    <div class="s-prfl-top">
        <h1 style="color:white;"> <span class="username"> Username </span> <i class="fa-regular fa-user profile"> </i> </h1>
        <ul class="prfl-verify-links"><li> <p  style="color:white;"><span class="user-mail">{{--user@mail.com --}}</span> <a href="" style="color:#870202"> verify</a></p></li>
            <li><p  style="color:white;"><span class="user-contact"></span>{{--contact--}}<a href="" style="color:#870202"> verify</a></p></li> </ul>
    </div>
    <div class="prfl-sec-2">


        <div class="prfl-option">
            <ul>
                <li><p><a href="" id="view"> View profile </a></p></li>
                <li><p><a href="" id="edit">Edit Profile</a></p></li>
                <li><p><a href="" id="del">Delete Account</a></p></li>
                
            </ul>
        </div>


        <section class="prft-dtl">
<!-- start of profiles -->


<div id="prfl-section"  class="section-id ">

    <div class="edit-profile ">
      
      {{-- <img src="img/profile.png" class="profile-img"  alt=""> --}}
      <form action="" id="prfldata"class="admin-data" method="">
        @csrf

        <input type="hidden" name="id" id="id" value="">
        <label for="uname" class="from-group">
        <p> User name :  </p>
        
          <input type="text" class="prfl-disbl e-ad-dt" name="name" id="name" disabled value=""> <br>
          <span style="color:red" class="error name_err"></span>
          {{-- <button class="prfl-e-btn" id="ename" type="button"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        </label>

        <label for="rollno" class="from-group">
            <p> Roll no. :  </p>
            
              <input type="number" class="prfl-disbl e-ad-dt" name="rollno" id="rollno" disabled value=""> <br>
              <span style="color:red" class="error rollno_err"></span>
              {{-- <button class="prfl-e-btn" id="ename" type="button"><i class="fa-solid fa-pen-to-square"></i></button> --}}
            </label>
       
        <label for="post" class="from-group">
        <p>Contact :  </p>
          <input type="number" name="contact" class="prfl-disbl e-ad-dt" id="contact" disabled value=""> <br>
          <span style="color:red" class="error contact_err"></span>
          {{-- <button type="button"class="prfl-e-btn" id="epost"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        </label>
       
        <label for="email" class="from-group">
        <p> Email:  </p>
          <input type="email" name="email" class="prfl-disbl e-ad-dt" id="email" disabled value="">
          <br>
          <span style="color:red" class="error email_err"></span>
          {{-- <button type="button" class="prfl-e-btn" id="eemail"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        </label>

        @if($usertype==2 || $usertype==1)
        <label for="branch" class="from-group">
          <p> Branch:  </p>
         
            <input type="text" name="branch" class="prfl-disbl e-ad-dt" id="branch" disabled value=""><br>
            <span style="color:red" class="error branch_err"></span>
            {{-- <button type="button" class="prfl-e-btn" id="eemail"><i class="fa-solid fa-pen-to-square"></i></button> --}}
          </label>
          <label for="year" class="from-group">
            <p> Year:  </p>
              <input type="number" name="year" class="prfl-disbl e-ad-dt" id="year" disabled value=""><br>
              <span style="color:red" class="error year_err"></span>
              {{-- <button type="button" class="prfl-e-btn" id="eemail"><i class="fa-solid fa-pen-to-square"></i></button> --}}
            </label>
            @endif
           
      
        <button class="btn btn-primary common-btn" style="margin-left:0;display:none;" type="submit" value="save" id="save">Save</button>

        {{-- <button class="btn btn-primary common-btn" style="margin-left:0;"  value="edit" id="edit">Edit</button> --}}
      </form>

    </div>
    
    <div class="result" style="color:green"></div>
</div>
  <!-- end of profile -->



</section>
    </div>


</section>



<script>
    $().ready(function(){

$.ajax({
    url:"http://localhost:8000/api/student/profile",
    type:"GET",
    headers:{'Authorization':localStorage.getItem('user_token')},
    success:function(data){
       
      if(data.success==true){
        $("#id").val(data.data.id);
        $("#name").val(data.data.name);
        $("#email").val(data.data.email);
        $("#branch").val(data.data.branch);
        $("#year").val(data.data.year);
        $("#rollno").val(data.data.rollno);
        $("#contact").val(data.data.contact);


        $(".username").text(data.data.name);
        $(".user-mail").text(data.data.email);
        $(".user-contact").text(data.data.contact);
      }else{
        if(data.success==false){
          localStorage.removeItem('user_token');
localStorage.removeItem('user_type');
window.open('/logout','_self');
        }
      }
    }
})


$("#edit").on('click',function(e){
e.preventDefault();
$("#save").css('display','block');
//$("#edit").css('display','none');
$('.prfl-disbl').removeAttr('disabled');
$('.prfl-disbl').css('cursor','text');
//$('.className').removeAttr('click style')
});
$("#view").on('click', function(e){
    e.preventDefault();
    $("#save").css('display','none');
    $('.prfl-disbl').attr('disabled',true);
    $('.prfl-disbl').css('cursor','not-allowed');
})

$("#del").on('click',function(e){
    e.preventDefault();
    var check=confirm("Are you sure you want to delete your account?");
   // console.log(check);
   if(check){

    var pass=prompt("enter your password");
 
    if(pass){
        var id=$("#id").val();
    $.ajax({
        url:"student/delete",
        type:"POST",
        data:{id:id,password:pass},
        success:function(data){
           if(data.success==true){
            localStorage.clear();
          alert(data.msg);
          //  $(".result").text(data.msg);
            setTimeout(() => {
                window.open('/',"_Self");
            }, 1000);
           }
           if(data.success==false){
           // $(".result").text(data.msg);
            alert(data.msg);
            //$(".result").css('color','red');
           }
        }
    })
}else{

}
   }
})


$("#save").on('click',function(e){
e.preventDefault();
$.ajax({
  url:"student/update",
  type:"POST",
  data:$("#prfldata").serialize(),
  success:function(data){
    if(data.success==true){
   
   $(".result").text(data.msg);
   $(".error").text('');
   setTimeout(() => {
     $(".result").text('');
   }, 2000);
  }else{
   console.log(data);
   //$("."+key+"_err").text(value);
  }
  }
})
});
});
  </script>
