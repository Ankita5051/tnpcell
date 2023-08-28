<!DOCTYPE html>
<html lang="en">
<head>
  
    <title>{{$data['title']}}</title>
</head>
<body>
    <h3>Hey {{$data['name']}}!</h3>
    <p>We just wanted to inform You that, Now you are a TPR.</p> 
    <p>{{$data['body']}}</p>
   <p> <a href="{{$data['url']}}">Click here</a> to reset your password!</p>
    <br>
    <p>Thank you!</p>
</body>
</html>