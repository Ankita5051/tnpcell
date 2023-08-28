{{-- job page --}}
    {{-- @extends('layouts.app')
@section('main-section') --}}
@php
$usertype=session()->get('usertype');
@endphp

@if($usertype!=1)
    
    <div class="job-banner">
     <div class="job-para">
        <h1 class="common-heading">Job search</h1>
        <p class="banner-para">
        Find a job you'll love fast with expert advice from recruitment experts. Follow step-by-step instructions and master the job search. 
        </p>
     </div>
     <img class="jon-icon"src="img/job.png" alt="">
    </div>
    @endif
    
    @if($usertype ==1)
    <form class="job-search" >

        <input class="search-box"type="text" id="key" name="search" placeholder="write keyword eg.branch, post, company,package, jobId,deadline(YYYY-MM-DD)" > 
        <button class="search-btn" onclick="search_job(event)" ><i class="fa-solid fa-magnifying-glass "></i></button>
      </form>
@endif    
    <div class="job-wrapper" style="padding-top:5%;">
    <div class="filter">
    <h1 class="common-heading"><i class="fa-solid fa-filter"></i> Apply filter</h1>
    <form class="filters" >
        @csrf
    <label for="company" class="form-group">
            company : <input type="text" class="form-control f-in"name="company" id="" placeholder="eg.amazon" required>
        </label>
        <label for="post" class="form-group">
            post : <input type="text" class="form-control f-in"name="post" id="" placeholder="eg.software developer">
        </label>
      
        <label for="branch" class="form-group">
    branch :<select name="branch" id="" class="form-control  f-in">
    <option value="" >select..</option>
        <option value="CSE" >CSE</option>
        <option value="EL">EL</option>
        <option value="EE">EE</option>
    </select></label>
        <label for="package" class="form-group">
            package : <input type="number" class="form-control f-in"name="package" id="" placeholder="eg.12lpa">
        </label>
        <label for="location" class="form-group">
            location : <input type="text" class="form-control f-in"name="location" id="" placeholder="eg.lucknow">
        </label>
        <label for="deadline" class="form-group">
            deadline : <input type="date" class="form-control f-in"name="deadline" id="" placeholder="eg.yyyy|mm|dd">
        </label>
        {{-- <input type="button" value=""name="filter-btn" id="filter-btn" hidden> --}}
        <input type="submit" value="Apply filter" id="filter-btn" class="btn btn-primary "> 

        {{-- <a href="" id="filter-btn"  class="btn btn-primary ">Apply filter </a>  --}}
    </form>
    
    
    </div>
    <div class="jobs">

       

        @foreach($jobs as $job)     
        <div class="jb" id="{{$job->job_id}}" onclick="jobDetail(event,{{$job->id}})">
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
    
    </div>


   <div class="user-job-dtl-sec">

   </div>

    </div>
    

    <script>


        $().ready(function(){
//$('.jobs > .jb').click();
$('.jobs div:first-child').click();
// $('.jobs div:first-child').css('background','#ddd');
        });

      $("#filter-btn").on('click',function(e){
        e.preventDefault();
       // alert("hii");
      //  data=$(".filters input:input[value!='']").serialize();

      var formData = $(".filters :input")
    .filter(function(index, element) {
        return $(element).val() != '';
    })
    .serialize();

       // console.log(formData);
        $.ajax({
            url:"/job/filter",
            type:"POST",
            data:formData,
            success:function(res){
                $(".jobs").html(res);
               // console.log(res);
            //    $(".jb").css('background','white');
               $('.jobs div:first-child').click();
            //    $('.jobs div:first-child').css('background','#ddd');
            }
        })
       // console.log(data);
      })
        function jobDetail(e,id){
            e.preventDefault();
           
            $.ajax({
                url:'/jobdetail/'+id,
                type:'GET',
                success:function(res){
                   $(".user-job-dtl-sec").html(res); 
            //        $(".jb").css('background','white');
            // $("#"+id).css('background','#ddd');

                }
            })
        }
    </script>