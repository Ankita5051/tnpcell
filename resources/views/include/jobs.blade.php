

@foreach($jobs as $job)     
<div class="jb" onclick="jobDetail(event,{{$job->id}})">
    <img  src="img/company.png" class="company-logo" alt="">
<div class="company_info">
    <h2>{{--<i class="fa-regular fa-id-badge"></i>--}}     {{$job->post}}</h2>
    <h4><i class="fa-regular fa-building"></i>  {{$job->company_name}}</h4>
     <p><i class="fa-solid fa-location-dot"></i>  {{$job->company_location}}
        </p> </div> 
     <div class="job-info">
        <h4><i class="fa-solid fa-money-bill-1-wave"></i>  {{$job->package}}</h4>
        <h4><i class="fa-solid fa-briefcase"></i>  
            {{-- <i class="fa-regular fa-id-badge"></i> --}}
            {{$job->type}}</h4>
        <h4><i class="fa-regular fa-calendar-xmark"></i>   @php
            $s = $job->deadline;
            $dt = new DateTime($s);
            //print_r ($dt);
            $date = $dt->format('Y-m-d');
            //$time = $dt->format('H:i:s');
            
            @endphp {{$date}}
            </h4>
     </div>
     <div class="expiry">
        <button class="btn btn-primary common-btn">know more</button>
        <p> <i class="fa-regular fa-calendar-check"></i>   @php
            $d=$job->created_at;
            $dt=new DateTime($d);
            $date=$dt->format('Y-m-d');
            @endphp  {{$date}}</p>
     </div>
  
    </div>
@endforeach