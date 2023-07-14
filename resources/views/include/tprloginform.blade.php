<h2 style="color:#484646;">Login form</h2>
        <form class="form col-lg-8" id="tprlog"
        {{--action="tpr" method="post"--}}>
            @csrf
         
                <input type="email" name="userid" class="form-control mb-4 in s-in" placeholder="enter email id" >
   
                <input type="password" class="form-control mb-4 in s-in" name="password"  placeholder="enter your password">
         
            <button type="submit"  class="btn btn-primary login-btn">login</button>
            <p>Forget password?<a href=""  onclick="adminfrgt(event,2)">Click here</a></p>
            
        </form>
        <script>
            $().ready(function(){
$("#tprlog").submit(function(e){
e.preventDefault();
//alert("hii");

$.ajax({
    url:"/tpr",
    type:"POST",
    data:$("#tprlog").serialize(),
    success:function(data){
       if(data.success==true)
       {
        window.open('/tpr','_self');
       }
    }
})
})
            });
        </script>