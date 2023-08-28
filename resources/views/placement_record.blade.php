<section @if(session()->get('usertype')==2 || session()->get('usertype')==3) class=" admin-section" @endif  style="padding-top:6%;">

    @if(session()->get('usertype')==2 || session()->get('usertype')==3)
    <div id="create-placement" >
    </div>
    <button type="submit" class="btn btn-primary btn-lg float-start" id="add-record-btn" >Add New Record</button>
@endif
    <div class="placement-sec "> 
        <h1>Placement Record</h1>
    <br/> <br/>
    <table class="record">
        <tr>
            <th><p> Sr. </p></th>
            <th> <p> Name </p></th> 
            <th><p> Batch </p></th>
             <th><p> Branch </p></th>
            <th><p> Company </p></th>
             <th><p> Position </p></th>  
            <th><p> Package </p></th>

            @if(session()->get('usertype')==2 || session()->get('usertype')==3) 
            <th><p> Edit</p></th> 
            <th><p>Remove</p></th>
             @endif  
           
        </tr>
        @php $count=0; @endphp
@foreach($records as $rcd)

<tr>

    <td><p> {{++$count}}</p></td> 
    <td><p> {{$rcd->name}} </p></td> 
    <td><p> {{$rcd->company}} </p></td>
     <td><p> {{$rcd->batch}}</p></td> 
     <td><p>  {{$rcd->branch}}</p></td> 
     <td><p>  {{$rcd->post}}</p></td> 
     <td><p> {{$rcd->package}} LPA</p></td>

     @if(session()->get('usertype')==2 || session()->get('usertype')==3)
     <td><p><i onclick="editRcd(event, {{$rcd->id}})" id="tpr-edit" class="fa-regular fa-pen-to-square"></i></p></td>
     <td><p>
      {{-- <a href="{{url('/removercd')}}/{{$rcd->id}}" class="del-btn"> --}}
          <a href=""><i onclick="remRecord(event,{{$rcd->id}})"  class="fa-regular fa-trash-can rcd-rem"></i></a>
      {{-- </a> --}}
  </p>
</td>
     @endif
   
    </tr>
@endforeach

       
    </table>
</div>
</section>
<script>

function remRecord(e,id){
        e.preventDefault();
        //alert(id);
        check=confirm("Are you sure?");
        if(check){
        $.ajax({
            url:"/remove-record/"+id,
            type:"GET",
            success:function(res){
                if(res.success==true){
                   // console.log(res);
                    $("#create-placement").text(res.msg);
                    $("#create-placement").css('color','green');
                    setTimeout(() => {
                        $("#placement_tab").click();               

                    }, 1000);                                   

                 
                }
                else{
                    $("#create-placement").text(res.err);
                    $("#create-placement").css('color','red');
                    setTimeout(() => {
                        $("#create-placement").text("");
                    }, 1000);

                }
            }
        });
    }
    }

   
    $("#add-record-btn").on('click',function(){
        $.ajax({
            url:"/add-placement",
            type:"GET",
            success:function(data){
                $("#add-record-btn").css("display","none");
                $("#create-placement").html(data);
            }
        })
    })
function editRcd(e,id){
    e.preventDefault();
    $.ajax({
            url:"/edit-view/"+id,
            type:"GET",
            success:function(data){
                $("#add-record-btn").css("display","none");
                $("#create-placement").html(data);
            }
        })  
}
</script>