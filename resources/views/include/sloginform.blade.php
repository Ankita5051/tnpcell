<h2 style="color:#484646;">Login form</h2>
        <form class="form col-lg-8"
        {{-- action="student" --}} id="stdn-login-frm" >         
         <p id="log-msg" style="color:red;"></p>
         <span class="error email_err" style="color:red;"></span>
                <input type="email" name="email" class="form-control mb-4 in s-in error" id="s-eml"placeholder="enter email id" >
<span class="error password_err" style="color:red;"></span>
                <input type="password" class="form-control mb-4 in s-in error" name="password" id="s-pas" placeholder="enter your password">
                
          <input type="submit" value="login" class="btn btn-primary login-btn" onclick="studentloginfrm(event)"id="stdn-login">
            {{-- <button type="submit"  class="btn btn-primary login-btn">login</button> --}}
            <p>Forget password?<a href="" onclick="adminfrgt(event,1)">Click here</a></p>
            <p>Don't have account?<a href="register">Create one</a></p>
        </form>



        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  
        <script>

            // $().ready(function(){
            //     $("stdn-login").on('click',function(event){
            //         alert("hii");
            //         e.preventDefault();
            //     })
            // })
// $().ready(function(){

//      console.log("hlw");
//      function studentloginfrm(event){
//         alert("hii");
//         event.preventDefault();
//         var formData=$(this).serialize();
//         console.log(formData);
//         $.ajax({
//               url:'http://localhost:8001/api/student-login',
//               type:'POST',
//               data:formData,
//               success:function(data){
//                   console.log(data);
//              }
//             }).fail(function(){
//                 console.log("error");
                
//             })
//     }
// });

// function studentloginfrm(event){
    
//     event.preventDefault();
//     console.log("hii");
//     //alert("hii");
//     var formData=$(this).serialize();
//     console.log(formData);
//     $.ajax({
//         url:'http://localhost:8001/api/student-login',
//         type:'POST',
//        data:formData,
//         success:function(data){
//             console.log(data);
//         }
//     })
//     event.preventDefault();
// }
      
        </script>