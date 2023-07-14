
@php
$usertype=session()->get('usertype');
@endphp

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>   
       
<form 
{{-- action="../smtp_files/index.php" --}}
id="forgetfrm"
class="form col-lg-8" >
    <div class="frm-head">
        <h2 class="common-heading">
            forget password
             </h2>
    </div>
{{-- <label for="" class="form-group" style="font-size:1.2rem;"> Enter your registered email</label> --}}
    <input type="email" name="email" class="form-control mb-4 in s-in" placeholder=" enter your email..." >

    {{-- <label for="" class="form-group">
        <p> enter your registered email</p>
    <input type="email" name="email" placeholder="enter your email id" required="true" class="form-control in"></label> --}}
    <button type="submit" class="btn btn-primary common-btn fr-btn">reset password</button>
   <p> Remember password?<a href="" 
    {{--onclick="Adminlogin(event)"--}}>login</a> </p>
  
</form>
<div class="result" style="color:green">

</div>


<script>
   
    $(document).ready(function(){
        var usertype=$("#usertype").val();
    //console.log("hiii");
    console.log(usertype);
    if(usertype==1){

    
        $("#forgetfrm").submit(function(e){
            e.preventDefault();
            var formdata=$(this).serialize();
            $.ajax({
url:"http://127.0.0.1:8000/api/student/reset-password",
type:'POST',
data:formdata,
success:function(data){
    console.log(data);
if(data.success==true){
    $(".result").text(data.msg); 
}else{
    $(".result").text(data.msg); 
    setTimeout(() => {
        $(".result").text(''); 
    }, 5000);
}
}

            });
        })
    }
    else if(usertype==2){

        $("#forgetfrm").submit(function(e){
            e.preventDefault();
            var formdata=$(this).serialize();
            $.ajax({
url:"http://127.0.0.1:8000/api/tpr/reset-password",
type:'POST',
data:formdata,
success:function(data){
    console.log(data);
if(data.success==true){
    $(".result").text(data.msg); 
}else{
    $(".result").text(data.msg); 
    setTimeout(() => {
        $(".result").text(''); 
    }, 5000);
}
}

            });
        })

    }
    else if(usertype==3){

        $("#forgetfrm").submit(function(e){
            e.preventDefault();
            var formdata=$(this).serialize();
            $.ajax({
url:"http://127.0.0.1:8000/api/admin/reset-password",
type:'POST',
data:formdata,
success:function(data){
    console.log(data);
if(data.success==true){
    $(".result").text(data.msg); 
}else{
    $(".result").text(data.msg); 
    setTimeout(() => {
        $(".result").text(''); 
    }, 5000);
}
}

            });
        })
    }
    })
</script>
<?php
// if(isset($_POST['match-btn'])){
// $studentOtp=$_POST['otp'];
// if($studentOtp==$otp)
// header("location:../page/changePassword.php");
// else
// echo "<h1>invalid otp</h1>";
// };


?>
