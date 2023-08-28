
<!-- start of tpr section -->
 <section id="tpr-section" class="section-id tpr-section"> 
    <h1 class="comman-heading" style="text-align:center;"> TPR SECTION</h1>
  <div id="err">

  </div>

   <div id="atpr">
    <button class="btn btn-primary common-btn" style="" onclick="addtpr(event)">Add TPR</button>
    </div>
    <div class="tprs">
    
    
    <div class="tpr-wrapper">
    <h2 class="common-heading">TPRs</h2>
      <table class="tpr-detail">
        <tr><th><h3> S no.</h3></th> <th><h3> Branch </h3></th><th><h3> Year</h3></th><th><h3> Name</h3></th> <th><h3>Contact</h3></th> <th><h3> Email</h3></th> <th><h3> Edit</h3></th> <th><h3>Remove</h3></th></tr>

        @php $count=0; @endphp
    @foreach($tprs as $tpr)
  
        <tr><td><p>{{++$count}}</p></td> <td><p> {{$tpr->branch}}</p></td> <td><p> {{$tpr->year}}</p></td> <td><p>{{$tpr->name}}</p></td> <td><p>{{$tpr->contact}}</p></td> <td><p>{{$tpr->email}}</p></td>
           <td><p><i onclick="editTprDtl(event, {{$tpr->id}})" id="tpr-edit" class="fa-regular fa-pen-to-square"></i></p></td>
           <td><p ><a href="{{url('/admin/removetpr')}}/{{$tpr->id}}" class="del-btn"><i id="tpr-rem" class="fa-regular fa-trash-can  "></i></a></p></tr>
   
          @endforeach
         
      </table>
      </div>

    </div>
   
    </section> 
    <!-- end of tpr section -->
    