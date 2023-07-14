@php $usertype=session()->get('usertype');
@endphp
<!-- start of profiles -->
<section id="prfl-section"  class="section-id admin-section">
    <h1 class="common-heading">My profile</h1>

   
    <div class="edit-profile">
      
      <img src="img/profile.png" class="profile-img"  alt="">
      <form action="" id="prfldata"class="admin-data" method="">
        @csrf

        <input type="hidden" name="id" value="{{$user->id}}">
        <label for="uname" class="from-group">
        <p> User name :  </p>
        
          <input type="text" class="prfl-disbl e-ad-dt" name="name" id="uname" disabled value="{{$user->name}}"> <br>
          <span style="color:red" class="error name_err"></span>
          {{-- <button class="prfl-e-btn" id="ename" type="button"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        </label>
       
        <label for="post" class="from-group">
        <p>Contact :  </p>
          <input type="number" name="contact" class="prfl-disbl e-ad-dt" id="post" disabled value="{{$user->contact}}"> <br>
          <span style="color:red" class="error contact_err"></span>
          {{-- <button type="button"class="prfl-e-btn" id="epost"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        </label>
       
        <label for="email" class="from-group">
        <p> Email:  </p>
          <input type="email" name="email" class="prfl-disbl e-ad-dt" id="email" disabled value="{{$user->email}}">
          <br>
          <span style="color:red" class="error email_err"></span>
          {{-- <button type="button" class="prfl-e-btn" id="eemail"><i class="fa-solid fa-pen-to-square"></i></button> --}}
        </label>

        @if($usertype==2 || $usertype==1)
        <label for="branch" class="from-group">
          <p> Branch:  </p>
         
            <input type="text" name="branch" class="prfl-disbl e-ad-dt" id="branch" disabled value="{{$user->branch}}"><br>
            <span style="color:red" class="error branch_err"></span>
            {{-- <button type="button" class="prfl-e-btn" id="eemail"><i class="fa-solid fa-pen-to-square"></i></button> --}}
          </label>
          <label for="year" class="from-group">
            <p> Year:  </p>
              <input type="number" name="year" class="prfl-disbl e-ad-dt" id="year" disabled value="{{$user->year}}"><br>
              <span style="color:red" class="error year_err"></span>
              {{-- <button type="button" class="prfl-e-btn" id="eemail"><i class="fa-solid fa-pen-to-square"></i></button> --}}
            </label>
            @endif
           
      
        <button class="btn btn-primary common-btn" style="margin-left:0;display:none;" type="submit" value="save" id="save">Save</button>

        <button class="btn btn-primary common-btn" style="margin-left:0;"  value="edit" id="edit">Edit</button>
      </form>

    </div>
    
    <div class="result" style="color:green"></div>
  </section>
  <!-- end of profile -->

  <script>
    $().ready(function(){
$("#edit").on('click',function(e){
e.preventDefault();
$("#save").css('display','block');
$("#edit").css('display','none');
$('.prfl-disbl').removeAttr('disabled');
$('.prfl-disbl').css('cursor','text');
//$('.className').removeAttr('click style')
});

});
  </script>

@if($usertype==3)
<script>
  $().ready(function(){
$("#save").on('click',function(e){
e.preventDefault();
var formdata=$("#prfldata").serialize();


$.ajax({
  url:'admin/update',
  type:"POST",
  data:formdata,
  success:function(data){
 if(data.success==true){
  $(".result").text(data.msg);
  $(".error").text('');
 }else{
  console.log(data);
  //$("."+key+"_err").text(value);
 }
  }
})
});
    });
  </script>
  @elseif($usertype==2)
  <script>
    $().ready(function(){
  $("#save").on('click',function(e){
  e.preventDefault();
  var formdata=$("#prfldata").serialize();
  
  
  $.ajax({
    url:'tpr/update',
    type:"POST",
    data:formdata,
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
  @endif
  