<section class="section-id admin-section">

    <h1>JOB DETAIL</h1>
    <p style="color:rgb(125, 121, 121);font-size:11px;font-style: italic;">*link, type, field, branch, package, company name, company location, post and requirement are required to make active. <br>
    *link and instruction is required to make inactive.</p>
    <br> <br>
<form method="POST" id="update-frm"action="" enctype="multipart/form-data">

<div class="part-1">

<div class="part-11">

    <div class="in-space">
        <label  class="form-group"><p style="margin-bottom: -1rem;"> Post:  </p></label>
        <input  class=" form-control" type="text" name="post" value="@if($jb->post){{$jb->post}} @endif" >
   </div>
   <div class="in-space">
       <label  class="form-group"><p style="margin-bottom: -1rem;"> Company:  </p></label>
       <input  class=" form-control" type="text" name="company_name"  value="@if($jb->company_name){{$jb->company_name}} @endif" >
  </div>
  <div class="in-space">
    <label  class="form-group"><p style="margin-bottom: -1rem;">  Location:  </p></label>
    <input  class=" form-control" type="text" name="company_location"  value="@if($jb->company_location){{$jb->company_location}}  @endif" >
</div>

<div class="in-space">
    <label for="" class="form-group"><p style="margin-bottom: 0;">   Type: </p></label>
    <select name="type" id="" class="form-control">
        <option value="0">select..</option>   
    <option value="job" @if($jb->type && $jb->type=='job')selected @endif>full time job</option>
        <option value="internship"  @if($jb->type && $jb->type=='internship')selected @endif >internship</option>
    </select>
</div>

<div class="in-space">
    <label for="" class="form-group"><p style="margin-bottom: 0;">   Field: </p></label>
    <select name="field" id="" class="form-control">
        <option value="0">select..</option>   
    <option value="tech" @if($jb->field && $jb->field=='tech')selected @endif>Technical</option>
        <option value="nontech"  @if($jb->field && $jb->field=='nontech')selected @endif >Non-technical</option>
    </select>
</div>

<div class="in-space">
    <label for="" class="form-group"><p style="margin-bottom: 0;">   Experience: </p></label>
    <select name="experience" id="" class="form-control">
        <option value="">select..</option>
    <option value="0">fresher</option>   
    <option value="1" @if($jb->experience && $jb->experience=='1')selected @endif>1 year</option>
    <option value="2" @if($jb->experience && $jb->experience=='2')selected @endif>1 year</option>
    <option value="3" @if($jb->experience && $jb->experience=='3')selected @endif>1 year</option>
    </select>
</div>

<div class="in-space">
    <label for="" class="form-group"><p style="margin-bottom: 0;">   Package in LPA: </p></label> 
    <input  type="number" class=" form-control" name="package" value="@if($jb->package){{$jb->package}}@endif">
</div>

    
</div>

<div class="part-12">

    <div class="dates"> 
        {{-- <input class="rem-style"type="tex" name="" value="ram" disabled> --}}
        @if(session()->get('usertype')==3 || session()->get('usertype')==2)
        
        <div class="in-space">
            <label class="form-group" ><p style="margin-bottom: -1rem;"> Created at: </p></label>
            <input class=" form-control" type="datetime" name="created" value="@if($jb->created_at){{$jb->created_at}} @endif" disabled>
        </div>
       
        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;"> updated at:</p></label>
              <input  class=" form-control" type="datetime" name="updated" value="@if($jb->updated_at){{$jb->updated_at}} @endif" disabled >
        </div>
       
        @endif

        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;"> deadline: </p></label>
              <input  class=" form-control" type="datetime" name="deadline" value="@if($jb->deadline){{$jb->deadline}} @endif"  >
        </div>

       
    </div>


    <div class="dates"> 
        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;">Work from: </p></label>
            <select name="work_from" class="form-control" id="">
                <option value="0">select</option>   
        <option value="onsite" @if($jb->work_from && $jb->work_from=='onsite')selected @endif>onsite</option>
            <option value="home"  @if($jb->work_from && $jb->work_from=='home')selected @endif >home</option> 
            </select>  
        </div>

        
        <div class="in-space" style="display:flex; justify-content: space-between;align-items: center;">
            <label class="form-group"><p style="margin-bottom: -1rem;"> Brach: </p></label>
            @php 
          
            $brnc =explode(',', $jb->branch);
        
           @endphp
           
            <span  style="display:flex; justify-content: space-between;align-items: center;font-size: 1.2rem;">
             CSE: &nbsp; &nbsp;
             <input type="checkbox" class="mr-3" name="branch[]" value="CSE" 
            @if(count($brnc)>=1 && $brnc[0]=='CSE' )   checked @endif >
        </span>
        <span  style="display:flex; justify-content: space-between;align-items: center;font-size: 1.2rem;">
            EL: &nbsp; &nbsp;
             <input type="checkbox" class="mr-3" name="branch[]" value="EL"
            @if(count($brnc)>1 && $brnc[1]=='EL' )   checked @endif >
        </span>
        <span  style="display:flex; justify-content: space-between;align-items: center;font-size: 1.2rem;">
            EE: &nbsp; &nbsp;
            <input type="checkbox" class="mr-3" name="branch[]" value="EE" 
           @if(count($brnc)>2  && $brnc[2]=='EE' )   checked @endif >
        </span>
         
        </div>

      
        {{-- <p>branch:
            @php 
          
             $brnc =explode(',', $jb->branch);
         
            @endphp
        
            
            CSE:
            <input type="checkbox" class="" name="branch[]" value="CSE" 
           @if(count($brnc)>=1 && $brnc[0]=='CSE' )   checked @endif >
        
           EL:
            <input type="checkbox" class="" name="branch[]" value="EL"
           @if(count($brnc)>1 && $brnc[1]=='EL' )   checked @endif >
           EE:
           <input type="checkbox" class="" name="branch[]" value="EE" 
          @if(count($brnc)>2  && $brnc[2]=='EE' )   checked @endif >
        
        
        </p> --}}
    </div>

</div>



</div>
   

    
{{--         
        <div class="jobdtl">
        <div> 
         
            </div>
        



        </div> --}}
        
        <div class="part-2">

            <div class="in-space">
                <label  class="form-group" for="job_link"><p style="margin-bottom: -1rem;">Job Link: </p> </label>
                    <input type="text" class="form-control"   name="job_link" id=""  @if($jb->job_link) value="{{$jb->job_link}}" @endif>
              
            </div>
        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;"> About Company: </p></label>
            <textarea name="about_company" class="form-control"  cols="30" rows="3" style="background-color: transparent; font-size: 1.5rem;width: 100%"> @if($jb->about_company){{$jb->about_company}} @endif
            </textarea>
        </div>

        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;"> About Job: </p></label>
            <textarea name="job_description" class="form-control" cols="30" rows="3" style="background-color: transparent; font-size: 1.5rem;width: 100%">@if($jb->job_description){{$jb->job_description}} @endif
            </textarea>
        </div>
        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;">Requirement: </p></label>
            <textarea name="requirement" class="form-control" 
            cols="30" rows="3" style="background-color: transparent; font-size: 1.5rem;width: 100%">  @if($jb->requirement){{$jb->requirement}} @endif  </textarea>
        </div>
            
        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;">Additional: </p></label>
            <textarea name="additional" class="form-control" 
            cols="30" rows="3" style="background-color: transparent; font-size: 1.5rem;width: 100%"> @if($jb->additional){{$jb->additional}} @endif </textarea>
        </div>
            
        <div class="in-space">
            <label class="form-group"><p style="margin-bottom: -1rem;">Instruction: </p></label>
            <textarea name="instruction" class="form-control" 
            cols="30" rows="3" style="background-color: transparent; font-size: 1.5rem;width: 100%"> @if($jb->instruction){{$jb->instruction}} @endif </textarea>
        </div>
      
<div class="d-flex ">
    <div class="in-space">
                
        <label class="form-group"><p style="margin-bottom: -1rem;">Attachment: </p></label>
        <input type="file" value="@if($jb->attachment){{$jb->attachment}} @endif" name="attachment" >
    </div>
    @if($jb->attachment)
            <div class="in-space">
                
                          
                <a href="download/{{$jb->attachment}}" class="btn btn-primary btn-sm" style="font-size: 1.5rem">  <i style="color:white"class="fa fa-download" aria-hidden="true"></i> Download</a>
            </div>
            @endif
</div>
          
         
          
            {{-- <br>
            @if($jb->attachment){{$jb->attachment}}
            <h3 id="infofile">For more info<a href=""> <i style="color: blue"class="fa fa-download" aria-hidden="true"></i></a></h3>
            @endif
            <h3 id="file">Attachment: <input class=""type="file" value="@if($jb->attachment){{$jb->attachment}} @endif" name="attachment" ></h3>
            <br><br>
     --}}
    
    

    
    
    @if(session()->get('usertype')!=3 && session()->get('usertype')!=2)
    <a href="" class="btn btn-primary btn-lg " style="font-size: 1.5rem">Apply now</a>
        @else
        <input type="submit" onclick="updatejob(event,{{$jb->id}})" class="btn btn-primary btn-lg"value="Update" style="font-size: 1.5rem" id="editbtn">
       {{-- <a href="{{url('/job/update')}}/{{$jb->id}}" class="btn btn-primary btn-lg " style="font-size: 1.5rem" onclick="enablefrm(event)" id="editbtn">Update</a>--}}
    
        <a href="{{url('/job/remove')}}/{{$jb->job_id}}" class="btn btn-primary btn-lg " style="font-size: 1.5rem">Delete</a>
    
        {{-- <a href="{{url('/job/update')}}/{{$jb->id}}" class="btn btn-primary btn-lg " style="font-size: 1.5rem;display:none;" id="savebtn">Save</a> --}}
    
        
        @endif
    
        </div>
        
</form>
</section>

<script>
    function updatejob(e,id){
        e.preventDefault();
var formData=$("#update-frm").serialize();
        $.ajax({
            url:'/job/update/'+id,
            type:'POST',
            data:formData,
            success:function(res){
             console.log(res);  
alert(res.msg);


            }
        })
    }
</script>