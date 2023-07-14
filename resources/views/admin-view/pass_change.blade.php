
<section id="pass-section"  class="section-id admin-section">
  
<div class="subheader">
  <ul class="subheader-tab-list">
    <li class="subheader-tab" onclick="viewNotice(event)"> View Notice</li>
    <li class="subheader-tab" onclick="creteNoticeFrm(event)"> Create Notice</li>
  </ul>
</div>


<br> <br>

 
<br><br><h1>Fill details of notice</h1>
<form id="noticefrm"
{{-- action="{{route('notice.store')}}" --}}
 method="post">
  @csrf


 
    <label for="notice">Notice Headline</label>
    <input type="text" class="notice-dtl" id="notice" name="notice" placeholder="text your notice..">

    <label for="date">Expired On</label>
    <input type="datetime-local" id="date" class="notice-dtl" name="expiry_date" placeholder="Expiry date.." ><br>

    <label for="subject">Description</label>
    <textarea id="services" class="notice-dtl" name="description" placeholder="Write something.." style="height:200px"></textarea>

  

    <label for="">Associated With</label>
    <select name="job_id" id="" class="form-control">
      <option >Select job  id..</option>
      @foreach ($jobId as $id)
      echo $id;
      <option value="{{$id}}">{{$id}}</option> 
      @endforeach
    
    </select>

    <br>
    <br>
    <label for="attachment">Any Attachment</label>
    <input type="file" name="attachment" id="">

    <input type="submit" class="btn btn-primary btn-lg" value="Submit">
</form>

<div class="notice-display-sec">
  <table class="tpr-detail">
    <tr><th><h3> Sr no.</h3></th> <th><h3> Notice </h3></th><th><h3> Expires on </h3></th><th><h3> View</h3></th> <th><h3> Edit</h3></th> <th><h3>Remove</h3></th></tr>

    @foreach($notice as $data)
    <tr> 
      <td><p> {{$loop->iteration}}</p></td>
      <td> <p> {{$data->notice}}</p></td>
      <td><p> {{$data->expire_date}}</p></td>
      <td><p> <a href="#tpr-rem jobview"><button type="button"><i  class="fa fa-eye" ></i></button></p></td>
      <td><p><button type="button" onclick="alert('Edit previous one!')"> <a href="#tpr-edit"></a><i id="tpr-edit" class="fa-regular fa-pen-to-square"></i></button></p></td>
      <td><p><a href=""><button type="button" onclick="alert('Remove notice!')"><i id="tpr-rem" class="fa-regular fa-trash-can  "></i></button></a></p></td>
    </tr>
    @endforeach
  </table>
</div>

</section> 

<script>


</script>

  