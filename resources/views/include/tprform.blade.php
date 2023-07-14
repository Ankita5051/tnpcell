@if(isset($tpr))
<h1 class="common-heading">Edit TPR detail</h1>
@else
<h1 class="common-heading">Add TPR</h1>
@endif
<input type="hidden" name="id" id="tprid" @if(isset($tpr)) value="{{$tpr->id}}"@endif>

<form 
{{-- action="/addtpr" method="post"  --}}
class="add-tpr" id="frm">
 @csrf


  <label for="year" class="form-group"><p> Year :</p> 
    {{-- <input type="number" name="year" id="" class="form-control in tpr-in"> --}}
    <select name="year" id="year" class="form-control in tpr-in select">
      <option value="0">select..</option>
      <option value="1" @if(isset($tpr) && $tpr->year==1)selected @endif>1st</option>
      <option value="2" @if(isset($tpr)&& $tpr->year==2)selected @endif>2nd</option>
      <option value="3" @if(isset($tpr) && $tpr->year==3)selected @endif>3rd</option>
      <option value="4" @if(isset($tpr) && $tpr->year==4)selected @endif>4th</option>
    </select>
  </label>
  
  <label for="branch" class="form-group"><p>
Branch : </p> <select name="branch" id="branch" class="form-control in tpr-in select">
<option value="0" >select..</option>
    <option value="CSE"  @if(isset($tpr) && $tpr->branch=='CSE')selected @endif >CSE</option>
    <option value="EL"  @if(isset($tpr) && $tpr->branch=='EL')selected @endif>EL</option>
    <option value="EE"  @if(isset($tpr) && $tpr->branch=='EE')selected @endif>EE</option>
</select></label>
<label for="name" class="form-group">
<p>  Name: </p>
  <input type="text"  @if(isset($tpr)) value="{{$tpr->name}}"@endif name="name" id="tprname" class="form-control in tpr-in">
  </label>
  <label for="contact" class="form-group">
  <p> Contact : </p>
  <input type="number" name="contact" id="contact" @if(isset($tpr)) value="{{$tpr->contact}}"@endif class="form-control in tpr-in " require="true"></label>

  <label for="email" class="form-group">
  <p>Email : </p> 
  <input type="email" name="email" id="email" @if(isset($tpr)) value="{{$tpr->email}}"@endif class="form-control in tpr-in " require="true">
  </label>
  @if(isset($tpr))
  <button type="submit"class="btn btn-primary common-btn" onclick="saveTprDtl(event)" style="margin:0;" name="submit" id="sbtn"

  > Save</button>
 @else
  <button type="submit"class="btn btn-primary common-btn" style="margin:0;" name="submit" id="tprAddBtn"
   onclick="createtpr(event)" 
  > Add </button>
  @endif
</form>
<div id="message">

</div>

