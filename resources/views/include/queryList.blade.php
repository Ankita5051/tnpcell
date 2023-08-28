
@php
    $usertype=session()->get('usertype');
@endphp
    @foreach($chats as $chat)
   
    <li id="{{$chat->id}}" onclick="chatDetail(event,{{$chat->id}})"@if(($chat->usertype==2 && $usertype==3) || ($chat->usertype==3 && $usertype==2))  style="background:rgb(240, 245, 251);" @endif>
      <div class="q-item">
        <span><h3 class="common-heading"> {{$chat->name}}</h3> 
          <p>@php
            $d=$chat->updated_at;
            $dt=new DateTime($d);
            $date=$dt->format('Y-m-d');
            @endphp  {{$date}}</p>
        </span>
        <p>{{$chat->subject}}</p>
        <p style="overflow:hidden;width:98%;display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical; ">{{$chat->query}} </p>
      </div>
    </li>

  @endforeach
