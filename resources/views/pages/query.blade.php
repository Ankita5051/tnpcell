{{-- @extends('layouts.app')
@section('main-section') --}}


@php
$usertype=session()->get('usertype');
$userid=session()->get('userid');
$operator='!=';
@endphp

<section @if($usertype==2 || $usertype==3) class="section-id admin-section" @endif>


@if($usertype==0)
<div class="query-banner">
    <div class="job-para">
       <h1 class="common-heading">Query</h1>
       <p class="banner-para">
         Clear your doubts here
       </p>
    </div>
    <img class="q-jon-icon"src="img/query.webp" alt="">
   </div>
   
   
   @endif
   
   <div class="search-query">
      <input class="query-box" type="text" name="qry-search" id="qry-search" placeholder="type your question here or specific keyword">
      <button type="button" class="qry-s-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
   </div>
   

   

<script>
    Echo.channel('messageChannel').listen('MessageEvent',(data)=>{
        console.log(data);
    });

    Echo.join('status-update').listen('status-update',(e)=>{
        console.log(e);
    });
</script>
   <section class="query-section">
     
   <div class="notification">
     <div class="notice-wrapper">
   <div class="notice-btn">
    <button class="switch-btn active" id="all-query">All query</button>
   <button class="switch-btn" data="" id="my-query">My query(1)</button></div>
   
   
   
   <ul class="all-queries">
    
   {{-- query list --}}


  
        
   </ul> 
   
   
   <!-- <form action="" class="query-form" method="post">
      <label for="email" class="form-group">
         <input type="text" name="name" id="" placeholder="name" class="form-control">
      </label>
      <textarea name="question" id="question" cols="6" rows="5">
         Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure dolore eum eveniet laborum voluptas velit labore eligendi ad perspiciatis tempore ipsam ducimus animi ex possimus optio, tempora mollitia modi quod?
      </textarea>
   </form> -->
   
   </div>
     <div class="view-message">
      
     
     
     </div>
   </div>
   </section> 

  </section>
   {{-- @endsection --}}

   <script>
     $().ready(function(){
       $("#all-query").click();
     })
     $("#all-query").on('click',function(e){
 e.preventDefault();
      var list='all';
      $('#my-query').attr('data', '');
     $("#all-query").addClass('active');
     $("#my-query").removeClass('active');
       $.ajax({
         url:"{{route('query.list')}}",
         type:'POST',
         data:{list:list},
         success:function(res){
          $(".view-message").text('');
          $(".all-queries").html(res);
         }
       })
     });
      $("#my-query").on('click',function(e){
        e.preventDefault();
        var list='my';
        // Add an attribute to an element
$('#my-query').attr('data', 'my');
$("#all-query").removeClass('active');
     $("#my-query").addClass('active');

        $.ajax({
          url:"{{route('query.list')}}",
          type:'POST',
          data:{list:list},
          success:function(res){
            $(".view-message").html(' <button  onclick="newQuery(event)" class="btn btn-primary btn-lg m-3">New query</button>');
         $(".all-queries").html(res);
        

        }
      })

   })

   function chatDetail(e,id){
e.preventDefault();
$.ajax({
    url:"query/"+id,
    type:'GET',
    success:function(res){
      if(res){
        $(".view-message").html(res);
// Get the value of an attribute
var checkSwitch = $('#my-query').attr('data');

        if(checkSwitch=='my'){
          $(".forward").css('display','none');
        }
      }
  
    }
})
   }

   function newQuery(e){
    e.preventDefault();

    id=0;
var routeUrl = "{{ route('query.quryFrmLoad',':id') }}";
var finalUrl = routeUrl.replace(':id', id);
console.log(finalUrl);
$.ajax({
url:finalUrl,
    type:'GET',
    success:function(res){
      $(".view-message").html(res);
    
    }    

})
   }
  



  
   </script>