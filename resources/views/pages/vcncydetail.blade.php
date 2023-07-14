<div class="job-des-part-1">
    <div class="company-detail-sec">
        <img  src="img/company.png" class="company-logo" alt="">
        <h1>{{$job->post}}</h1>
        <h3>{{$job->company_name}}</h3>
        <p>{{$job->company_location}} </p> 
        <h3>deadline: {{$job->deadline}}</h3>
    </div>
    <div class="job-detail-sec">
        {{-- <h4>created: 2023-03-12</h4> --}}
        <input type="hidden" name="" id="sendid" value={{$job->job_id}}>
      <h3>job Id: {{$job->job_id}}</h3>
        <p>Department: {{$job->branch}}</p>
        <p>Job Type: {{$job->type}}</p>
        <p>Work From: {{$job->work_from}}</p>
        <p>Package:{{$job->package}}LPA</p>
        <p>batch: {{$job->batch}}</p>
        
       
    </div>
</div>




<div class="job-des-part-2">
    <h3>About company</h3>
    <p>{{$job->about_company}}</p>

    <h3>job Description</h3>
    <p>{{$job->job_description}}</p>

    <h3>Requirement</h3>
    <p>{{$job->requirement}}</p>

@if(session()->get('usertype')==2 || session()->get('usertype')==3)

    <h3>Instruction</h3>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque fugiat vitae consectetur est? Molestias unde quo dignissimos illo iusto temporibus. Natus asperiores alias quis, nisi fugit deserunt maxime! Aliquid, dolores!</p>

    @endif
    @if(session()->get('usertype')!=0)
    <br>
<div style="display:flex; justify-content: space-between">
@isset($job->attachment)
<h3>Attachment <a href="{{url('download',$job->attachment)}}" class="btn btn-primary">Download <i class="fa-solid fa-cloud-arrow-down"></i> </a></h3>
@endisset

   <h3>Any Query? <a href="" id="askQuery" class="btn btn-primary">Ask now</a></h3>  
</div>
<br/> <br/>
   <a href="{{$job->job_link}}"style="float:left" class="btn btn-primary btn-lg common-btn">Apply now</a>
   @endif
</div>

 {{-- @php
$id= `<script>
$("#sendid").val();
</script>`;
$id=123;
@endphp --}}

<script>
    
 
    $("#askQuery").on('click',function(e){
e.preventDefault();
id=$("#sendid").val();
var routeUrl = "{{ route('query.quryFrmLoad',':id') }}";
var finalUrl = routeUrl.replace(':id', id);
console.log(finalUrl);
$.ajax({
  //  url:'query-form/',

// url:"{{url('query.quryFrmLoad')}}/"+id,

url:finalUrl,
    type:'GET',
    success:function(res){
      $(".user-job-dtl-sec").html(res);
    }    

})
});
</script>