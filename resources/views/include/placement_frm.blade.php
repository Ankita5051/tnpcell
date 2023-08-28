<h1>Add Record</h1>
<form action="" class="p-2 plc-frm" @if(!isset($record['name'])) id="plc-frm" @else id="edit-plc-frm" @endif>
@csrf
    <label for="name" class="form-group">
        <p> Student Name: </p>
          <input type="text"  name="name" id="name" class="form-control in tpr-in" @if(isset($record['name'])) value={{$record['name']}} @endif>
          <span class="error name_err text-danger  h6"></span>
          </label>


          <label for="company" class="form-group">
          <p> Company : </p>
          <input type="text" name="company" id="company" class="form-control in tpr-in " require="true"  @if(isset($record['name'])) value={{$record['company']}} @endif>
          <span class="error company_err text-danger  h6"></span>
        </label>
        <br>
          <label for="post" class="form-group">
          <p>Post : </p> 
          <input type="text" name="post" id="post" class="form-control in tpr-in " require="true"  @if(isset($record['name'])) value={{$record['post']}} @endif>
          <span class="error post_err text-danger  h6"></span>
          </label>

          <label for="package" class="form-group">
            <p>Package : </p> 
            <input type="number" name="package" id="package" class="form-control in tpr-in " require="true"  @if(isset($record['name'])) value={{$record['package']}} @endif>
            <span class="error package_err text-danger  h6"></span>
            </label>

          <label for="branch" class="form-group">
            <p>Branch: </p> 
            <select name="branch" id="branch" class="form-control in tpr-in select">
                <option value="0" >select..</option>
                    <option value="CSE"  @if(isset($record['name']) && $record['branch']=='CSE') selected @endif >CSE</option>
                    <option value="EL"  @if(isset($record['name']) && $record['branch']=='EL') selected @endif>EL</option>
                    <option value="EE"  @if(isset($record['name']) && $record['branch']=='EE') selected @endif>EE</option>
                </select>
                <span class="error branch_err text-danger  h6"></span>
            </label>
            <label for="batch" class="form-group">
                <p>Batch : </p> 
                <select name="batch" id="batch" class="form-control in tpr-in select">
                    <option  >select..</option>
                    <option value="2024"  @if(isset($record['name']) && $record['batch']==2024) selected @endif>2024</option>
                    <option value="2023"  @if(isset($record['name']) && $record['batch']==2023) selected @endif>2023</option>
                    <option value="2022"  @if(isset($record['name']) && $record['batch']==2022) selected @endif>2022</option>
                        <option value="2021"   @if(isset($record['name']) && $record['batch']==2021) selected @endif>2021</option>
                        <option value="2020"  @if(isset($record['name']) && $record['batch']==2020) selected @endif>2020</option>
                        <option value="2019"  @if(isset($record['name']) && $record['batch']==2019) selected @endif>2019</option>
                    </select>
                    <span class="error batch_err text-danger  h6"></span>
                </label>
                @if(!isset($record['name']))
                <button type="submit" class="btn btn-primary btn-lg">Add</button>
                @else
                <button type="submit" class="btn btn-primary btn-lg" onclick="editRecord(event,{{$record['id']}})">Update</button>
                @endif

</form>

<script>
  $("#plc-frm").submit(function(e){
    e.preventDefault();
   // alert("add");
  data=$("#plc-frm").serialize();
  $.ajax({
    url:"/create-record",
    type:"POST",
    data:data,
    success:function(res){
//console.log(res);
$(".error").text("");
if(res.success==true){
  $("#create-placement").text(res.msg).css('color','green').css('font-size','18px');


setTimeout(() => {
  // $("#create-placement").text("");
  // $("#add-record-btn").css('display','block');
  $("#placement_tab").click();
}, 1000);

}else{

  err=res.error;
   $.each(err,function(key,value){ 
    $("."+key+'_err').text(value[0]);
   }) 
}
    }
  })
  })

function editRecord(e,id){
   
    e.preventDefault();
    data=$("#edit-plc-frm").serialize();
 
  $.ajax({
    url:"/update-record/"+id,
    type:"POST",
    data:data,
    success:function(res){
//console.log(res);
$(".error").text("");
if(res.success==true){
  $("#create-placement").text(res.msg).css('color','green').css('font-size','18px');


setTimeout(() => {
  // $("#create-placement").text("");
  // $("#add-record-btn").css('display','block');
  $("#placement_tab").click();
}, 1000);

}else{

  err=res.error;
   $.each(err,function(key,value){ 
    $("."+key+'_err').text(value[0]);
   }) 
}
    }
  })
  }
</script>