
<!DOCTYPE html>
<html lang="en">

    @include('layouts.head')

<body>
   
    @php
        $userid=session()->get('userid');
        $usertype=session()->get('usertype');
      @endphp
        <script>
            var userid=@php echo json_encode($userid); @endphp ;
            var USERTYPE=@php echo json_encode($usertype); @endphp ;
        </script>
  
    @include('layouts.header')
    <div id="preloader"></div>
   
    <div id="main-display">
        @yield('main-section')
    </div>
    

</body>

<script src="{{asset('js/app.js')}}"></script>
<script>

     var noticeCreateRoute = "{{ route('notice.create') }}";
     var noticeListRoute= "{{ route('notice.index') }}";

    function Adminlogin(e){
     
        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function(){
            if(this.readyState==4 &&this.status ==200){
                document.getElementById('login').innerHTML=this.responseText;
            }
        };
        xhttp.open("GET","aloginform",true);
        xhttp.send();
    
    }
    function Studentlogin(){
      
        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById('login').innerHTML=this.responseText;
            }
        };
        xhttp.open("GET","sloginform",true);
        xhttp.send();
    }

   
   
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> --}}

   {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> --}}
<script src="js/script.js" type="text/javascript"></script>
    

</html>
