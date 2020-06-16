{{-- navbar  --}}
<nav class="navbar navbar-inverse">
    
        
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            
          </button>
          <a class="navbar-brand" href="/index">Firewall Management Framework</a>
       
         <div id="navbar" class="navbar-collapse collapse">
           
            <ul class="nav navbar-nav navbar-right">
              <li><a class="nav-link" data-toggle="modal" data-target="#keyModal" href="#">My Public key</a></li>
              <li><a class="nav-link" data-toggle="modal" data-target="#myModal" href="#">Add Server</a></li>
              <li><a href="/git-auto-pull" class="nav-link">Git Auto Pull</a></li>
              <li><a href="/remote" class="nav-link">Remote Shell</a></li>
              <li><a href="/user_management" class="nav-link">Users</a></li>
              <li><a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">Templates</a>
               <ul class="dropdown-menu">
                  <li> <a href="{{ url('add_templates') }}" class="dropdown-item">Show Template</a></li>
                  <li><a href="#deploy_template_modal" class="dropdown-item" data-toggle="modal" data-backdrop="static">Deploy Template</a></li>
                  
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
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
                  $exploded_server_names = explode('|', $server_name);
                  $extracted_server_names[] = $exploded_server_names[0] . " " . $exploded_server_names[1];
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
            <label>Server Name <span>*</span></label>
            <input type="text" name="server_name" class="form-control col-md-7 col-xs-12"  placeholder="Server Name" type="text" id="server_name_add">
            <span id="error_server_name"></span>
            <span id="valid_server_name_confirm"></span>
        </div>
        <div class="modal-body">
            <label>Ip Address<span class="required">*</span></label>
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
         document.getElementById('show_public_key').value = data
     }
   })

  function server_validate(e){
    let server_name_add = document.getElementById('server_name_add').value;
    let server_ip = document.getElementById('server_ip').value;
    let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;

    if(server_name_add == '' || server_name_add == null){
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

      return false;
    }
    document.getElementById('valid_server_ip').innerHTML = " ";
    document.getElementById('valid_server_ip_confirm').innerHTML = "Great";
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
{{-- end --}}