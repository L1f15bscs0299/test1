<style type="text/css">
  html, body{
    font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif !important; 
    font-size: 16px;
  }
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

  #error_server_name, #valid_ip {
    color: red !important;
  }

  #valid_ip_confirm, #valid_server_name_confirm {
    color: green !important;
  }

  #valid_server_ip_confirm, #valid_server_name_confirm {
    color: green !important;
  }

  #public_key_modal {
    width: 42rem;
  }

  #copy_message {
    padding-left: 42%;
    font-size: x-large;
    color: green;
    font-weight: 400;
  }
  #ip_addr{
    width:39%;
    height: 39px;
  }
  #add_ip{
    width: 18%;
    height: 38px;
  }

</style>

<nav class="navbar navbar-expand-md navbar-dark bg-info">
  <a href="/manageiptables" class="navbar-brand" id="navbar_brand_name">Firewall Management Framework</a>

  <button class="navbar-toggler" data-toggle="collapse" data-target="#collapsible_navbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsible_navbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="/manageiptables" class="nav-link">
          <i class="fas fa-home"></i>
          Home
        </a>
      </li>

      <li class="nav-item">
        <a href="/remote" class="nav-link">
          <i class="fas fa-users"></i>
          Remote Clients
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " data-toggle="modal" data-target="#keyModal" href="#">
          <i class="fas fa-key"></i>
          My Public key
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#myModal" href="#">
          <i class="fas fa-plus"></i>
          Add Server
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#whitelist" href="#">
          <i class="fas fa-plus"></i>
          OTP Whitelist
        </a>
      </li>

      <li class="nav-item">
        <a href="/gitautopull" class="nav-link">
          <i class="fab fa-github"></i>
          Git Auto Pull
        </a>
      </li>

      <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <i class="far fa-address-book"></i>
          Templates
        </a>
        <div class="dropdown-menu">
          <a href="{{ url('add_templates') }}" class="dropdown-item">Show Template</a>
          <a href="#deploy_template_modal" class="dropdown-item" data-toggle="modal" data-backdrop="static">Deploy Template</a>
        </div>
      </li>

      <li class="nav-item">
        <a href="/user_management" class="nav-link">
          <i class="fas fa fa-users"></i>
          Users 
        </a>
      </li>

      <li class="nav-item">
        <a href="/logout" class="nav-link">
          <i class="fas fa-sign-out-alt"></i>
          Logout
        </a>
      </li>
    </ul>
  </div>
</nav>

<div class="modal fade" id="deploy_template_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info font-weight-bold">Deploy Template</h5>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="/deploy-template" method="POST" id="deploy_template_form">
          @csrf

          <select name="select_template" id="select_template" style="width:100%;">
            <option value="">Select Template</option>

            <?php
              $templates = [];
              if ($template_directory = opendir('../templates')){
                while (($read_template_directory = readdir($template_directory)) !== false){
                  if ($read_template_directory != "." && $read_template_directory != "..") {
                    $templates[] = $read_template_directory;
                  }
                }
                closedir($template_directory);
              }
            ?>

            @foreach ($templates as $template)
              <option value="{{ $template }}">{{ pathinfo($template, PATHINFO_FILENAME) }}</option>
            @endforeach
          </select>

          <div class="my-2"></div>
          <select name="select_template_servers[]" id="select_template_servers" multiple="multiple" style="width:100%;">

            <?php
                $server_names = [];
                $extracted_server_names = [];
                $server_names_file = fopen('../iptables/allservers.txt', 'r');

                while (!feof($server_names_file))
                {
                  $server_names[] = fgets($server_names_file);
                }
                fclose($server_names_file);
                
                foreach ($server_names as $server_name)
                {
                  if ($server_name != "" )
                  {
                    $exploded_server_names = explode('|', $server_name);                    
                    if ($exploded_server_names[0] != "\n")
                    {
                      $extracted_server_names[] = $exploded_server_names[0]." ".$exploded_server_names[1];                    
                    }
                  }
                }
            ?>

            @foreach ($extracted_server_names as $extracted_server_name)
              <option value="{{ $extracted_server_name }}">{{ $extracted_server_name }}</option>
            @endforeach
          </select>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary btn-sm" type="submit" form="deploy_template_form">Deploy</button>
      </div>
    </div>
  </div>
</div>

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
            <label style="font-size: 16px">Server Name <span style="color: red;">*</span></label>
            <br>
            <input type="text" name="server_name" class="form-control col-md-7 col-xs-12"  placeholder="Server Name" type="text" id="server_name_add">
           <!--  <input class="form-control" class="form-control col-md-7 col-xs-12" name="server_name" id="server_name" placeholder="Server name" type="text" > -->
            <span id="error_server_name"></span>
            <span id="valid_server_name_confirm"></span>
        </div>
        <br>
        <div class="modal-body">
            <label style="font-size: 16px">IP Address <span style="color: red;">*</span></label>
            <br>
            <input class="form-control col-md-7 col-xs-12" id="server_ip" name="server_ip" type="text" placeholder="0.0.0.0">
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

<!-- Modal for white list -->
<div class="modal fade" id="whitelist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="server_modal_style">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">IP White Listing for OTP</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
      <br>
        <form method="POST" action="/deleteip" class="form-inline d-sm-inline">
              @csrf
              &nbsp;&nbsp;
              <select class="col-sm" id="ip_addr" name="select_ip" id="select_ip">
                <option value="">Select IP</option>

                <?php
                  $ip_data = [];
                  $ip_file = fopen('../common_files/email-ips.txt', 'r');
                  while (!feof($ip_file))
                  {
                    $ip_data[] = fgets($ip_file);
                  }
                  fclose($ip_file);
                ?>

                @foreach ($ip_data as $ip)
                  @if (!empty($ip))
                    <option value="{{ $ip }}">{{ $ip }}</option>
                  @endif
                @endforeach
              </select>

              <span><button class="btn btn-danger" id="delete_ip">Delete IP</button></span>
          </form>
            <br>
            <form method="POST" action="/addip" class="form-inline d-sm-inline">
              @csrf
              &nbsp;&nbsp;
              <input type="text" class="form-control" name="add_white_list_ip" id="ip" placeholder="Add white list IP">
              <button class="btn btn-sm btn-success" id="add_ip">Add IP</button>
              <span id="valid_ip"></span>
              <span id="valid_ip_confirm"></span>
            </form>
        <br>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
            <!-- <button type="button" class="btn btn-primary" onclick="server_validate();" id="submit-button">Add IP</button> -->
        </div>
    </form>
    </div>
  </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="keyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" style="width: 83rem;">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="public_key_modal">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel1">Public Key</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div id="copy_message"></div>
      <div class="modal-body">
              <textarea name="public_key" id='show_public_key' style="width: 40rem; height:15rem;" readonly></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="copyKey();" >Copy</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>

    </div>
  </div>
</div>

<script type="text/javascript">
       $.ajax({
     type:'get',
     url: '/show_key',
     success: function (data) {
         // console.log(data);
         document.getElementById('show_public_key').value = data
     }
   })

  function server_validate(){
    let server_name_add = document.getElementById('server_name_add').value;
    let server_ip = document.getElementById('server_ip').value;
    let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;
    // console.log(server_name_add);
    // console.log(server_ip)
    if(server_name_add == '' || server_name_add == null){
      document.getElementById('error_server_name').innerHTML = "Enter Server Name";
      document.getElementById('valid_server_name_confirm').innerHTML = " ";

        return false;
    }

    if (server_ip == '' || server_ip == null) {
        document.getElementById('valid_server_ip').innerHTML = "Enter Ip Address";
        document.getElementById('valid_server_ip_confirm').innerHTML = " ";

        return false;

    } 


    let check_ip = pattern.test(server_ip);
    console.log(check_ip);
    if(check_ip == true){
        $('#server_form').submit()
        return false;
    }
    document.getElementById('submit-button').disabled = true;
    document.getElementById('valid_server_ip_confirm').innerHTML = " "; 
    document.getElementById('valid_server_ip').innerHTML = "Enter valid Ip Address"; 

  }


// Server Validation


  $(document).ready(function(){
  $("#server_ip").keypress(function(e){

    
    // console.log(ch.length)
    // e.preventDefault();

    var keyCode = e.which;

    /*
    8 - (backspace)
    32 - (space)
    48-57 - (0-9)Numbers
    */
    if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 45 || keyCode > 46) && (keyCode < 48 || keyCode > 57) ) {
      let c = String.fromCharCode(keyCode);
      document.getElementById('valid_server_ip').innerHTML = c + " is not allowed"; 
      document.getElementById('valid_server_ip_confirm').innerHTML = " ";
      document.getElementById('submit-button').disabled = true;

      return false;
    }

    // let ch = document.getElementById('server_ip').value;
    // if(ch.length > 13 ){
    //   return false;
    // }
      

    document.getElementById('valid_server_ip').innerHTML = " ";
    document.getElementById('valid_server_ip_confirm').innerHTML = "Great";
    document.getElementById('submit-button').disabled = false;
  });

// validity ip Address
    $("#ip").keypress(function(e){
      let ip = document.getElementById('ip').value;
      let pattern =  /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
      let check_ip = pattern.test(ip);
      if (check_ip)
      {
        document.getElementById('valid_ip').innerHTML = " ";
        document.getElementById('valid_ip_confirm').innerHTML = "";
        document.getElementById('add_ip').disabled = false;
      }
      else
      {
        document.getElementById('valid_ip').innerHTML = "Invalid IP Address";
        document.getElementById('valid_ip_confirm').innerHTML = "";
        document.getElementById('add_ip').disabled = true;
      }
      var keyCode = e.which;
      if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 45 || keyCode > 46) && (keyCode < 48 || keyCode > 57) ) 
      {
        let c = String.fromCharCode(keyCode);
        document.getElementById('valid_ip').innerHTML = c + " is not allowed"; 
        document.getElementById('valid_ip_confirm').innerHTML = " ";
        document.getElementById('add_ip').disabled = true;
        return false;
      }
  });

});


    $(document).ready(function(){
    $("#server_name_add").keypress(function(e){

      var keyCode = e.which;
      /*
      8 - (backspace)
      32 - (space)
      48-57 - (0-9)Numbers
      */

      // console.log(keyCode)
      if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 45 || keyCode > 46) && (keyCode < 48 || keyCode > 57) && (keyCode < 65 || keyCode > 91) && (keyCode < 95 || keyCode > 95) && (keyCode < 97 || keyCode > 122)) {

        let c = String.fromCharCode(keyCode);
        document.getElementById('error_server_name').innerHTML = c + " is not allowed";
        document.getElementById('valid_server_name_confirm').innerHTML = " ";
        document.getElementById('submit-button').disabled = true;

        // console.log(keyCode)
        return false;
      }

      
        document.getElementById('error_server_name').innerHTML = " ";
        document.getElementById('valid_server_name_confirm').innerHTML = "Great";
        document.getElementById('submit-button').disabled = false;


    });

 });

  function copyKey() {
    let public_key = document.getElementById('show_public_key');

    public_key.select();
    public_key.setSelectionRange(0, 99999)
    document.execCommand("copy");
    document.getElementById('copy_message').innerHTML = "Copied";

    setTimeout( () => {
      document.getElementById('copy_message').innerHTML = "";
    }, 4000);
  
  }

 

</script>
