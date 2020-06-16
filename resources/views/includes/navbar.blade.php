<style type="text/css">
  
  #server_modal_style {
    margin-top: 23%;
  }

  #public_key_modal {
    margin-top: 19%;
  }

  #exampleModalLabel1 {
    padding-top: 2%;
  }

  #error_server_name, #valid_server_ip {
    color: red !important;
  }

  #valid_server_ip_confirm, #valid_server_name_confirm {
    color: green !important;
  }

</style>        
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link fa fa-home" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link fa fa-key" data-toggle="modal" data-target="#keyModal" href="#">My Public key</a>
      </li>
      <li class="nav-item">
        <a class="nav-link fa fa-plus" data-toggle="modal" data-target="#myModal" href="#">Add Server</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/add_rules">Interface</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actions
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>

  </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="server_modal_style">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Add Server Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="/add_server" enctype="multipart/form-data" id="server_form">
        @csrf
        <div class="modal-body">
            <label>Server Name <span class="required">*</span></label>
            <input class="form-control mr-sm-2" class="form-control col-md-7 col-xs-12" name="server_name" id="server_name" placeholder="Server name" type="text" >
            <span id="error_server_name"></span>
            <span id="valid_server_name_confirm"></span>
        </div>
        <div class="modal-body">
            <label>Ip Address<span class="required">*</span></label>
            <input class="form-control mr-sm-2"  class="form-control col-md-7 col-xs-12" id="server_ip" name="server_ip" type="text" placeholder="xxx.xxx.x.xx">
            <span id="valid_server_ip"></span>
            <span id="valid_server_ip_confirm"></span>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
            <button type="button" class="btn btn-primary" onclick="server_validate();" id="submit-button">Add Server</button>
        </div>
    </form>
    </div>
  </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="keyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="public_key_modal">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel1">Public Key</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
              <textarea name="public_key" id='show_public_key' style="width: 100%; height:150px;" readonly></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        </div>

    </div>
  </div>
</div>
<script type="text/javascript">
       $.ajax({
     type:'get',
     url: '/show_key',
     success: function (data) {
         console.log(data);
         document.getElementById('show_public_key').value = data
     }
   })

  function server_validate(e){
    let server_name = document.getElementById('server_name').value;
    let server_ip = document.getElementById('server_ip').value;
    let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;
    console.log(server_name);
    console.log(server_ip)
    if(server_name == '' || server_name == null){
      document.getElementById('error_server_name').innerHTML = "Enter Server Name";
      document.getElementById('valid_server_name_confirm').innerHTML = " ";

      e.preventDefault();

    }

    if (server_ip == '' || server_ip == null) {
        document.getElementById('valid_server_ip').innerHTML = "Enter Ip Address";
        document.getElementById('valid_server_ip_confirm').innerHTML = " ";

        e.preventDefault();

    }      

    let check_ip = pattern.test(server_ip);
    if(check_ip == true){
        $('#server_form').submit()
        e.preventDefault()
    }
    document.getElementById('valid_server_ip_confirm').innerHTML = " "; 
    document.getElementById('valid_server_ip').innerHTML = "Enter valid Ip Address"; 

  }




  // function server_name_validate() {
  //     let name = document.getElementById('server_name').value;

  //     if( /[^a-zA-Z0-9\-\/]/.test( name ) ) {
  //         document.getElementById('error_server_name').innerHTML = name + " are not allowed"

  //         console.log("IN IF")
  //         return false;
  //   }
  //   document.getElementById('error_server_name').innerHTML = " ";
  //   console.log("Out of IF")

  //   }
  


// Server Validation


  $(document).ready(function(){
  $("#server_ip").keypress(function(e){

    var keyCode = e.which;

    /*
    8 - (backspace)
    32 - (space)
    48-57 - (0-9)Numbers
    */
    if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 45 || keyCode > 46) && (keyCode < 48 || keyCode > 57) ) {
      let c = String.fromCharCode(keyCode);
      document.getElementById('valid_server_ip').innerHTML = c + " is not allowed"; 

      // document.getElementById('valid_server_ip').innerHTML = "Only x.x.x.x pattern allowed"; 
      console.log(keyCode)
      return false;
    }
    document.getElementById('valid_server_ip').innerHTML = " ";
    document.getElementById('valid_server_ip_confirm').innerHTML = "Great";
  });

});


    $(document).ready(function(){
    $("#server_name").keypress(function(e){

      var keyCode = e.which;
      /*
      8 - (backspace)
      32 - (space)
      48-57 - (0-9)Numbers
      */

      console.log(keyCode)
      if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 45 || keyCode > 46) && (keyCode < 48 || keyCode > 57) && (keyCode < 65 || keyCode > 91) && (keyCode < 95 || keyCode > 95) && (keyCode < 97 || keyCode > 122)) {

        let c = String.fromCharCode(keyCode);
        document.getElementById('error_server_name').innerHTML = c + " is not allowed";
        document.getElementById('valid_server_name_confirm').innerHTML = " ";

        console.log(keyCode)
        return false;
      }
      document.getElementById('error_server_name').innerHTML = " ";
      document.getElementById('valid_server_name_confirm').innerHTML = "Great";

    });

 });
  
    
  

</script>







