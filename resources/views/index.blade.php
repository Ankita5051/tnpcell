
@extends('layouts.app')
@section('main-section')


<!-- start of home page -->
<section class="page" id="home-pg">
   {{-- @include('pages.home')
 --}}

   <div class="banner px-5">
    <input type="hidden" name="usertype" id="usertype">
    <div class="banner-containt" id="login">
     <img class="banner-logo"  src="img/logo.png" alt="">
    <h1 class="common-heading" > Rajkiya engineering college sonbhadra</h2>
    <h2 class="common-heading" style="margin-bottom:3%">Traning & Placement Cell</h2>
    
    <p></p>
    <div class="banner-btn">
        <label for="admin" class="form-group">
            <p>For Admin</p>
    <button class="btn btn-primary common-btn " onclick="Adminlogin()"> Post job </button> </label>
    <label for="student">
        <p>For student</p>
    <button class="btn btn-primary common-btn login-btn" onclick="Studentlogin()"> signin </button> </label>
    </div>
   
    
    </div>
    <div class="banner-img">
        <img src="img/b3.gif" alt="">
    </div>
    
</div>

{{-- <div class="common-wrapper">
<h1 class="common-heading">Browse jobs by category</h1>
<div class="category-wrap">
<a href="" class="category">
<i class="fa-solid fa-user-tie c-icon"></i>
<h2>Human resource</h2>
<h3>12 active</h3>
</a>
<a href="" class="category">
<i class="fa-solid fa-chart-line c-icon"></i>
<h2>Business development</h2>
<h3>12 active</h3>
</a>
<a href="" class="category">
<i class="fa-solid fa-laptop-code c-icon"></i>
<h2>Software development</h2>
<h3>12 active</h3>
</a>
<a href="" class="category">
<i class="fa-solid fa-laptop-code c-icon"></i>
<h2>Full stack developer</h2>
<h3>12 active</h3>
</a>

</div>
</div>
<div class="common-wrapper">
<h1 class="common-heading">Browse Internship by category</h1>
<div class="category-wrap">
<a href="" class="category">
<i class="fa-solid fa-user-tie c-icon"></i>
<h2>Human resource</h2>
<h3>12 active</h3>
</a>
<a href="" class="category">
<i class="fa-solid fa-chart-line c-icon"></i>
<h2>Business development</h2>
<h3>12 active</h3>
</a>
<a href="" class="category">
<i class="fa-solid fa-laptop-code c-icon"></i>
<h2>Software development</h2>
<h3>12 active</h3>
</a>
<a href="" class="category">
<i class="fa-solid fa-user-tie c-icon"></i>
<h2>Campus Ambassador</h2>
<h3>12 active</h3>
</a>

</div>
</div>

<div class="common-wrapper">
<h1 class="common-heading">Job of the day</h1>
<div class="category-wrap">
<div class="job">
    <div class="job-detail">
        <img src="img/company.png" class="company-logo" alt="">
        <div> <h2>Software developer</h2>
    <p><i class="fa-solid fa-location-dot"></i> &nbsp; Lucknow, UP </p>
    <p><i class="fa-solid fa-money-bill-1-wave"></i> 12-13lpa</p>
    </div>
    </div>

<button class="btn btn-primary common-btn">Apply now</button>
<h3><i class="fa-solid fa-calendar-days"></i> Deadline:01/12/2022</h3>
</div>

<div class="job">
    <div class="job-detail">
        <img src="img/company.png" class="company-logo" alt="">
        <div> <h2>BDA</h2>
    <p><i class="fa-solid fa-location-dot"></i> &nbsp; Lucknow, UP </p>
    <p><i class="fa-solid fa-money-bill-1-wave"></i> 12-13lpa</p>
    </div>
    </div>

<button class="btn btn-primary common-btn">Apply now</button>
<h3><i class="fa-solid fa-calendar-days"></i> Deadline:01/12/2022</h3>
</div>
<div class="job">
    <div class="job-detail">
        <img src="img/company.png" class="company-logo" alt="">
        <div > <h2>Full Stack developer</h2>
    <p ><i class="fa-solid fa-location-dot"></i> &nbsp; Lucknow, UP </p>
    <p><i class="fa-solid fa-money-bill-1-wave"></i> 12-13lpa</p>
    </div>
    </div>

<button class="btn btn-primary common-btn">Apply now</button>
<h3><i class="fa-solid fa-calendar-days"></i> Deadline:01/12/2022</h3>
</div>


</div>
</div> --}}

</section>
   <!-- end of home page -->

<!-- start of job page -->
{{-- <section class="page" id="job-pg">
@include('pages.job')
</section> --}}
<!-- end of job page -->

<!-- start of internship page -->
{{-- <section class="page" id="intrn-pg">
    @include('pages.internship')
</section> --}}
<!-- end of internship page -->
<!-- start of query page -->
{{-- <section class="page" id="qry-pg">
    @include('pages.query')
</section> --}}
<!-- end of query page -->

<!-- start of about page -->
{{-- <section class="page" id="abt-pg">
    @include('pages.job')
</section> --}}
<!-- end of about page -->

<!-- start of set notification page -->
{{-- <section class="page" id="ntf-pg">
    @include('pages.setnotification')

</section> --}}
<!-- end of set notification page -->


{{-- </body>
</html> --}}
@endsection