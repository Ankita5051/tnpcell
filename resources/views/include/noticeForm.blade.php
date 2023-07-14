<h1>Fill details of notice</h1>
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
