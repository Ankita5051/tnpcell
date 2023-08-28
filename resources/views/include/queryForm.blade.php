@if($id !=0)
<h3>Job Id: <span class="job-id">
   {{$id}} 
   @endif
 {{-- <script>
    let params = new URLSearchParams(location.search);
id=params.get('id')
console.log(id);
    </script>  
    @php
    echo $_Get['id'];
    @endphp --}}
</span></h3>

<form action="" id="queryDetail"style="margin:20px 10px;">
    @csrf
    <input type="hidden" name="jobId" value="{{$id}}">
    <input type="hidden" name="senderId" value="{{$userId}}">
    <label for="subject" class="form-group"><p> Subject:</p> </label>
        <input class="form-control" type="text" placeholder="Not more than 100 words" name="subject" id="subject">
        <br>
        <label for="question" class="form-group"><p> Query: </p></label>
       
        <textarea name="question"  class="form-control"  id="question" cols="30" rows="10"></textarea>
        <br>
        <input type="button" id="sendQuery"class="form-control btn btn-primary btn-lg" value="submit">
   

</form>

<script>
$("#sendQuery").on('click',function(e){
    e.preventDefault();
    var formData=$("#queryDetail").serialize();
   // console.log(formData);
    $.ajax({
         url:"{{ route('query.store') }}",
        //url:'/sendQuery',
        type:'POST',
        data:formData,
        success:function(res){
           // console.log(res);
           if(res.success==true){
            alert(res.msg);
            $("#my-query").click();
            $('.jobs div:first-child').click();
           }
           else{
            if(res.success==false){
                alert("please fill both field");
            }else{
                alert("some error occured");
            }
           }

        }
    })
})
</script>