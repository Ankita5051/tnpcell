
<!-- job post section -->

<div id="job-post " class=" show section-id  job-post">
 

  <h1 class="common-heading">fill details of job.</h1>
  <form 
 id="jbpst_frm"
 action="{{url('create_job')}}"
  method="post"   class="job-del-form" enctype="multipart/form-data">
  @csrf

  <label for="type" class="form-group">
   
    Onsite : &nbsp; <input type="radio" name="work_from" value="onsite" >
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 
    Home : &nbsp; <input type="radio" name="work_from"value="home">
  </label>
  <label for="field" class="form-group">
    Technical : &nbsp; <input type="radio" name="field" value="tech" >
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 
    Non Technical : &nbsp; <input type="radio" name="field"value="nontech">
  </label>

  <label for="link" class="form-group">
          job Url : <input class="form-control j-pst-in" type="link" name="job_link"  placeholder="link" id="link">
      </label>

      <label for="type" class="form-group">
  Job type :<select name="type" id="type" class="form-control j-pst-in select"  placeholder="eg. internship,full time job">
      <option value="0" >select..</option>
      <option value="internship" >internship</option>
      <option value="job">full time job</option>
  </select></label>

 

  <label for="type" class="form-group">
    experience :
    <select name="experience" id="exprnc" class="form-control j-pst-in select" placeholder="in year">
        <option value="" >select..</option>
        <option value="0" >fresher</option>
        <option value="1">1 year</option>
        <option value="2">2 year</option>
        <option value="3">3 year</option>
      
    </select></label>

    <label for="type" class="form-group">
      Batch :<select name="batch" id="batch"  class="form-control j-pst-in select" >
          <option value="0" >select..</option>
          <option value="2022" >2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>

      </select></label>

  <label for="branch" class="form-group">
  branch :
  <br><br>
CSE <input type="checkbox" name="branch[]" value="CSE" id=""> &nbsp;&nbsp;&nbsp;&nbsp;
EL  <input type="checkbox" name="branch[]" value="EL" id=""> &nbsp;&nbsp;&nbsp;&nbsp;
EE  <input type="checkbox" name="branch[]" value="EE" id="">
</label>
      <label for="package" class="form-group">
          Package: <input class="form-control j-pst-in" type="number" name="package"  placeholder="enter pacakage in lpa">
      </label>
      <label for="company" class="form-group">
         Company name: <input class="form-control j-pst-in" type="text" name="company_name" placeholder="enter company name">
      </label>
      <label for="location">
        Company Location : <input type="text" name="company_location"  placeholder="eg. Uttar pradesh, India" class="form-control j-pst-in select" >
      </label>
      <label for="about_company" class="form-group">
        About company :  <textarea class="j-pst-in form-control" name="about_company"  cols="30" rows="4" placeholder="about company"></textarea>
      </label>
  <label for="post" class="form-group">
      Post: <input  class=" form-control j-pst-in"type="text" name="post" placeholder="enter post name" >
  </label>

  <label for="deadline" class="form-group">
  Deadline:
      <input type="datetime-local" class=" form-control j-pst-in" name="deadline" placeholder="enter deadline in YYYY-MM-DD format" >
  </label>
  <label for="requirement" class="form-group">
      requirement: <textarea  class="form-control j-pst-in " name="requirement"  cols="30" rows="4" placeholder="enter requirement.."></textarea>
  </label>
  <label for="job_description" class="form-group">
    Job description:  <textarea class="j-pst-in form-control" name="job_description"  cols="30" rows="4" placeholder="job description"></textarea>
  </label>

  <label for="instruction" class="form-group"> Additional: &nbsp

    <textarea name="additional"  class="j-pst-in form-control" cols="30" rows="4" placeholder="Additional Info of vacancy"></textarea>

</label>

  <label for="instruction" class="form-group"> Instruction: &nbsp

      <textarea name="instruction"  class="j-pst-in form-control" cols="30" rows="4" placeholder="any instruction for tprs"></textarea>

  </label>


  <label for="attachment" class="form-gropu">
    Any attachment:

    <input type="file" style="display:block;border: none;"  class="j-pst-in form-control"   name="attachment" id="file" >

  </label>
{{-- 
  <div class="progress" id="progress_bar" style="display:none;height:50px;line-height: 50px">
  <div class="progress-bar" role="progressbar" id="progress_bar_progress" style="width: 0%;">0%</div>
  </div> --}}
  <span>
  <button type="submit"  name="status" id="jb-post"value="active"class=" btn btn-primary form-control common-btn" 
   {{--onclick="createjob(event)"--}}
  >post job</button>

  @if(session()->get('usertype')!=2)
  <button type="submit"class="common-btn btn btn-primary" name="status" value="inactive" >To TPR</button>
@endif
</span>
  </form>
  </div>

  <!-- end of job post section -->


  <script>
//   $("#jbpst_frm").submit(function(e){
//     e.preventDefault();
//     alert("ha");
//   });


//     function createjob(e){
// e.preventDefault();
// alert("hii");

//  var formdata=("#jbpst_frm").serialize();
//  console.log(formdata);
//              $.ajax({
//                  url:'/create_job',
//                  type:'POST',
//                  data:formdata,
//                  success:function(data){
//                      console.log(data);
//                  }
//              })

//   }


// alert("here");
  </script>