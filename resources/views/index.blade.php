{{-- @include('includes.nav') --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IP Tables</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">

  body {
    /*color: #404E67;
    background: #F5F7FA;*/
    font-family: 'Open Sans', sans-serif;
  }
  .table-wrapper {
    width: auto;
    margin: 30px auto;
    background: #fff;
    padding: 20px;  
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 5px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .addnew {
        float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    margin-right: 10px;
    line-height: 13px;
    }
  .table-title .addnew i {
    margin-right: 4px;
  }
    .table-responsive {
    margin: 30px auto;
    background: #fff;
    padding: 20px;  
    box-shadow: 0 2px 2px rgba(0,0,0,.05);
}
   /* table.table {
        table-layout: fixed;
    }*/
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
    cursor: pointer;
        display: inline-block;
        margin: 0 5px;
    min-width: 24px;
    }    
  table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
  table.table td a.add i {
        font-size: 24px;
      margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
  table.table .form-control.error {
    border-color: #f50000;
  }
  table.table td .add {
    display: none;
  }
</style>
    <script type="text/javascript">
$(document).ready(function(){
 function source_ip_validate(source_ip) {
            console.log(source_ip);
      let ip = document.getElementById(source_ip);
      let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;

      let check_ip = pattern.test(ip.value);
      console.log(check_ip)
        if(check_ip == false){
           document.getElementById('error_source_ip').innerHTML = "Enter valid Ip"
           e.preventDefault()
        }
           document.getElementById('error_source_ip').innerHTML = " "

     }

     function destination_ip_validate(source_ip) {
            console.log(source_ip);
      let ip = document.getElementById(source_ip);
      let pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g;

      let check_ip = pattern.test(ip.value);
      console.log(check_ip)
        if(check_ip == false){
           document.getElementById('error_destination_ip').innerHTML = "Enter valid Ip"
           e.preventDefault()
        }
           document.getElementById('error_destination_ip').innerHTML = " "

     }


     function source_port_validate(source_port) {
            console.log(source_port);
      let port = document.getElementById(source_port);
      console.log(port.value);
      if(port.value > 0 && port.value < 65536){
        console.log("true");
        document.getElementById('error_source_port').innerHTML = " "
        ev.preventDefault()
      }
        document.getElementById('error_source_port').innerHTML = "Enter valid Port number"
        console.log("In false");
     }
     

     function destination_port_validate(source_port) {
            console.log(source_port);
      let port = document.getElementById(source_port);
      console.log(port.value);
      if(port.value > 0 && port.value < 65536){
        console.log("true");
        document.getElementById('error_destination_port').innerHTML = " "
        ev.preventDefault()
      }
        document.getElementById('error_destination_port').innerHTML = "Enter valid Port number"
        console.log("In false");
     }
});

</script> 
</head>
<body>
@include('layouts.newnavbar')
<div class="main">
  <h2 style="color: #007b5e;">Servers Management</h2>
  
  <div class="panel-group" id="accordion">

    @foreach($files as $file)
    
     @php 
        if($file == '')
        {
          unset($file);
        }else{
        $name= basename($file);
        $filename=explode('|', $name);
         $id=$loop->iteration;     
        @endphp
     <script>
      
      
      {{-- Show Advance Code --}}
      $(document).ready(function(){
      var id=<?php echo $loop->iteration; ?>;
      $("#show"+id).click(function(){
      //alert(id);
      $("#advance"+id).show();
      });
  });
     </script>
      
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" id= "servername" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" style="color: #007b5e;">
           
               <h4><strong> {{ $filename[0] }} - {{ $filename[1] }}</strong></h4>
              @php
              $iteration=$loop->iteration;
              $server= $filename[0];
              @endphp
              
          </a>

        </h4>
      </div>
      <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse">
        <div class="panel-body">

          
        {{-- Script for INPUT CHAIN--}}
<script type="text/javascript">
$(document).ready(function(){
  var iteration= <?php echo $iteration; ?>;
  var servername= "<?php echo $server; ?>";
  

  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("#inputtabl"+iteration+" td:last-child").html();
  // Append table with add row form on add new button click
    $(".inputadd-new"+iteration).click(function(){
    $(this).attr("disabled", "disabled");
    var index = $("#inputtabl"+iteration+" tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" placeholder="Sr.#" name="no" id="no"></td>' +
            '<td><input type="text" class="form-control" placeholder="Comment" name="comment" id="comment"></td>' +
            '<td><input type="text" class="form-control" name="source_ip" placeholder="0.0.0.0/0" id="source_ip"><span id="error_source_ip"></span></td>' +
            '<td><input type="text" class="form-control" name="destination_ip" placeholder="0.0.0.0/0" id="destination_ip"></td>' +
      '<td><input type="text" class="form-control" name="source_port" placeholder="0-65535" id="source_port"></td>' +
            '<td><input type="text" class="form-control" name="destination_port" placeholder="0-65535" id="destination_port"></td>'+
            '<td><select style="width:auto;" name="protocol"  id="protocol" class="form-control" ><option value="tcp">TCP</option><option value="udp">UDP</option><option value="icmp">ICMP</option> <option value="*">*</option></select></td>' +
            '<td><input type="text" class="form-control" name="flags" id="flags" placeholder="SYN, ACK, FIN, URG"></td>' +
            '<td><select style="width:auto;" class="form-control" id="action" name="action"><option value="ACCEPT">ACCEPT</option> <option value="DROP">DROP</option><option value="REJECTED">REJECTED</option></select></td>' +
            '<td>' + actions + '</td>' +
        '</tr>';
        // var i = 2;
      $("#inputtabl"+iteration).prepend(row);  
    $("#inputtabl"+iteration+" tbody tr").eq(0).find("#inputadd"+iteration+", #inputedit"+iteration).toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
  // Add row on add button click
  $(document).on("click", "#inputadd"+iteration, function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
      // if(!$(this).val()){
      //  $(this).addClass("error");
      //  empty = true;
      // } else{
   //              $(this).removeClass("error");
   //          }
    });
    $(this).parents("tr").find(".error").first().focus();
    if(!empty){
      var actions=$(this).attr("data-click");
      //alert(actions);
      // var actions="add";
      var no=document.getElementById("no").value;
      var comment=document.getElementById("comment").value;
      var source_ip=document.getElementById("source_ip").value;
      var destination_ip=document.getElementById("destination_ip").value;
      var source_port=document.getElementById("source_port").value;
      var destination_port=document.getElementById("destination_port").value;
      var protocol=document.getElementById("protocol").value;
      var flags=document.getElementById("flags").value;
      var action=document.getElementById("action").value;
      input.each(function(){
        $(this).parent("td").html($(this).val());
      });     
<<<<<<< HEAD
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new"+id).removeAttr("disabled");
=======
      $(this).parents("tr").find("#inputadd"+iteration+", #inputedit"+iteration).toggle();
      $(".inputadd-new"+iteration).removeAttr("disabled");
>>>>>>> 66e1e98c65399f4e4be1d3d14aa13173370888f8
       // add into text 
            $.ajax({
                url: '/addruleip',
                type: 'POST',
                data: { 
                  "_token": "{{ csrf_token() }}",
                  "server": servername,
                  "chain": "INPUT",
                  "no": no, 
                  "comment": comment,
                  "source_ip": source_ip, 
                  "destination_ip": destination_ip,
                  "source_port": source_port,
                  "destination_port": destination_port,
                  "protocol": protocol, 
                  "flags": flags,
                  "action": action ,
                  "add": actions
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#response').hasClass('alert-danger'))
                        {
                            $('#response').removeClass('alert-danger');
                        }
                        $('#response').removeClass('d-none');
                        $('#response').addClass('alert-success');
                        $('#response').html('Record Are Added');
                       // setTimeout(function(){ location.reload(); }, 300);
                  

                    }   
            });
        }   
    });
  
    // Edit row on edit button click
       $(document).on("click", "#inputedit"+iteration, function(){  
        edit=true;
      var ids = ["no", "comment", "source_ip", "destination_ip","source_port","destination_port","protocol","flags","action"];
      
      $(this).parents("tr").find("td:not(:last-child)").each(function(k,v){
            
            if(ids[k]=='no'){
                 $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" placeholder="Sr.#" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='comment'){
                 $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" placeholder="Comments" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='source_ip'){
                 $(this).html('<input type="text" placeholder="0.0.0.0/0" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='destination_ip'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0.0.0.0/0" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='source_port'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0-65535" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='destination_port'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0-65535"  class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='protocol'){
                 $(this).html('<select style="width:auto;" name="protocol"  id="protocol" class="form-control"><option value="tcp">TCP</option><option value="udp">UDP</option><option value="icmp">ICMP</option> <option value="*">*</option></select>');
            }
            else if(ids[k]=='flags'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="SYN,ACK"  class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='action'){
                 $(this).html('<select style="width:auto;"  class="form-control" id="action" name="action"><option value="ACCEPT">ACCEPT</option> <option value="DROP">DROP</option></select>');
            }
<<<<<<< HEAD
            else{
                $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            }
    });   
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new"+id).attr("disabled", "disabled");
=======
            // else{
            //     $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            // }
    }); 
       $(this).parents("tr").find("#inputadd"+iteration+", #inputedit"+iteration).toggle();
    $(".inputadd-new"+iteration).attr("disabled", "disabled");
>>>>>>> 66e1e98c65399f4e4be1d3d14aa13173370888f8
    });
      




  //Delete row on delete button click
 
  $(document).on("click", "#inputdelete"+iteration, function(){
        var datadelete=$(this).attr("data-click");
        //alert(datadelete);
        
        $.ajax({
                url: '/deleteiprule',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'datadelete': datadelete

               }
            }).done(function(response){
                if (response==='deleted')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Rule are Deleted');
                    // setTimeout(function() {'#response'.close()}, 1000);
                    //setTimeout(function(){ location.reload(); }, 500);
                }
        });
        
        $(this).parents("tr").remove();
<<<<<<< HEAD
      $(".add-new"+id).removeAttr("disabled");
=======
        $(".inputadd-new"+iteration).removeAttr("disabled");
>>>>>>> 66e1e98c65399f4e4be1d3d14aa13173370888f8
      });



   // Default Policy on button click
      $("#defaultpolicy"+iteration).click( function(){
      
        var defaultpolicy=$(this).attr("data-click");
        var action=$("#iaction"+iteration).val()
        //alert(action);
        //alert(defaultpolicy);
        
        $.ajax({
                url: '/defaultpolicy',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'datadelete': defaultpolicy,
                 'action': action
               }
            }).done(function(response){
                if (response==='default')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Default Policy Updated');
                    
                }
        });
        
        
    });


});

</script> 
        {{-- End SCRIPT --}}

          <div class="table-responsive">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2" style="font-size: 22px;"><b>INPUT CHAIN</b></div>
                    <div class="col-sm-5">
                      <div class="col-sm-4">
                        <h6 style="vertical-align: bottom;" >INPUT Default Policy</h6>
                      </div>
                      
                      <select class="col-sm-3" style="width:auto; height:30px;" id="iaction{{ $iteration }}" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      <div class="col-sm-3">
                      <a class="btn btn-info btn-sm addnew" id="defaultpolicy{{ $loop->iteration }}" data-click="{{ $filename[0] }} {{ 'INPUT' }}"  style="color: white;"><i class="fa fa-refresh"></i>Change</a>
                      </div>
                    </div>

                    <div class="col-sm-5">
                       <button type="button" class="btn btn-primary btn-sm addnew" id="show{{ $loop->iteration }}"><i class="fa fa-eye"></i> Show Advance</button> 
                      
<<<<<<< HEAD
                      <button type="button"  class="btn btn-success btn-sm addnew add-new{{ $loop->iteration }} " id="add-new{{ $loop->iteration }}"><i class="fa fa-plus"></i> Add New</button>
=======
                      <button type="button"  class="btn btn-success btn-sm addnew inputadd-new{{ $iteration }}"><i class="fa fa-plus"></i> Add New</button>
>>>>>>> 66e1e98c65399f4e4be1d3d14aa13173370888f8
                       
                    </div>
                </div>
            </div>
            
              <div class="d-none alert col-sm-offset-4 col-sm-4" id="response"></div>
            
              
            <table class="table table-striped table-bordered table-responsive" id="inputtabl{{ $iteration }}">
                <thead style="border-top: solid;border-bottom: solid;">
                    <tr style="font-weight: bold;">
                        <th>Sr.#</th>
                        <th>Comments</th>
                        <th>Source IP</th>
                        <th>Destination IP</th>
                        <th>Source Port</th>
                        <th>Destination Port</th>
                        <th>Protocol</th>
                        <th>Flags</th>
                        <th>Action</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                 <tbody>
                  
                  
                  @php
                  $no = $loop->index;
                  @endphp

                  @for($i= $no; $i<=$no; $i++)
                  @foreach($inputdata[$i] as $row)
                      
                   @php
                    // print_r($row);
                    // echo "<br>";
                   
                    $rows= explode("|", $row);

                   @endphp

                    <tr>
                        <td>{{ $rows[0] }}</td>
                        <td>{{ $rows[1] }}</td>
                        <td>{{ $rows[2] }}</td>
                        <td>{{ $rows[3] }}</td>
                        <td>{{ $rows[4] }}</td>
                        <td>{{ $rows[5] }}</td>
                        <td>{{ $rows[6] }}</td>
                        <td>{{ $rows[7] }}</td>
                        <td>
                          @php
                          if($rows[8] == "DROP")
                          {
                            @endphp
                            <span style="background-color:#ffcc00;">{{ $rows[8] }}</span>
                          @php
                          }else {
                            @endphp
                            {{ $rows[8] }}
                          @php
                          }  
                          @endphp
                        </td>
                        
                        <td style="width: 12%">
                       
                          <a class="add btn btn-success btn-sm" id="inputadd{{ $iteration }}"  title="Add" data-toggle="tooltip" data-click="{{ 'add' }}" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" id="inputedit{{ $iteration }}"  title="Edit" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" id="inputdelete{{ $iteration }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'INPUT' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                            
                        </td>

                    </tr>
                    <tr>
                      
                    </tr>
                 @endforeach
                  @endfor
                </tbody>
                
            </table>
          
          </div>
            




          <div hidden id="advance{{ $loop->iteration }}">

{{-- Script for FORWARD CHAIN--}}
<script type="text/javascript">
$(document).ready(function(){
  var iteration= <?php echo $iteration; ?>;
  var servername= "<?php echo $server; ?>";

  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("#fortabl"+iteration+" td:last-child").html();
  // Append table with add row form on add new button click
    $(".foradd-new"+iteration).click(function(){
    $(this).attr("disabled", "disabled");
    var index = $("#fortabl"+iteration+" tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" placeholder="Sr.#" name="no" id="no"></td>' +
            '<td><input type="text" class="form-control" placeholder="Comment" name="comment" id="comment"></td>' +
            '<td><input type="text" class="form-control" name="source_ip" placeholder="0.0.0.0/0" id="source_ip"></td>' +
            '<td><input type="text" class="form-control" name="destination_ip" placeholder="0.0.0.0/0" id="destination_ip"></td>' +
      '<td><input type="text" class="form-control" name="source_port" placeholder="0-65535" id="source_port"></td>' +
            '<td><input type="text" class="form-control" name="destination_port" placeholder="0-65535" id="destination_port"></td>'+
            '<td><select style="width:auto;" name="protocol"  id="protocol" class="form-control"><option value="tcp">TCP</option><option value="udp">UDP</option><option value="icmp">ICMP</option> <option value="*">*</option></select></td>' +
            '<td><input type="text" class="form-control" name="flags" id="flags" placeholder="SYN, ACK, FIN, URG"></td>' +
            '<td><select style="width:auto;" id="action" name="action"><option value="ACCEPT">ACCEPT</option> <option value="DROP">DROP</option></select></td>' +
            '<td>' + actions + '</td>' +
        '</tr>';
      $("#fortabl"+iteration).prepend(row);   
    $("#fortabl"+iteration+" tbody tr").eq(0).find("#foradd"+iteration+", #foredit"+iteration).toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
  // Add row on add button click
  $(document).on("click", "#foradd"+iteration, function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
      // if(!$(this).val()){
      //  $(this).addClass("error");
      //  empty = true;
      // } else{
   //              $(this).removeClass("error");
   //          }
    });
    $(this).parents("tr").find(".error").first().focus();
    if(!empty){
      var actions="add";
      var no=document.getElementById("no").value;
      var comment=document.getElementById("comment").value;
      var source_ip=document.getElementById("source_ip").value;
      var destination_ip=document.getElementById("destination_ip").value;
      var source_port=document.getElementById("source_port").value;
      var destination_port=document.getElementById("destination_port").value;
      var protocol=document.getElementById("protocol").value;
      var flags=document.getElementById("flags").value;
      var action=document.getElementById("action").value;
      input.each(function(){
        $(this).parent("td").html($(this).val());
      });     
      $(this).parents("tr").find("#foradd"+iteration+", #foredit"+iteration).toggle();
      $(".foradd-new"+iteration).removeAttr("disabled");
       // add into text 
            $.ajax({
                url: '/addruleip',
                type: 'POST',
                data: { 
                  "_token": "{{ csrf_token() }}",
                  "server": servername,
                  "chain": "FORWARD",
                  "no": no, 
                  "comment": comment,
                  "source_ip": source_ip, 
                  "destination_ip": destination_ip,
                  "source_port": source_port,
                  "destination_port": destination_port,
                  "protocol": protocol, 
                  "flags": flags,
                  "action": action ,
                  "add": actions
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#response').hasClass('alert-danger'))
                        {
                            $('#response').removeClass('alert-danger');
                        }
                        $('#response').removeClass('d-none');
                        $('#response').addClass('alert-success');
                        $('#response').html('Record Are Inserted');
                       // setTimeout(function(){ location.reload(); }, 300);
                  

                    }   
            });
        }   
    });
  
    // Edit row on edit button click
       $(document).on("click", "#foredit"+iteration, function(){  
        edit=true;
      var ids = ["no", "comment", "source_ip", "destination_ip","source_port","destination_port","protocol","flags","action"];
      
      $(this).parents("tr").find("td:not(:last-child)").each(function(k,v){
            
            if(ids[k]=='no'){
                 $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" placeholder="Sr.#" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='comment'){
                 $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" placeholder="Comments" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='source_ip'){
                 $(this).html('<input type="text" placeholder="0.0.0.0/0" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='destination_ip'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0.0.0.0/0" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='source_port'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0-65535" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='destination_port'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0-65535"  class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='protocol'){
                 $(this).html('<select style="width:auto;" name="protocol"  id="protocol" class="form-control"><option value="tcp">TCP</option><option value="udp">UDP</option><option value="icmp">ICMP</option> <option value="*">*</option></select>');
            }
            else if(ids[k]=='flags'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="SYN,ACK"  class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='action'){
                 $(this).html('<select style="width:auto;" id="action" name="action"><option value="ACCEPT">ACCEPT</option> <option value="DROP">DROP</option></select>');
            }
            // else{
            //     $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            // }
    }); 
       $(this).parents("tr").find("#foradd"+iteration+", #foredit"+iteration).toggle();
    $(".foradd-new"+iteration).attr("disabled", "disabled");
    });
      




  //Delete row on delete button click
 
  $(document).on("click", "#fordelete"+iteration, function(){
        var fdatadelete=$(this).attr("data-click");
        //alert(fdatadelete);
        
        $.ajax({
                url: '/deleteiprule',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'datadelete': fdatadelete

               }
            }).done(function(response){
                if (response==='deleted')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('User Deleted');
                    //setTimeout(function(){ location.reload(); }, 500);
                }
        });
        
        $(this).parents("tr").remove();
        $(".foradd-new"+iteration).removeAttr("disabled");
      });



   // Default Policy on button click
      $("#fdefaultpolicy"+iteration).click( function(){
      
        var fdefaultpolicy=$(this).attr("data-click");
        var faction=$("#faction"+iteration).val()
        //alert(faction)
        //alert(fdefaultpolicy);
        
        $.ajax({
                url: '/defaultpolicy',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'datadelete': fdefaultpolicy,
                 'action': faction
               }
            }).done(function(response){
                if (response==='default')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Default Policy Updated');
                    
                }
        });
        
        
    });


});

</script> 
        {{-- End SCRIPT --}}            
      <div class="table-responsive" >
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2" style="font-size: 22px;"><b>FORWARD CHAIN</b></div>
                    <div class="col-sm-5">
                      <div class="col-sm-4">
                        <h6>FORWARD Default Policy</h6>
                      </div>
                      
                       <select class="col-sm-3" style="width:auto; height:30px;" id="faction{{ $iteration }}" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      <div class="col-sm-3">
                      <a class="btn btn-info btn-sm addnew" id="fdefaultpolicy{{ $loop->iteration }}" data-click="{{ $filename[0] }} {{ 'FORWARD' }}"  style="color: white;"><i class="fa fa-refresh"></i>Change</a>
                      </div>
                      </div>
                    <div class="col-sm-5">
                      
                     <button type="button"  class="btn btn-success btn-sm addnew foradd-new{{ $iteration }}"><i class="fa fa-plus"></i> Add New</button>
                       
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-responsive" id="fortabl{{ $iteration }}">
                <thead style="border-top: solid;border-bottom: solid;">
                    <tr>
                        <th>Sr.#</th>
                        <th>Comments</th>
                        <th>Source IP</th>
                        <th>Destination IP</th>
                        <th>Source Port</th>
                        <th>Destination Port</th>
                        <th>Protocol</th>
                        <th>Flags</th>
                        <th>Action</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  
                  @php
                  $no = $loop->index;
                  @endphp

                  @for($i= $no; $i<=$no; $i++)
                  @foreach($forwarddata[$i] as $row)
    
                   @php
                    // print_r($row);
                    // echo "<br>";
                   
                    $rows= explode("|", $row);

                   @endphp

                    <tr>
                        <td>{{ $rows[0] }}</td>
                        <td>{{ $rows[1] }}</td>
                        <td>{{ $rows[2] }}</td>
                        <td>{{ $rows[3] }}</td>
                        <td>{{ $rows[4] }}</td>
                        <td>{{ $rows[5] }}</td>
                        <td>{{ $rows[6] }}</td>
                        <td>{{ $rows[7] }}</td>
                        <td>
                          @php
                          if($rows[8] == "DROP")
                          {
                            @endphp
                            <span style="color:#ffcc00;">{{ $rows[8] }}</span>
                          @php
                          }else {
                            @endphp
                            {{ $rows[8] }}
                          @php
                          }  
                          @endphp
                        </td>
                        <td style="width: 12%">
                           <a class="add btn btn-success btn-sm" id="foradd{{ $iteration }}"  title="Add" data-toggle="tooltip" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" id="foredit{{ $iteration }}"  title="Edit" data-toggle="tooltip" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" id="fordelete{{ $iteration }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'FORWARD' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </td>
                    </tr>
                  @endforeach
                  @endfor
                </tbody>
            </table>
        </div>


        <div class="table-responsive show">
{{-- Script for OUTPUT CHAIN--}}
<script type="text/javascript">
$(document).ready(function(){
  var iteration= <?php echo $iteration; ?>;
  var servername= "<?php echo $server; ?>";

  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("#outtabl"+iteration+" td:last-child").html();
  // Append table with add row form on add new button click
    $(".outadd-new"+iteration).click(function(){
    $(this).attr("disabled", "disabled");
    var index = $("#outtabl"+iteration+" tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" placeholder="Sr.#" name="no" id="no"></td>' +
            '<td><input type="text" class="form-control" placeholder="Comment" name="comment" id="comment"></td>' +
            '<td><input type="text" class="form-control" name="source_ip" placeholder="0.0.0.0/0" id="source_ip"></td>' +
            '<td><input type="text" class="form-control" name="destination_ip" placeholder="0.0.0.0/0" id="destination_ip"></td>' +
      '<td><input type="text" class="form-control" name="source_port" placeholder="0-65535" id="source_port"></td>' +
            '<td><input type="text" class="form-control" name="destination_port" placeholder="0-65535" id="destination_port"></td>'+
            '<td><input type="text" class="form-control" name="protocol" id="protocol"></td>' +
            '<td><input type="text" class="form-control" name="flags" id="flags" placeholder="SYN, ACK, FIN, URG"></td>' +
            '<td><input type="text" class="form-control" name="action" id="action"></td>' +
            '<td>' + actions + '</td>' +
        '</tr>';
      $("#outtabl"+iteration).prepend(row);   
    $("#outtabl"+iteration+" tbody tr").eq(0).find("#outadd"+iteration+", #outedit"+iteration).toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
  // Add row on add button click
  $(document).on("click", "#outadd"+iteration, function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
      // if(!$(this).val()){
      //  $(this).addClass("error");
      //  empty = true;
      // } else{
   //              $(this).removeClass("error");
   //          }
    });
    $(this).parents("tr").find(".error").first().focus();
    if(!empty){
      var actions="add";
      var no=document.getElementById("no").value;
      var comment=document.getElementById("comment").value;
      var source_ip=document.getElementById("source_ip").value;
      var destination_ip=document.getElementById("destination_ip").value;
      var source_port=document.getElementById("source_port").value;
      var destination_port=document.getElementById("destination_port").value;
      var protocol=document.getElementById("protocol").value;
      var flags=document.getElementById("flags").value;
      var action=document.getElementById("action").value;
      input.each(function(){
        $(this).parent("td").html($(this).val());
      });     
      $(this).parents("tr").find("#outadd"+iteration+", #outedit"+iteration).toggle();
      $(".outadd-new"+iteration).removeAttr("disabled");
       // add into text 
            $.ajax({
                url: '/addruleip',
                type: 'POST',
                data: { 
                  "_token": "{{ csrf_token() }}",
                  "server": servername,
                  "chain": "OUTPUT",
                  "no": no, 
                  "comment": comment,
                  "source_ip": source_ip, 
                  "destination_ip": destination_ip,
                  "source_port": source_port,
                  "destination_port": destination_port,
                  "protocol": protocol, 
                  "flags": flags,
                  "action": action ,
                  "add": actions
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#response').hasClass('alert-danger'))
                        {
                            $('#response').removeClass('alert-danger');
                        }
                        $('#response').removeClass('d-none');
                        $('#response').addClass('alert-success');
                        $('#response').html('Record Are Inserted');
                       // setTimeout(function(){ location.reload(); }, 300);
                  

                    }   
            });
        }   
    });
  
    // Edit row on edit button click
       $(document).on("click", "#outedit"+iteration, function(){  
        edit=true;
      var ids = ["no", "comment", "source_ip", "destination_ip","source_port","destination_port","protocol","flags","action"];
      
      $(this).parents("tr").find("td:not(:last-child)").each(function(k,v){
            
            if(ids[k]=='no'){
                 $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" placeholder="Sr.#" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='comment'){
                 $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" placeholder="Comments" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='source_ip'){
                 $(this).html('<input type="text" placeholder="0.0.0.0/0" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='destination_ip'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0.0.0.0/0" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='source_port'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0-65535" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='destination_port'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="0-65535"  class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='protocol'){
                 $(this).html('<select style="width:auto;" name="protocol"  id="protocol" class="form-control"><option value="tcp">TCP</option><option value="udp">UDP</option><option value="icmp">ICMP</option> <option value="*">*</option></select>');
            }
            else if(ids[k]=='flags'){
                 $(this).html('<input type="text" id="'+ids[k]+'" placeholder="SYN,ACK"  class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='action'){
                 $(this).html('<select style="width:auto;" id="action" name="action"><option value="ACCEPT">ACCEPT</option> <option value="DROP">DROP</option></select>');
            }
            // else{
            //     $(this).html('<input type="text" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            // }
    }); 
       $(this).parents("tr").find("#outadd"+iteration+", #outedit"+iteration).toggle();
    $(".outadd-new"+iteration).attr("disabled", "disabled");
    });
      




  //Delete row on delete button click
 
  $(document).on("click", "#outdelete"+iteration, function(){
        var odatadelete=$(this).attr("data-click");
        //alert(odatadelete);
        
        $.ajax({
                url: '/deleteiprule',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'datadelete': odatadelete

               }
            }).done(function(response){
                if (response==='deleted')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('User Deleted');
                    //setTimeout(function(){ location.reload(); }, 500);
                }
        });
        
        $(this).parents("tr").remove();
        $(".outadd-new"+iteration).removeAttr("disabled");
      });



   // Default Policy on button click
      $("#odefaultpolicy"+iteration).click( function(){
      
        var odefaultpolicy=$(this).attr("data-click");
        var oaction=$("#oaction"+iteration).val()
        //alert(oaction)
        //alert(odefaultpolicy);
        
        $.ajax({
                url: '/defaultpolicy',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'datadelete': odefaultpolicy,
                 'action': oaction
               }
            }).done(function(response){
                if (response==='default')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Default Policy Updated');
                    
                }
        });
        
        
    });


});

</script> 
        {{-- End SCRIPT --}} 

            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2" style="font-size: 22px;"><b>OUTPUT CHAIN</b></div>
                    <div class="col-sm-5">
                      <div class="col-sm-4">
                        <h6>OUTPUT Default Policy</h6>
                      </div>
                      
                       <select class="col-sm-3" style="width:auto; height:30px;" id="oaction{{ $iteration }}" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      <div class="col-sm-3">
                      <a class="btn btn-info btn-sm addnew" id="odefaultpolicy{{ $loop->iteration }}" data-click="{{ $filename[0] }} {{ 'OUTPUT' }}"  style="color: white;"><i class="fa fa-refresh"></i>Change</a>
                      </div>
                    </div>

                    <div class="col-sm-5">

                      <button type="button"  class="btn btn-success btn-sm addnew outadd-new{{ $iteration }}"><i class="fa fa-plus"></i> Add New</button>
                       
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-responsive" id="outtabl{{ $iteration }}">
                <thead style="border-top: solid;border-bottom: solid;">
                    <tr>
                        <th>Sr.#</th>
                        <th>Comments</th>
                        <th>Source IP</th>
                        <th>Destination IP</th>
                        <th>Source Port</th>
                        <th>Destination Port</th>
                        <th>Protocol</th>
                        <th>Flags</th>
                        <th>Action</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                 @php
                  $no = $loop->index;
                  @endphp

                  @for($i= $no; $i<=$no; $i++)
                  @foreach($outputdata[$i] as $row)
    
                   @php
                    // print_r($row);
                    // echo "<br>";
                   
                    $rows= explode("|", $row);

                   @endphp

                    <tr>
                        <td>{{ $rows[0] }}</td>
                        <td>{{ $rows[1] }}</td>
                        <td>{{ $rows[2] }}</td>
                        <td>{{ $rows[3] }}</td>
                        <td>{{ $rows[4] }}</td>
                        <td>{{ $rows[5] }}</td>
                        <td>{{ $rows[6] }}</td>
                        <td>{{ $rows[7] }}</td>
                        <td>
                          @php
                          if($rows[8] == "DROP")
                          {
                            @endphp
                            <span style="color:#ffcc00;">{{ $rows[8] }}</span>
                          @php
                          }else {
                            @endphp
                            {{ $rows[8] }}
                          @php
                          }  
                          @endphp
                        </td>
                        <td style="width: 12%">
                           <a class="add btn btn-success btn-sm" id="outadd{{ $iteration }}"  title="Add" data-toggle="tooltip" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" id="outedit{{ $iteration }}"  title="Edit" data-toggle="tooltip" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" id="outdelete{{ $iteration }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'OUTPUT' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </td>
                    </tr>
                  @endforeach
                  @endfor
                </tbody>
            </table>
        </div>
  </div>
        </div>
      </div>
    </div>
    @php
    }  
    @endphp
@endforeach

  </div> 
</div>
 

    </div>  

  
</body>
</html>
