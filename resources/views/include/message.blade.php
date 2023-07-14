@php
$usertype=session()->get('usertype');
$userid=session()->get('userid');
$addclass='';
@endphp
@if($userid== $oldchat[0]->sender_id)
@php
    $addclass='mytext';
@endphp
@else
@php
   $addclass='otherstext'; 
@endphp

@endif
<div style="display:flex;align-items:center;justify-content: space-between;padding:auto 10px;">
    <div class="nt-tpr">
        <h2>{{$oldchat[0]->subject}}</h2>
        <p>asked by @if($addclass=='mytext') You @else {{$oldchat[0]->name}} @endif</p>
    </div>
  @if($usertype==2 && $oldchat[0]->usertype!=3)
    <input type="submit" class="btn btn-primary btn-lg mx-4 forward"value="forward to admin" onclick="forward(event,{{$oldchat[0]->id}})">
    @endif

    @if($usertype==3)
    <input type="submit" class="btn btn-primary btn-lg mx-4 forward"value="Remove from my side" onclick="forward(event,{{$oldchat[0]->id}})" >
    @endif
    
 </div>
  
    <div class="message">
  
  @if(isset($oldchat[0]->job_id))
  <h3> Job Id: {{$oldchat[0]->job_id}}</h3>
  @endif

<div id="{{$addclass}}">
    <div  @if($addclass=='mytext')class="in-query" @else class="out-reply" @endif>
        
        <p>{{$oldchat[0]->query}} </p>
    </div>
</div>

{{-- forech come here --}}

@foreach ($message as $chat )

@if($addclass=='mytext' && $chat->replyer_id!=$userid)
@php $addclass='otherstext'; @endphp
@elseif($addclass!='mytext' && $chat->replyer_id != $oldchat[0]->sender_id)
@php $addclass='mytext'; @endphp
@endif

<div id="{{$addclass}}">
    <div  @if($addclass=='mytext')class="in-query" @else class="out-reply" @endif>
   
    <p>{{$chat->message}} </p>
</div>
</div>

@endforeach
</div>

@if($oldchat[0]->sender_id==session()->get('userid') || $usertype!=1)
    <form class="write-ans" id="chat-form">
        @csrf
        <input type="hidden" id="chatid" value="{{$oldchat[0]->id}}">
        <input type="text" id="messagetxt" style="white-space:pre;width:85%;border:1px solid #ddd;padding:.3rem 1rem  " placeholder="write a message..." required> 
        <input type="submit"  id="send-reply" value="send">
      
        
     
    </form>
          @endif


          <script>
            $("#chat-form").submit(function(e){
    e.preventDefault();
   
    var message=$("#messagetxt").val();
  //  var chatId = $('#chat-form').children().first().val();
  //var chatId = $('#chat-form').children(':eq(1)');
var chatId =$('#chatid').val();
    $.ajax({
        url:"{{route('query.save')}}",
        type:'POST',
        data:{message:message,chat_id:chatId},
        success:function(res){
          if(res.success==true){

$("#messagetxt").val('');
let html=`<div id="mytext">
    <div class="in-query">
       
        <p>`+ res.msg +` </p>
    </div>
</div>`;
$(".message").append(html);
          }else{
            alert("some error occured");
          }
        }
    })

});
// $("#forward").on('click',function(e){
//     e.preventDefault();
//     alert("hii");
//     $.ajax({
//         url:''
//     })
// })
function forward(e,chatid){
  
    e.preventDefault();

    var check=confirm("Are you sure?");
   // alert(check);
    if(check){
        $.ajax({
        url:'query/'+ chatid +'/edit',
        type:'GET',
        success:function(res){
          
            alert(res.msg);
            if(res.success==true){
              $("#all-query").click();
            }
            
           
            }
    })
    }
   
}

          </script>