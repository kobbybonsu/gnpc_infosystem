
// @author: Kwabena Gyekye Ohene-Bonsu

  function syncAjax(u){
        console.log(u);
        var obj=$.ajax(
          {url:u,
           async:false
           }
        );
        console.log(obj.responseText);
        return $.parseJSON(obj.responseText);
        
      }

      function loadLeaveType(){

          r=syncAjax("leave_action.php?cmd=2");
          var part
         for (var i = 0; i < r.gnpc_dms.length; i++)
         {
           part += "<option value="+r.gnpc_dms[i].t_id+">" + r.gnpc_dms[i].t_name + "</option>";
         }
         $('#leave_type').html(part);
      }

      function loadHardwareStatus(){

          r=syncAjax("machine_action.php?cmd=2");
          var part
         for (var i = 0; i < r.gnpc_ghi.length; i++)
         {
           part += "<option value="+r.gnpc_ghi[i].s_id+">" + r.gnpc_ghi[i].status + "</option>";
         }
         $('#he_status').html(part);
      }

      function loadDepartment(){

          r=syncAjax("machine_action.php?cmd=5");
          var part
         for (var i = 0; i < r.gnpc_ghi.length; i++)
         {
           part += "<option value="+r.gnpc_ghi[i].d_id+">" + r.gnpc_ghi[i].dep_name + "</option>";
         }
         $('#he_dep_ref').html(part);
      }

  function refresh(){
    document.location.reload(true);
  }

  $(document).ready(function() {


    // Reset Type Function
      $("#reset_drop").click(function(){
        r=syncAjax("machine_action.php?cmd=1");
          var part
         for (var i = 0; i < r.gnpc_ghi.length; i++)
         {
           part += "<option value="+r.gnpc_ghi[i].ht_id+">" + r.gnpc_ghi[i].hardware_name + "</option>";
         }
         $('#he_type').html(part);

      });

      // Reset Department Function
      $("#reset_dep").click(function(){
        r=syncAjax("machine_action.php?cmd=5");
          var part
         for (var i = 0; i < r.gnpc_ghi.length; i++)
         {
           part += "<option value="+r.gnpc_ghi[i].d_id+">" + r.gnpc_ghi[i].dep_name + "</option>";
         }
         $('#he_dep_ref').html(part);

      });

      // Login Function
      $("#login").click(function(){
        var name1=$('#username').val();
        var password1=$('#password').val();
        var u ="machine_action.php?cmd=7&username="+name1+"&password="+password1;
        r=syncAjax(u);

        if (r == 1) {
          // location.href="adminindex.html";
          $("#status").fadeTo(500,1, function() { $(this).html("<div align='center' class='alert alert-success' role='alert'>Success! Loading Home Page.</div>").
            fadeTo(5000,0,function() {location.href="dashboard.html"}); })
        }

        //Message displayed if username or password is not correct
        else {
          $("#status").fadeTo(500,1, function() { $(this).html("<div align='center' class='alert alert-danger' role='alert'>ERROR: Invalid username or password</div>"); })
        }

      });

    });

