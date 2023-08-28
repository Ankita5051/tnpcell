var loader =document.getElementById("preloader");

window.addEventListener("load",function(){
    loader.style.display="none";
})

function addtpr(e){
    e.preventDefault();
    $.ajax({
        url:"addtpr",
        type:'get',
        success:function(result){
            $('#atpr').html(result);
        }
    })
}

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

function tprlogin(e){
    
    $.ajax({
        url:"tprlogin",
        type:'get',
        success:function(result){
    
            $('#login').html(result);
        }
    }).fail(function(){
        console.log("error");
    });
    e.preventDefault();
}

function createtpr(e){
    e.preventDefault();
    var formData=$("#frm").serialize();
    console.log(formData);
    $.ajax({
        url:"addtpr",
        type:'post',
        data:formData,
        success:function(result){
           // console.log(result);
          alert(result.msg);
          $("#tpr-tab").click();
        }
    }) 
   
    
}

var  post= document.getElementById('epost');
if(post){post.addEventListener('click', function(){
    document.getElementById('post').disabled = false;
    document.getElementById('post').style.cursor = "text";
    document.getElementById('post').style.color = "#424f4f";


});}
var  email= document.getElementById('eemail');
//console.log("email");
if(email){
email.addEventListener('click', function(){
    document.getElementById('email').disabled = false;
    document.getElementById('email').style.cursor = "text";
    document.getElementById('email').style.color = "#424f4f";

});}
var  upname= document.getElementById('ename');
if(upname){
upname.addEventListener('click', function(){
    document.getElementById('uname').disabled = false;
    document.getElementById('uname').style.cursor = "text";
    document.getElementById('uname').style.color = "#424f4f";

});}





function dis_Section(evt, sec_name) {
    // Declare all variables
  
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("section-id");
    for (i = 0; i < tabcontent.length; i++) {
     tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("sidebar-link");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(sec_name).style.display = "block";
    evt.currentTarget.className += " active";
    evt.preventDefault();
  }
  


function job_pst_tab(e){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("page-body").innerHTML=this.responseText;
            console.log(e.target);
            var links=document.getElementsByClassName('sidebar-link');
            console.log(links.length);
            for(var i=0;i<links.length;i++){
                links[i].removeAttribute('active');
            }
            
        }
    };
    xhttp.open("GET","job_Post_tab",true);
    xhttp.send();
    e.preventDefault();
}

function job_tab(e){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("page-body").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","job_tab",true);
    xhttp.send();
    e.preventDefault();
}
function intrn_tab(e){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("page-body").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","intern_tab",true);
    xhttp.send();
    e.preventDefault();
}
function tpr_tab(e){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
           
            document.getElementById("page-body").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","tpr_tab",true);
    xhttp.send();
    e.preventDefault();
}


function ntf_tab(e){
    e.preventDefault();
    $.ajax({
        //url:"\query",
        url:"query",
        type:"GET",
        success:function(data){
         $("#page-body").html(data);
         
        }
      });

}
function student_tab(e){
    e.preventDefault();
    $.ajax({
        url:'/admin/students',
        type:'GET',
        success:function(res){
            console.log(res);
            $("#page-body").html(res);
        }
    })
}
function prfl_tab(e){
    $.ajax({
        url:'prfl_tab',
        type:'GET',
        success:function(response){
          //  console.log(response);
            $("#page-body").html(response);
        }
    }).fail(function(){
        console.log("error");
    });
    
    e.preventDefault();
}
function pass_chng_tab(e){
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("page-body").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","pass_tab",true);
    xhttp.send();
    e.preventDefault();
}
function placement_tab(e){
    e.preventDefault();
 $.ajax({
    url:'/placement_view',
    type:"GET",
    success:function(data){
        $("#page-body").html(data);
    }
 })
}
function jobview(id){
    $.ajax({
        url:'job/detail/'+id,
        type:'get',
        success:function(response){
           
            if(response){
           
                $("#page-body").html(response);
            }
          
        }
    }).fail(function(){
        console.log("error");
    })
}

function enablefrm(e){
    var editbtn=document.getElementById('editbtn');
    editbtn.style.display="none";
   document.getElementById('infofile').style.display="none";
document.getElementById('file').style.display="block";
    var eles=document.getElementsByClassName('rem-style');
    for(var i=0;i<eles.length;i++){

eles[i].removeAttribute('disabled');

    }

  var  savebtn=document.getElementById('savebtn');
    savebtn.style.display="inline";
    
    e.preventDefault();
}

function adminfrgt(e,i){

    $.ajax({
        url:'admin/forgetpass',
        type:'get',
        success:function(response){
           
            if(response){
           
                $("#login").html(response);
               $("#usertype").val(i);
            }
          
        }
    }).fail(function(){
        console.log("error");
    })
    e.preventDefault();
}    
    
    function studentloginfrm(event){
       // alert("hii");
        event.preventDefault();
        // var formData=$(this).serialize();
        // console.log(formData);
        var formData = {
            email: $("#s-eml").val(),
            password: $("#s-pas").val(),
           
          };
          console.log(formData);
        $.ajax({
              url:'http://localhost:8000/api/student-login',
              type:'POST',
              data:formData,
              success:function(data){
                  console.log(data);
                 
                  if(data.success==true){
                    localStorage.setItem("user_token",data.token_type +" "+ data.access_token);
                    localStorage.setItem("usertype",'1');
                    console.log(data.id);
                    $.ajax({
                        url:'/student/set/'+ data.id,
                        type:'GET',
                        //data:{id:data.id},
                        success:function(res){
                            console.log(res);
                            window.open("/student",'_self');
                        }

                    });

                  }else{
                    if(data.success==false){
                        $("#stdn-login-frm")[0].reset();
                        $(".error").text("");
                        $("#log-msg").text('');
                        $("#log-msg").text(data.msg);
                    }else{
                        $(".error").text("");
                        printErrorMsg(data);
                    }
                 
                  }
             }
            });
    }

    function printErrorMsg(msg){
        $.each(msg,function(key,value){
            
                $("."+key+"_err").text(value);
        

        });
    }
   
function stdnpanel(e){
    e.preventDefault();
       // alert("hii");
        $.ajax({
            url:'/student-home',
            type:'GET',
            success:function(data){
                console.log(data);
                $("#home-pg").html(data);
            }
        }); 
}
    function studentPrfl(e){
        e.preventDefault();
      // alert("hii");
        $.ajax({
            url:'/student/profile',
            type:'GET',
            success:function(data){
               // console.log(data);
                $("#home-pg").html(data);
            }
        });
    }

    // function createjob(e){
    //     e.preventDefault();
    //     //alert("hii");
        
    //     //  var formdata=("#jbpst_frm").serialize();
    //     var wrk_site=document.querySelector('input[name="rate"]:checked').value;
    //      var formdata = {
    //         email: $("#link").val(),
    //         password: $("#type").val(),
    //         work_from:wrk_site,
    //         experience:$("#exprnc"),
    //         batch:$("#batch"),



            
           
    //       };
    //      console.log(formdata);
    //                  $.ajax({
    //                      url:'/create_job',
    //                      type:'POST',
    //                      data:formdata,
    //                      success:function(data){
    //                          console.log(data);
    //                      }
    //                  })
        
    //       }

   //can we write js code inside php script
   //csn we write php code inside js


    function search_job(e){
        e.preventDefault();
        var key=$("#key").val();
        if(key){
        $.ajax({
            url:'/job/search/'+key,
            type:'GET',
            success:function(data){
                $("#page-body").html(data);
                $("#key").val(key);
                console.log(data);
            }
        })}else{
           
            //$("#job_tab").click();
             alert("please enter valid keyword!");
            // setTimeout(function(){
            //     $("#job_tab").click();
            // } ,500);
        }
       
    }
   


function editTprDtl(e,id){
    e.preventDefault();

    $.ajax({
        url:'tpr/detail/'+id,
        type:"GET",
        success:function(data){
           if(data.success==false){
            alert(data.msg);
           }else{
            $("#atpr").html(data);

           }
           
        }

    })
   
}

   function saveTprDtl(e){
    e.preventDefault();
    var formData={
        email: $("#email").val(),
            contact: $("#contact").val(),
            name:$("#tprname").val(),
            branch:$("#branch").val(),
            id:$("#tprid").val(),
            year:$("#year").val()
    }
  
    $.ajax({
        url:'/tpr/edit-detail',
        type:'POST',
     data:formData,
        success:function(data){
          if(data.success=true){
            $("#atpr").text(data.msg);
            $("#atpr").css("color",'green');
            $("#atpr").css("font-size",'24px');
            setTimeout(function(){
                $('#tpr-tab').click();

            },700);
           
          }else{

          }
        }
    })
   }   

   function knowMore(e,id,type){
    e.preventDefault();
    if(type=='job'){
        $.ajax({
            url:"\job",
            type:"GET",
            success:function(data){
            
            $("#home-pg").html(data);
            
            setTimeout(() => {
                $("#"+id).click();
                $("#"+id).css('background','#ddd');
            }, 1000);
            
            }
            });
    }
    else{
        $.ajax({
            url:"\internship",
            type:"GET",
            success:function(data){
            
            $("#home-pg").html(data);
            
            setTimeout(() => {
                $("#"+id).click();
                $("#"+id).css('background','#ddd');
            }, 1000);
            
            }
            });
    }


 
   }

   function viewNotice(e){
    alert(noticeCreateRoute);
    $.ajax({      
        url:noticeListRoute,
        type:'GET',
        success:function(res){
            console.log(res);
          $(".notice-display-sec").html(res); 
        }
      })
  }

  function creteNoticeFrm(e){
    console.log("create notice");
    $.ajax({
        url:noticeCreateRoute,
        type:'GET',
        success:function(res){
          $(".notice-display-sec").html(res);
        }
      })
  }

//    $("#view-notice").on('click',function(){
//     alert("view notice");
   
//     })
    
//     $("#create-notice-frm").on('click',function(e){
//     console.log("create notice");
   
//     })

//    $("#chat-form").submit(function(e){
//     e.preventDefault();
//    var message=$('#message').val();
//    $.ajax({
//     url:'save-chat',
//     type:'POST',
//     data:{sender_id:sender_id,receiver_id:receiver_id,message:message},
//     success:function(data){
//         if(data.success==true){
// $('#message').val('');
// let chat=data.data.message;
// let html=`  <div class="current-user-chat">
// <h1>`+ chat +`</h1>
// </div>`;

// $("#chat-container").append(html);
// scrollChat();
//         }else{
//             alert(data.msg);
//         }
//     }
//    })
// })



var tab=document.getElementById("default_tab");
//console.log(tab);
var job_postbtn=document.getElementById('jb-post');
//console.log(job_postbtn);
if(tab)
tab.click();


