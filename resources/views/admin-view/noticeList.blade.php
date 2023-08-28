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