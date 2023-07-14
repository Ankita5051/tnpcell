<section class=" admin-section"  style="padding-top:6%;">
    <div class="placement-sec "> 
        <h1>Students</h1>
    <br/> <br/>
    <table class="record">
        <tr>
            <th><p> Sr. </p></th>
            <th> <p> Name </p></th> 
            <th><p> rollno </p></th>
            <th><p> Brach </p></th>
            <th><p> Year </p></th>
             <th><p> Contact </p></th>
            <th><p> Email </p></th>
          

            @if(session()->get('usertype')==2 || session()->get('usertype')==3) 
            <th><p> Edit</p></th>
            <th><p> Block</p></th>  
            <th><p>Remove</p></th>
             @endif  
           
        </tr>
        @php $count=0; @endphp
@foreach($students as $stdn)

<tr>

    <td><p> {{++$count}}</p></td> 
    <td><p> {{$stdn->name}} </p></td> 
    <td><p> {{$stdn->rollno}} </p></td>
    <td><p> {{$stdn->branch}}</p></td> 
    <td><p>  {{$stdn->year}}</p></td> 
     <td><p> {{$stdn->contact}}</p></td> 
     <td><p>  {{$stdn->email}}</p></td> 
   

     @if(session()->get('usertype')==2 || session()->get('usertype')==3)
     <td><p><i onclick="editRcd(event, {{$stdn->id}})" id="tpr-edit" class="fa-regular fa-pen-to-square"></i></p></td>

     <td><p><i onclick="editRcd(event, {{$stdn->id}})" id="tpr-edit" class="fa-solid fa-user-slash"></i></p></td>

     <td><p>
      {{-- <a href="{{url('/removercd')}}/{{$rcd->id}}" class="del-btn"> --}}
          <a href=""><i onclick="remstudent(event,{{$stdn->id}})"  class="fa-regular fa-trash-can rcd-rem"></i></a>
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

function remstudent(e,id){
        e.preventDefault();
        //alert(id);
        check=confirm("Are you sure?");
        if(check){
        $.ajax({
            url:"admin/remove-student/"+id,
            type:"GET",
            success:function(res){
                console.log(res);
                if(res.success==true){
                   // console.log(res);
                  alert(res.msg);
                 
                }
                else{
                    alert("Some error occured please try again!");
$("#student_tab").click();
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
</script>