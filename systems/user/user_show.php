<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();
?>

 <div class="container">
    <div class="card">
      <div class="card-body">


  <div>
    <button type="button" id="add_data" class="btn-warning"><span class="glyphicon glyphicon-pencil"></span> เพิ่มข้อมูล</button>
  </div>
  <hr>

  <div id="show_list"></div>

      </div>
    </div>
</div>

<script type="text/javascript">
  $("#show_list").load("systems/user/user_list.php");

  $("*[id^=page_list]").click(function()
  {
    var page = $(this).attr('name');
    $.post("systems/user/user_list.php",{
      page : page
    },function(data){
                  //alert(msg);

                      //alert("ลบข้อมูลเรียบร้อยแล้ว");
                      $('#show_list').html(data);


                    });
  });

  $("*[id^=add_data]").click(function()
  {
    $("#showmain").load("systems/user/user_insert.php");
  });


  $('#search').keyup(function(){
    searchshow();
          //alert(data);
        });

  searchshow();
  function searchshow(){

    $.post('systems/user/user_list.php',{
      search : $('#search').val()

                  //id : "5555"

                },function(data){
                  //alert(data);
                  $('#show_list').html(data);
                });
  }
</script>
