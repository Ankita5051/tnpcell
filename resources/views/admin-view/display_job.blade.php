
<!-- start of job section -->
<section id="job-dtl-section"  class="section-id admin-section">
    <h1 class="common-heading" style="text-align:center">JOB SECTION</h1>
    <form class="job-search" >

      <input class="search-box"type="text" id="key" name="search" placeholder="write keyword eg.branch, post, company,package, jobId,deadline(YYYY-MM-DD)" > 
      <button class="search-btn" onclick="search_job(event)" ><i class="fa-solid fa-magnifying-glass "></i></button>
    </form>
  
  
  
   
  <table class="common-table job-table">
  <tr><th><h3> S no.</h3></th> <th><h3>JobId</h3></th>
    <th><h3>Field</h3></th> <th><h3>Type</h3></th>
    <th><h3>Post name</h3></th> <th><h3>Company</h3></th> <th><h3> Package</h3></th> <th><h3>Status</h3></th> {{--<th><h3>Edit</h3></th>--}} <th><h3>  view</h3></th><th><h3>Remove</h3></th> </tr>
  
  
  @foreach($jobs as $dt)
 
  <tr><td><p>{{$dt->id}}</p></td> 
    <td><p>
        @if($dt->job_id)  {{$dt->job_id}} @elseif(!$dt->job_id) NA @endif
    </p></td>
    
    <td><p>
      @if($dt->field)  {{$dt->field}} @elseif(!$dt->field) NA @endif
  </p></td>

    <td><p>
      @if($dt->type)  {{$dt->type}} @elseif(!$dt->type) NA @endif
  </p></td>

    <td><p>
    @if($dt->post)  {{$dt->post}} @elseif(!$dt->post) NA @endif
</p></td> 
<td><p>   @if($dt->company_name)  {{$dt->company_name}} @elseif(!$dt->company_name) NA @endif</p></td>
 <td><p>   @if($dt->package)  {{$dt->package}} @elseif(!$dt->package) NA @endif</p></td>  
  <td><p>   @if($dt->status)  {{$dt->status}} @elseif(!$dt->status) NA @endif</p></td>
   {{-- <td><p><i id="tpr-edit" class="fa-regular fa-pen-to-square"></i></p></td> --}}
   <td><p><a href="{{url('/job/detail')}}/{{$dt->job_id}}"></a><i id="tpr-rem jobview" class="fa fa-eye" onclick="jobview({{$dt->job_id}})"></i></p></td>
   <td><p> <a href="{{url('/job/remove')}}/{{$dt->job_id}}"><i id="tpr-rem"  class="fa-regular fa-trash-can"></i></a></p></td>
</tr>

    @endforeach


  </table>
    
  </section>
  

  <script>
 
  </script>
  <!-- end of job section -->
  