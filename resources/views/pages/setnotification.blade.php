<h1 style="margin-left: 17rem; margin-top:4rem;" class="text-secondary">SET YOUR PREFERENCES</h1>
<form class="set-notification" id="set-preference">
    
    <div class="set-preference">
        
<div style="margin-bottom: 2rem;">
    <label class="form-group"for=""><p style="margin-bottom: -1rem;"> Minimum Package:</p> </label>
    <input class="form-control" type="number" name="package" placeholder="Minimum package you want in lpa.."id="" @if(isset($myPreference[0]->package)) value="{{$myPreference[0]->package}}" @endif>
</div>
<div>
    <label for="" class="form-group"><p> Job Field </p></label>
    <select name="field" class="form-control" id="">
        <option value="0"><p> select.. </p></option>
        <option value="tech" @if(isset($myPreference[0]->package) && $myPreference[0]->field=='tech') selected @endif>Technical</option>
        <option value="nontech" @if(isset($myPreference[0]->package) && $myPreference[0]->field=='nontech') selected @endif >Non Technical</option>
    </select>
</div>
<div>
    <label for="" class="form-group"><p> Job Type </p></label>
    <select name="type" class="form-control" id="">
        <option value="0"><p> select.. </p></option>
        <option value="internship" @if(isset($myPreference[0]->package) && $myPreference[0]->type=='internship') selected @endif>Internship</option>
        <option value="job" @if(isset($myPreference[0]->package) && $myPreference[0]->type=='job') selected @endif>Full Time Job</option>
    </select>
</div>
<div>
    <label for="" class="form-group"><p> Batch</p></label>
    <select name="batch" class="form-control" id="">
        <option value="0"><p> select.. </p></option>
        <option value="2026" @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2026') selected @endif>2026</option>
        <option value="2025"  @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2025') selected @endif>2025</option>
        <option value="2024"  @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2024') selected @endif>2024</option>
        <option value="2024"  @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2023') selected @endif>2023</option>
        <option value="2024"  @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2022') selected @endif>2022</option>
        <option value="2024"  @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2021') selected @endif>2021</option>
        <option value="2024"  @if(isset($myPreference[0]->package) && $myPreference[0]->batch=='2020') selected @endif>2020</option>
        
    </select>
</div>
<div>
    <label for="" class="form-group"><p>Location </p></label>
    <select  name="location" class="form-control"id="location">
        <option value="0">select..</option>
        <option value="home" @if(isset($myPreference[0]->package) && $myPreference[0]->location=='home') selected @endif>Remote</option>
        <option value="onsite"  @if(isset($myPreference[0]->package) && $myPreference[0]->location=='onsite') selected @endif >Onsite</option>
        <option value="other">Other</option>
    </select>
   
</div>
<div  style="display:none;" id="other">
    <input type="text" name="other" id="newloc" class="form-control" placeholder="Enter location" >
</div>

@php 
          if(isset($myPreference[0]->package))
$brnc =explode(',', $myPreference[0]->branch);
else
$brnc =[];
@endphp

<div   style="display:flex; align-items: center;justify-content: space-between;">
    <label for="branch" ><p>Branch </p></label>
  <span>
CSE &nbsp;
<input type="checkbox" name="branch[]" value="CSE" @if(count($brnc)>=1 && $brnc[0]=='CSE' )   checked @endif id=""></span>
<span>
EL &nbsp;
<input type="checkbox" name="branch[]" value="EL" id="" @if(count($brnc)>1 && $brnc[1]=='EL' )   checked @endif></span>
<span>
EE &nbsp;
<input type="checkbox" name="branch[]" value="EE" id=""  @if(count($brnc)>2  && $brnc[2]=='EE' )   checked @endif></span>

</div>


<input type="submit"  value="Set my preferences" class="btn btn-primary btn-lg">
    </div>
    <div class="notification-via">
        
        
@php 
if(isset($myPreference[0]->package))
$brnc =explode(',', $myPreference[0]->ways);
else
$brnc =[];
@endphp

<div>
      <input type="checkbox" value="email" name="ways[]" id="" @if(count($brnc)>=1 && $brnc[0]=='email' )   checked @endif> Notification on email</div>
<div> <input type="checkbox" name="ways[]" value="whatsapp"id="" @if(count($brnc)>=1 && $brnc[0]=='whatsapp' )   checked @endif>  Notification on WhatsApp</div>
<div> <input type="checkbox" name="ways[]" id="" value="sms" @if(count($brnc)>=1 && $brnc[0]=='sms' )   checked @endif> Notification on SMS</div>

    </div>

   
</form>

<script>

$('#newloc').on('input change',function () {
            var value = $(this).val();

   $("#location").val(value);  
        
        });

    $('#location').on('change',function () {
       
            var loc = $(this).val();
            console.log(loc);
            if(loc== 'other'){
   $("#other").css('display','inline'); 
}else {
    $("#other").css('display','none');  
}
        });

$("#set-preference").submit(function(e){
e.preventDefault();

var formData = $("#set-preference :input")
    .filter(function(index, element) {
        return $(element).val() != '';
    }).serialize();


console.log(formData);

$.ajax({
    url:'/set_notification',
    type:'POST',
    data:formData,
    success:function(res){
   alert(res.msg);
    }
})

});
</script>