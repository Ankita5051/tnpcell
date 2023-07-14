<!-- start of home page -->
       
    <div class="s-bann">
        <h1 class="s-ban-head">Find your dream job now</h1>
        <input type="text" name="search" id="" style="cursor:default;">
    </div>
<div class="s-view-sec-2">
<div class="job-of-the-day">
    <h1 class="common-heading">Job of the day</h1>
    <div class="job-wrapper">

        @foreach($jobs as $jb)
        <div class="job">
            <div class="job-detail">
                <img src="img/company.png" class="company-logo" alt="">
                <div> <h4 style="font-size:1.2rem">{{$jb->post}}</h4>
            <p><i class="fa-solid fa-location-dot"></i> &nbsp; {{$jb->company_location}} </p>
            <p><i class="fa-solid fa-money-bill-1-wave"></i> {{$jb->package}}lpa</p>
            <p><i class="fa-solid fa-calendar-days"></i>@php
                $s = $jb->deadline;
                $dt = new DateTime($s);
                $date = $dt->format('Y-m-d');                
                @endphp {{$date}}</p>
            </div>
            </div>
        
        <button class="btn btn-primary btn-sm common-btn" onclick="knowMore(event,{{$jb->job_id}},'{{$jb->type}}')">Know more</button>
        {{-- <h5><i class="fa-solid fa-calendar-days"></i> 01/12/2022</h5> --}}
        </div>
        @endforeach
      
    </div>


</div>
<div class="whats-new">
    <h1 class="common-heading">
        What's new
    </h1>

    <div class="slider">
        <ul id="list1">
          <li><h1 style="color:rgb(59, 59, 118)"> Today is last day of TCS application.</h1></li>
          <li><h1 style="color:rgb(59, 59, 118)">ABC drive coming today.</h1></li>
          <li><h1 style="color:rgb(59, 59, 118)">XYZ drive coming tomorrow.</h1></li>
         
        </ul>
        
        {{-- <ul id="list2">
            <li><h1>Abc drive coming today list2</h1></li>
            <li><h1>SAbc drive coming today</h1></li>
            <li><h1>TAbc drive coming today</h1></li>
           
          </ul>
      </div> --}}

      {{-- <div class="slider2">
      
      </div> --}}

</div>
</div>


