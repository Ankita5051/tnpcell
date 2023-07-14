@php 
$usertype=session()->get('usertype');
@endphp
<div class="sidebar">
  <h1 class="common-heading">Dashboard</h1>
<ul class="sidebar-option-list">
    <li id="default_tab"
    {{-- onclick="dis_Section(event,'job-post')"  --}}
   onclick="job_pst_tab(event)"
    class="sidebar-link  ">
      <a href=""> Post job</a>
    </li>
    <li 
    {{-- onclick="dis_Section(event,'job-dtl-section')"   --}}
    onclick="job_tab(event)"
    class="sidebar-link">
      <a href="">Vacancies</a>
    </li>

    
      {{--<li 
   onclick="dis_Section(event,'itrn-dtl-section')"
    onclick="intrn_tab(event)"
     class="sidebar-link">
      <a href="">Internship</a>
    </li>  --}}
    @if($usertype !=2)
    <li 
    {{-- onclick="dis_Section(event,'tpr-section')"  --}}
    onclick="tpr_tab(event)" id="tpr-tab"
     class="sidebar-link ">
      <a href="">TPR</a>
    </li>
    @endif
    <li 
     {{-- onclick="dis_Section(event,'ntf-section')"  --}}
     onclick="ntf_tab(event)"
      class="sidebar-link ">
      <a href="">Notification</a>
    </li>
    
   
    {{-- <li
     {{-- onclick="dis_Section(event,'pass-section')" 
     onclick="pass_chng_tab(event)"
     class="sidebar-link ">
      <a href="">Important Notice</a>
    </li> --}}
    <li
     onclick="placement_tab(event)"
     class="sidebar-link" id="placement_tab">
      <a href="" >Placement</a>
    </li>
    @if($usertype!=2)
    <li
    {{-- onclick="dis_Section(event,'prfl-section')" --}}
    onclick="student_tab(event)"
      class="sidebar-link " id="student_tab">
     <a href="">Students</a>
   </li>
   @endif
    <li
    {{-- onclick="dis_Section(event,'prfl-section')" --}}
    onclick="prfl_tab(event)"
      class="sidebar-link">
     <a href="">Your Account</a>
   </li>
</ul>
</div>
