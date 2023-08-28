

<!DOCTYPE html>
<html lang="en">

    @include('layouts.head')
  

<body>
    <div class="error" style="float:right;margin-right:30rem; margin-top: 20rem;color:red;font-size: 1.2rem">
        @if(isset($errors))
       
        <ul>
        @foreach($errors->all() as $er)
        <li>{{$er}}</li>
        @endforeach
        </ul>
        
        @endif
    </div>
    

<div class="signup">
    <form 
    {{-- action="/student/create"  --}} id="register-frm"
    method="post">
        @csrf
        <div class="form-header">
            <h1>Register</h1>
            <p class="result" style="color:green;background:white;"></p>
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text"  class="form-control" name="name" placeholder="username"id="">
            <span class="error name_err" style="color:red;font-size:12px"></span>
        </div>
        <div class="form-group">
            <label for="">Roll no.</label>
            <input type="number" name="rollno" id="" class="form-control" placeholder="eg.19084107000">
            <span class="error rollno_err" style="color:red;font-size:12px"></span>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" placeholder="eg.someone@site.com"id="" class="form-control">
            <span class="error email_err" style="color:red;font-size:12px"></span>
        </div>
        {{-- <div class="form-group">
            <label for="">Gender</label>
            <select class="form-control"name="gender" id="">
                <option value="">select</option>  
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select>
            <span class="error gender_err" style="color:red;font-size:12px"></span>
        </div> --}}
        <div class="form-group">
            <label for="">Contact</label>
            <input type="number" name="contact" placeholder="enter your contact"id="" class="form-control">
            <span class="error contact_err" style="color:red;font-size:12px"></span>
        </div>
        <div class="form-group">
            <label for="">Branch</label>
            <select class="form-control"name="branch" id="">
                <option value="">select</option>  
                <option value="CSE">CSE</option>
                <option value="EE">EE</option>
                <option value="EL">EL</option>
            </select>
            <span class="error branch_err" style="color:red;font-size:12px"></span>
        </div>
        <div class="form-group">
            <label for="">Year</label>
            <select class="form-control" name="year" id="">
                <option value="">select</option>  
                <option value="1">1st year</option>
                <option value="2">2nd year</option>
                <option value="3">3rd year</option>
                <option value="4">4th year</option>
            </select>
            <span class="error year_err" style="color:red;font-size:12px"></span>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" id="" class="form-control" placeholder="password" style="margin-bottom: 0px;">
            <span class="error password_err" style="color:red;font-size:12px"></span>
           
        </div>
        <div class="form-group">
            <label for="">Confirm Password</label>
            <input type="password" name="password_confirmation" id="" class="form-control" placeholder="confirm password" style="margin-bottom: 0px;"> <span class="error password_confirmation_err" style="color:red;font-size:12px"></span>
            {{-- <span id="passwordHelpBlock" class="form-text text-muted">
               *password must be 6 characters long, should contain at least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
            </span> --}}
        </div>
        <br>
        <div class="from-group">
            <button type="submit" class="form-control btn btn-primary btn-lg" name="sign_up">signup</button>
        </div>
    </form>
    
    </div>
    
    <script>
        $(document).ready(function(){
            $("#register-frm").submit(function(e){
                e.preventDefault();
                var formData=$(this).serialize();
                $.ajax({
                    url:'http://localhost:8000/api/student-register',
                    type:'POST',
                    data:formData,
                    success:function(data){
                       // console.log(data);
                       if(data.msg){
            $("#register-frm")[0].reset();
            $(".error").text("");
           $('.result').text(data.msg);
          alert(data.msg);
          window.open('/','_self');
           
 
 //  var popup = window.open('/','_self');
//popup.onload = function() {  $(".login").click(); };

           }else{//$(".login-btn").click();
            printErrorMsg(data);
           }
                    }
                })

            })
        })
        function printErrorMsg(msg){
        $.each(msg,function(key,value){
            if(key=='password'){
                //console.log(value);
                if(value.length>1){
                    $(".password_err").text(value[0]);
                    $(".password_confirmation_err").text(value[1]);
                }else{
                    if(value[0].includes("password confirmation")){
                        $(".password_confirmation_err").text(value);
                    }else{
                        $(".password_err").text(value);
                    }
                }
            }else{
                $("."+key+"_err").text(value);
            };

        });
    }
    </script>

</body>
</html>