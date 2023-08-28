<h2 style="color:#484646;">Login form</h2>
        <form class="form col-lg-8"action="/admin/login" method="post">
         @csrf
                <input type="text" name="username" autocomplete="off" class="form-control mb-4 in s-in" placeholder="username" >
   
                <input type="password" class="form-control mb-4 in s-in" name="pass"placeholder="password" >
         
            <button type="submit"  class="btn btn-primary login-btn">login</button>
            <p>Forget password?<a href="" {{--href="forgetpass" --}}onclick="adminfrgt(event,3)">Click here</a></p>
            <p> Are you a tpr?<a href="" onclick="tprlogin(event)">Click here for login</a></p>

            <?php 
            
            ?>
        </form>