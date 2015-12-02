
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

      window.alert = function(message){
    $(document.createElement('div'))
        .attr({title: 'Alert', 'class': 'alert'})
        .html(message)
        .dialog({
            buttons: {OK: function(){$(this).dialog('close');}},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
};

      function loadHardwareStatus(){

          r=syncAjax("machine_action.php?cmd=2");
          var part
         for (var i = 0; i < r.gnpc_ghi.length; i++)
         {
           part += "<option value="+r.gnpc_ghi[i].s_id+">" + r.gnpc_ghi[i].status + "</option>";
         }
         $('#he_status').html(part);
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
      $("#login_user").click(function(){
        var username=$('#username').val();
        var password=$('#password').val();
        var u ="index_json_response.php?cmd=1&username="+username+"&password="+password;
        r=syncAjax(u);

        if(r == 0){
          $("#status").fadeTo(500,1, function() { $(this).html("<font color='red'>Invalid username or password</font>"); })
        }

        if(r == 1) {

          if (username == r.ge_users.username && password == r.ge_users.password && r.ge_users.u_group == 1) {
            $("#status").fadeTo(500,1, function() { $(this).html("<font color='green'>Success! Loading Passenger's Page...</font>").fadeTo(5000,0,function() {location.href="#passpage"}); })
          }

          else if (username == r.ge_users.username && password == r.ge_users.password && r.ge_users.u_group == 2) {
            $("#status").fadeTo(500,1, function() { $(this).html("<font color='green'>Success! Loading Conductor's Page...</font>").fadeTo(5000,0,function() {location.href="#conpage"}); })
          }

          else if (username == r.ge_users.username && password == r.ge_users.password && r.ge_users.u_group == 3) {
            $("#status").fadeTo(500,1, function() { $(this).html("<font color='green'>Success! Loading Manager's Page...</font>").fadeTo(5000,0,function() 
              {location.href="manager.html"}); })
          }

          else if (username == r.ge_users.username && password == r.ge_users.password && r.ge_users.u_group == 4) {
            location.href="4_regular/";
          }
        }

      });

    });

