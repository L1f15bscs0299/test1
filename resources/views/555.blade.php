<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <title>IP Table Manger</title>
    <style type="text/css" media="screen">

  /***********************************************/
/***************** Accordion ********************/
/***********************************************/
@import url('https://fonts.googleapis.com/css?family=Tajawal');
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

section{
  padding: 60px 0;
}

#accordion-style-1 h1,
#accordion-style-1 a{
    color:#4169E1;
}
#accordion-style-1 .btn-link {
    font-weight: 400;
    color: #6A5ACD;
    background-color: transparent;
    text-decoration: none !important;
    font-size: 16px;
    font-weight: bold;
  padding-left: 25px;
}

#accordion-style-1 .card-body {
    border-top: 2px solid #007b5e;
}

#accordion-style-1 .card-header .btn.collapsed .fa.main{
  display:none;
}

#accordion-style-1 .card-header .btn .fa.main{
  background: #6A5ACD;
    padding: 13px 11px;
    color: #ffffff;
    width: 35px;
    height: 41px;
    position: absolute;
    left: -1px;
    top: 10px;
    border-top-right-radius: 7px;
    border-bottom-right-radius: 7px;
  display:block;
}
.rowdesign{
  border: 1px solid #E6E6FA;
  border-collapse: separate;
  /*margin: 1px;*/
  /*background-color: #F5F5F5;*/
}
.green option{
        background-color:#0F0;
    }

.blue option{
    background-color:#00F;
}

    </style>

<script>

</script>

  </head>
  <body>
     {{-- @include('includes.nav')     --}}
<!--  Include the above in your HEAD tag -->

<!-- Accordion -->
<div  id="accordion-style-1">

    <section>
      <div class="row">
        <div class="col-12">
          <h1 class="text-green mb-4 text-center">Servers Management</h1>
        </div>

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
     
    
        <div class="col-12 mx-auto">
          <div class="accordion" id="accordionExample">
            
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
              <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $id }}" aria-expanded="false" aria-controls="collapse{{ $id }}">
               <i class="fa fa-plus main"></i><i class="fa fa-angle-double-right mr-8"></i>
                 {{ $filename[0] }} - {{ $filename[1] }}
              @php
              $iteration=$loop->iteration;
              $server= $filename[0];
              $index=$loop->index; 
              @endphp
              </button>
              </h5>
              </div>

<script type="text/javascript">
$(document).ready(function(){

    var iteration= <?php echo $iteration; ?>;
    var servername= "<?php echo $server; ?>";
    // Set add new form display to none
    $("#inputform"+iteration).hide();
    $("#advance"+iteration).hide();
    // Set div display to block
    $(".inputadd-new"+iteration).click(function(){
      //alert("Add new");
        $("#inputform"+iteration).show();
    });
    //Enable and Disable Flags Field
    $("#protocol"+iteration).change(function() {
      var proto=$("#protocol"+iteration).val()
      //alert(proto);
      if(proto == "tcp"){
          $("#flags"+iteration).removeAttr('disabled');
      }else{
        //alert("Welcome");
        $("#flags"+iteration).attr("disabled", "disabled");
      }
    });

   $("#source_ip"+iteration).change(function() {
    var ip=$("#source_ip"+iteration).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#source_msg'+iteration).html('Valid IP ').css('color', 'green');
                }else{
                  $('#source_msg'+iteration).html('Not Valid IP ').css('color', 'red');
                  $("#source_ip"+iteration).focus();
                }
                console.log(response);
        });
    });
   
   $("#destination_ip"+iteration).change(function() {
    var ip=$("#destination_ip"+iteration).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#destination_msg'+iteration).html('Valid IP ').css('color', 'green');
                }else{
                  $('#destination_msg'+iteration).html('Not Valid IP ').css('color', 'red');
                  $("#destination_ip"+iteration).focus();
                }
                console.log(response);
        });
    });

  //check source port validations
   function source_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#source_port'+iteration).oninput = source_checkKey;
//check source port validations
 function destination_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#destination_port'+iteration).oninput = destination_checkKey;
// Add row on add button click
  $(document).on("click", "#inputadd"+iteration, function(){
      
      var no=document.getElementById("no"+iteration).value;
      var comment=document.getElementById("comment"+iteration).value;
      var source_ip=document.getElementById("source_ip"+iteration).value;
      var destination_ip=document.getElementById("destination_ip"+iteration).value;
      var source_port=document.getElementById("source_port"+iteration).value;
      var destination_port=document.getElementById("destination_port"+iteration).value;
      var protocol=document.getElementById("protocol"+iteration).value;
      var flags=document.getElementById("flags"+iteration).value;
      var action=document.getElementById("action"+iteration).value;
      
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
                  "add": "add"
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
                        $('#response').html('Rule Are Added');
                       setTimeout(function() {$("#response").hide();}, 5000);
                       $("#formidinput"+iteration).trigger("reset");
                      $("#inputform"+iteration).hide();


                    }   
            });
          
    });

  $(document).on("click", "#inputdelete"+iteration, function(){
                    $("#inputform"+iteration).hide();
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Rule are Deleted');
                     setTimeout(function() {$("#response").hide();}, 5000);
                    //setTimeout(function(){ location.reload(); }, 500);
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
                
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Default Policy Updated');
                    //setTimeout(function() {$("#response").hide();}, 3000);
        });
        
        
    });

});


</script> 
        {{-- End SCRIPT --}}
              <div id="collapse{{ $id }}" class="collapse fade" aria-labelledby="heading{{ $id }}" data-parent="#accordionExample">
                <div class="card-body">
        {{-- START INPUT  --}}
                  <div class="row">
                    <div class="col-lg-2" style="font-size: 22px;"><b>INPUT CHAIN</b></div>
                    
                      <div class="col-lg-4">
                       INPUT Default Policy
                      
                      
                      <select  style="width:auto; height:30px;" id="iaction{{ $iteration }}" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      
                      <a class="btn btn-info btn-sm addnew" id="defaultpolicy{{ $loop->iteration }}" data-click="{{ $filename[0] }} {{ 'INPUT' }}"  style="color: white;"><i class="fa fa-refresh"></i>Change</a>
                      </div>
                   <div class="col-lg-3 ">
                    <span class="d-none alert col-lg-12" id="response"></span>
                  </div>
                    <div class="col-lg-3 ">
                      <button type="button" class="btn btn-primary btn-sm float-right" id="show{{ $loop->iteration }}" style="margin-left: 5px;"><i class="fa fa-eye"></i> Show Advance</button>
                      <button type="button"  class="btn btn-success btn-sm float-right inputadd-new{{ $iteration }}" ><i class="fa fa-plus"></i> Add New</button>
                      
                       
                    </div>
                  </div>
                  
                   
                  
                <br>
                    
                       
                    
                    <div class="row" style="border-top: solid;border-bottom: solid;">
                        <div class="col text-center col-form-label-sm">
                         <b>Sr.#</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b> Comment</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Source IP</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Destination IP</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Soucre Port</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Destination Port</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b>Protocols</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Flags</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Action</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b> Update/Delete</b>
                        </div>
                      </div>
                      <form style="margin-top: 5px;" id="formidinput{{ $id }}">
                      <div class="form-row" id="inputform{{ $id }}">
                        <div class="col">
                          <input type="number" id="no{{ $id }}" class="form-control form-control-sm" placeholder="Sr.#">
                        </div>
                        <div class="col">
                          <input type="text" id="comment{{ $id }}" class="form-control form-control-sm" placeholder="Enter Comment">
                        </div>
                        <div class="col">
                          <input type="text" id="source_ip{{ $id }}" class="form-control form-control-sm" placeholder="0.0.0.0/0">
                          <span id="source_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="destination_ip{{ $id }}" class="form-control form-control-sm" placeholder="0.0.0.0/0">
                          <span id="destination_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="source_port{{ $id }}" class="form-control form-control-sm" placeholder="0-65535">
                          <span id="sport_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="destination_port{{ $id }}" class="form-control form-control-sm" placeholder="0-65535">
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="protocol{{ $id }}" class="form-control form-control-sm">
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                          </select>
                        </div>
                            <div class="col">
                          <input type="text" id="flags{{ $id }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG">
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="action{{ $id }}" name="action">
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                          </select>
                        </div>
                            <div class="col">
                          <a class="edit btn btn-success btn-sm" id="inputadd{{ $iteration }}"  title="Add" style="color: white;">&nbsp;  Add  &nbsp; &nbsp; </a>
                            <a class="delete btn btn-danger btn-sm" id="inputdelete{{ $iteration }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'INPUT' }} "  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>
                              @php
                            $no = $loop->index;
                          
                             //($inputdata);
                            @endphp
  
                            @for($i= $no; $i<=$no; $i++)

                            @foreach($inputdata[$i] as $row)
                                
                             @php
                              // print_r($row);
                              // echo "<br>";
                             $no1 = $loop->index;
                              $rows= explode("|", $row);
                              //print_r($rows);
                             @endphp
    {{-- Script for INPUT CHAIN--}}

 <script type="text/javascript">
$(document).ready(function(){

    var iteration= <?php echo $iteration; ?>;
    var index= <?php echo $no1; ?>;
    var servername= "<?php echo $server; ?>";
   
    //Enable and Disable Flags Field
    $("#protocol"+iteration+index).change(function() {
      var proto=$("#protocol"+iteration+index).val()
     // alert(proto);
      if(proto == "tcp"){
          $("#flags"+iteration+index).removeAttr('disabled');
      }else{
        //alert("Welcome");
        $("#flags"+iteration+index).attr("disabled", "disabled");
      }
    });

   $("#source_ip"+iteration+index).change(function() {
    var ip=$("#source_ip"+iteration+index).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#source_msg'+iteration+index).html('Valid IP ').css('color', 'green');
                }else{
                  $('#source_msg'+iteration+index).html('Not Valid IP ').css('color', 'red');
                  $("#source_ip"+iteration+index).focus();
                }
                console.log(response);
        });
    });
   
   $("#destination_ip"+iteration+index).change(function() {
    var ip=$("#destination_ip"+iteration+index).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#destination_msg'+iteration+index).html('Valid IP ').css('color', 'green');
                }else{
                  $('#destination_msg'+iteration+index).html('Not Valid IP ').css('color', 'red');
                  $("#destination_ip"+iteration+index).focus();
                }
                console.log(response);
        });
    });

  //check source port validations
   function source_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#source_port'+iteration+index).oninput = source_checkKey;
//check source port validations
 function destination_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#destination_port'+iteration+index).oninput = destination_checkKey;


// Update row on add button click
  $(document).on("click", "#inputedit"+iteration+index, function(){
     
      var no=document.getElementById("no"+iteration+index).value;
      var comment=document.getElementById("comment"+iteration+index).value;
      var source_ip=document.getElementById("source_ip"+iteration+index).value;
      var destination_ip=document.getElementById("destination_ip"+iteration+index).value;
      var source_port=document.getElementById("source_port"+iteration+index).value;
      var destination_port=document.getElementById("destination_port"+iteration+index).value;
      var protocol=document.getElementById("protocol"+iteration+index).value;
      var flags=document.getElementById("flags"+iteration+index).value;
      var action=document.getElementById("action"+iteration+index).value;
      //alert(comment);
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
                  "add": "update"
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
                        $('#response').html('Rule Are Added');
                       setTimeout(function() {$("#response").hide();}, 5000);
                       $("#formidinput"+iteration).trigger("reset");
                      $("#inputform"+iteration).hide();


                    }   
            });
          
    });
  $(document).on("click", "#inputdelete"+iteration+index, function(){
        var datadelete=$(this).attr("data-click");
       // alert(datadelete);
        
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
                    $('#inputform'+iteration+index).hide();
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('Rule are Deleted');
                     setTimeout(function() {$("#response").hide();}, 5000);
                    //setTimeout(function(){ location.reload(); }, 500);
                }
        });
       
      });

});
</script>       
                    <?php if($no1 == 0){ ?>
                    <form style="margin-top: 5px;">
                      <div class="form-row" id="inputform{{ $id }}{{ $no1 }}">
                        <div class="col">
                          <input type="text" id="no{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="Sr.#" value="{{ $rows[0] }}" readonly style="text-align:center;">
                        </div>
                        <div class="col">
                          <input type="text" id="comment{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="Enter Comment" value="{{ $rows[1] }}" readonly>
                        </div>
                        <div class="col">
                          <input type="text" id="source_ip{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[2] }}" readonly>
                          <span id="source_msg{{ $id }}{{ $no1 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="destination_ip{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[3] }}" readonly>
                          <span id="destination_msg{{ $id }}{{ $no1 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="source_port{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[4] }}" readonly>
                          <span id="sport_msg{{ $id }}{{ $no1 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="destination_port{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[5] }}" readonly>
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="protocol{{ $id }}{{ $no1 }}" class="form-control form-control-sm" readonly>
                            <?php if($rows[6] == "tcp"){ ?>
                            <option value="tcp" selected>TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } elseif($rows[6] == "udp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp" selected>UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } else if($rows[6] == "icmp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp" selected>ICMP</option> 
                            <option value="*">*</option>
                            <?php }else{ ?> 
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp">ICMP</option> 
                            <option value="*" selected>*</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">

                          <input type="text" id="flags{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG" value="{{ $rows[7] }}" readonly>
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="action{{ $id }}{{ $no1 }}" name="action" readonly>
                            <?php if($rows[8] == "ACCEPT"){ ?>
                            <option value="ACCEPT" selected>ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php } else if($rows[8] == "DROP") { ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option style="background-color:#ffcc00;" value="DROP" selected>DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php }else if($rows[8] == "REJECTED"){ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option style="color:#ffcc00;" value="REJECTED" selected>REJECTED</option>
                            <?php }else{ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <option style="color:#ffcc00;" value="{{ $rows[8] }}" selected>{{ $rows[8] }}</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">
                         <a class="edit btn btn-success btn-sm btn disabled" id="inputedit{{ $iteration }}{{ $no1 }}"  title="update" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;" disabled>Update</a>
                            <a class="delete btn btn-danger btn-sm btn disabled" id="inputdelete{{ $iteration }}{{ $no1 }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'INPUT' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>         
                   <?php }else{ ?>
                      <form style="margin-top: 5px;">
                      <div class="form-row" id="inputform{{ $id }}{{ $no1 }}">
                        <div class="col">
                          <input type="text" id="no{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="Sr.#" value="{{ $rows[0] }}" readonly style="text-align:center;">
                        </div>
                        <div class="col">
                          <input type="text" id="comment{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="Enter Comment" value="{{ $rows[1] }}">
                        </div>
                        <div class="col">
                          <input type="text" id="source_ip{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[2] }}">
                          <span id="source_msg{{ $id }}{{ $no1 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="destination_ip{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[3] }}">
                          <span id="destination_msg{{ $id }}{{ $no1 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="source_port{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[4] }}">
                          <span id="sport_msg{{ $id }}{{ $no1 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="destination_port{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[5] }}">
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="protocol{{ $id }}{{ $no1 }}" class="form-control form-control-sm">
                            <?php if($rows[6] == "tcp"){ ?>
                            <option value="tcp" selected>TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } elseif($rows[6] == "udp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp" selected>UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } else if($rows[6] == "icmp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp" selected>ICMP</option> 
                            <option value="*">*</option>
                            <?php }else{ ?> 
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp">ICMP</option> 
                            <option value="*" selected>*</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">

                          <input type="text" id="flags{{ $id }}{{ $no1 }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG" value="{{ $rows[7] }}">
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="action{{ $id }}{{ $no1 }}" name="action">
                            <?php if($rows[8] == "ACCEPT"){ ?>
                            <option value="ACCEPT" selected>ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php } else if($rows[8] == "DROP") { ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option style="background-color:#ffcc00;" value="DROP" selected>DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php }else if($rows[8] == "REJECTED"){ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option style="color:#ffcc00;" value="REJECTED" selected>REJECTED</option>
                            <?php }else{ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <option style="color:#ffcc00;" value="{{ $rows[8] }}" selected>{{ $rows[8] }}</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">
                         <a class="edit btn btn-success btn-sm" id="inputedit{{ $iteration }}{{ $no1 }}"  title="update" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;">Update</a>
                            <a class="delete btn btn-danger btn-sm" id="inputdelete{{ $iteration }}{{ $no1 }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'INPUT' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form> 



                   <?php } ?>


                    
                     @endforeach
                  @endfor
        {{-- End INPUT CHAIN --}}
        <script>
      
      
      {{-- Show Advance Code --}}
      $(document).ready(function(){
      var id=<?php echo $id; ?>;
      $("#show"+id).click(function(){
      alert(id);
      $("#advance"+id).show();
      });
  });
</script>
      {{-- FORWARD CHAIN --}}
                        <hr>
      <div id="advance{{ $id }}">  
      <script type="text/javascript">
$(document).ready(function(){

    var iteration= <?php echo $iteration; ?>;
    var servername= "<?php echo $server; ?>";
    // Set add new form display to none
    $("#fform"+iteration).hide();
    // Set div display to block
    $(".fadd-new"+iteration).click(function(){
      //alert("Add new");
        $("#fform"+iteration).show();
    });
    //Enable and Disable Flags Field
    $("#fprotocol"+iteration).change(function() {
      var proto=$("#fprotocol"+iteration).val()
      //alert(proto);
      if(proto == "tcp"){
          $("#fflags"+iteration).removeAttr('disabled');
      }else{
        //alert("Welcome");
        $("#fflags"+iteration).attr("disabled", "disabled");
      }
    });

   $("#fsource_ip"+iteration).change(function() {
    var ip=$("#fsource_ip"+iteration).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#fsource_msg'+iteration).html('Valid IP ').css('color', 'green');
                }else{
                  $('#fsource_msg'+iteration).html('Not Valid IP ').css('color', 'red');
                  $("#fsource_ip"+iteration).focus();
                }
                console.log(response);
        });
    });
   
   $("#fdestination_ip"+iteration).change(function() {
    var ip=$("#fdestination_ip"+iteration).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#fdestination_msg'+iteration).html('Valid IP ').css('color', 'green');
                }else{
                  $('#fdestination_msg'+iteration).html('Not Valid IP ').css('color', 'red');
                  $("#fdestination_ip"+iteration).focus();
                }
                console.log(response);
        });
    });

  //check source port validations
   function fsource_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#fsource_port'+iteration).oninput = fsource_checkKey;
//check source port validations
 function fdestination_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#fdestination_port'+iteration).oninput = fdestination_checkKey;
// Add row on add button click
  $(document).on("click", "#fadd"+iteration, function(){
      
      var no=document.getElementById("fno"+iteration).value;
      var comment=document.getElementById("fcomment"+iteration).value;
      var source_ip=document.getElementById("fsource_ip"+iteration).value;
      var destination_ip=document.getElementById("fdestination_ip"+iteration).value;
      var source_port=document.getElementById("fsource_port"+iteration).value;
      var destination_port=document.getElementById("fdestination_port"+iteration).value;
      var protocol=document.getElementById("fprotocol"+iteration).value;
      var flags=document.getElementById("fflags"+iteration).value;
      var faction=document.getElementById("foraction"+iteration).value;
     // alert(faction);
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
                  "action": faction ,
                  "add": "add"
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#fresponse').hasClass('alert-danger'))
                        {
                            $('#fresponse').removeClass('alert-danger');
                        }
                        $('#fresponse').removeClass('d-none');
                        $('#fresponse').addClass('alert-success');
                        $('#fresponse').html('Rule Are Added');
                       setTimeout(function() {$("#fresponse").hide();}, 5000);
                       $("#fformid"+iteration).trigger("reset");
                      $("#fform"+iteration).hide();


                    }   
            });
          
    });

  $(document).on("click", "#fdelete"+iteration, function(){
                    $("#fform"+iteration).hide();
                    $('#fresponse').removeClass('d-none');
                    $('#fresponse').addClass('alert-success');
                    $('#fresponse').html('Rule are Deleted');
                     setTimeout(function() {$("#fresponse").hide();}, 5000);
                    //setTimeout(function(){ location.reload(); }, 500);
      });
  // Default Policy on button click
      $("#fdefaultpolicy"+iteration).click( function(){
      
        var defaultpolicy=$(this).attr("data-click");
        var action=$("#faction"+iteration).val()
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
                
                    $('#fresponse').removeClass('d-none');
                    $('#fresponse').addClass('alert-success');
                    $('#fresponse').html('Default Policy Updated');
                    setTimeout(function() {$("#fresponse").hide();}, 3000);
        });
        
        
    });

});


</script>  
                  <div class="row" style="margin-top: 25px;">
                    <div class="col-lg-2" style="font-size: 22px;"><b>FORWARD CHAIN</b></div>
                    
                      <div class="col-lg-4">
                       FORWARD Default Policy
                      
                      
                      <select  style="width:auto; height:30px;" id="faction{{ $iteration }}" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      
                      <a class="btn btn-info btn-sm addnew" id="fdefaultpolicy{{ $loop->iteration }}" data-click="{{ $filename[0] }} {{ 'FORWARD' }}"  style="color: white;"><i class="fa fa-refresh"></i>Change</a>
                      </div>
                   
                    <div class="col-lg-3 ">
                    <span class="d-none alert col-lg-12" id="response"></span>
                  </div>
                    <div class="col-lg-3 ">
                      
                      <button type="button"  class="btn btn-success btn-sm float-right fadd-new{{ $iteration }}" ><i class="fa fa-plus"></i> Add New</button>
                      
                       
                    </div>
                  </div>

                   <div class="row">
                    <span class="d-none alert col-lg-offset-4 col-lg-4" id="fresponse"></span>
                </div>
                <br>
                    
                    <div class="row" style="border-top: solid;border-bottom: solid;">
                        <div class="col text-center col-form-label-sm">
                         <b>Sr.#</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b> Comment</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Source IP</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Destination IP</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Soucre Port</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Destination Port</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b>Protocols</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Flags</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Action</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b> Update/Delete</b>
                        </div>
                      </div>
                      <form style="margin-top: 5px;" id="fformid{{ $id }}">
                      <div class="form-row" id="fform{{ $id }}">
                        <div class="col">
                          <input type="number" id="fno{{ $id }}" class="form-control form-control-sm" placeholder="Sr.#">
                        </div>
                        <div class="col">
                          <input type="text" id="fcomment{{ $id }}" class="form-control form-control-sm" placeholder="Enter Comment">
                        </div>
                        <div class="col">
                          <input type="text" id="fsource_ip{{ $id }}" class="form-control form-control-sm" placeholder="0.0.0.0/0">
                          <span id="fsource_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fdestination_ip{{ $id }}" class="form-control form-control-sm" placeholder="0.0.0.0/0">
                          <span id="fdestination_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fsource_port{{ $id }}" class="form-control form-control-sm" placeholder="0-65535">
                          <span id="fsport_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fdestination_port{{ $id }}" class="form-control form-control-sm" placeholder="0-65535">
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="fprotocol{{ $id }}" class="form-control form-control-sm">
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                          </select>
                        </div>
                            <div class="col">
                          <input type="text" id="fflags{{ $id }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG">
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="foraction{{ $id }}" name="action">
                            <option value="ACCEPT" >ACCEPT</option> 
                            <option value="DROP" >DROP</option>
                            <option value="REJECTED" >REJECTED</option>
                          </select>
                        </div>
                            <div class="col">
                          <a class="edit btn btn-success btn-sm" id="fadd{{ $iteration }}"  title="Add" style="color: white;">&nbsp;  Add  &nbsp; &nbsp; </a>
                            <a class="delete btn btn-danger btn-sm" id="fdelete{{ $iteration }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'FORWARD' }} "  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>
                              @php
                            $no = $loop->index;
                            @endphp

                            @for($i= $no; $i<=$no; $i++)
                            @foreach($forwarddata[$i] as $row)
                                
                             @php
                              // print_r($row);
                              // echo "<br>";
                             $no2 = $loop->index;
                              $rows= explode("|", $row);
                              //print_r($rows);
                             @endphp
    {{-- Script for INPUT CHAIN--}}

 <script type="text/javascript">
$(document).ready(function(){

    var iteration= <?php echo $iteration; ?>;
    var index= <?php echo $no2; ?>;
    var servername= "<?php echo $server; ?>";
   
    //Enable and Disable Flags Field
    $("#fprotocol"+iteration+index).change(function() {
      var proto=$("#fprotocol"+iteration+index).val()
      //alert(proto);
      if(proto == "tcp"){
          $("#fflags"+iteration+index).removeAttr('disabled');
      }else{
        //alert("Welcome");
        $("#fflags"+iteration+index).attr("disabled", "disabled");
      }
    });

   $("#fsource_ip"+iteration+index).change(function() {
    var ip=$("#fsource_ip"+iteration+index).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#fsource_msg'+iteration+index).html('Valid IP ').css('color', 'green');
                }else{
                  $('#fsource_msg'+iteration+index).html('Not Valid IP ').css('color', 'red');
                  $("#fsource_ip"+iteration+index).focus();
                }
                console.log(response);
        });
    });
   
   $("#fdestination_ip"+iteration+index).change(function() {
    var ip=$("#fdestination_ip"+iteration+index).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#fdestination_msg'+iteration+index).html('Valid IP ').css('color', 'green');
                }else{
                  $('#fdestination_msg'+iteration+index).html('Not Valid IP ').css('color', 'red');
                  $("#fdestination_ip"+iteration+index).focus();
                }
                console.log(response);
        });
    });

  //check source port validations
   function fsource_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#fsource_port'+iteration+index).oninput = fsource_checkKey;
//check source port validations
 function fdestination_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#fdestination_port'+iteration+index).oninput = fdestination_checkKey;


// Update row on add button click
  $(document).on("click", "#fedit"+iteration+index, function(){
     // alert("Welcome");
      var no=document.getElementById("fno"+iteration+index).value;
      var comment=document.getElementById("fcomment"+iteration+index).value;
      var source_ip=document.getElementById("fsource_ip"+iteration+index).value;
      var destination_ip=document.getElementById("fdestination_ip"+iteration+index).value;
      var source_port=document.getElementById("fsource_port"+iteration+index).value;
      var destination_port=document.getElementById("fdestination_port"+iteration+index).value;
      var protocol=document.getElementById("fprotocol"+iteration+index).value;
      var flags=document.getElementById("fflags"+iteration+index).value;
      var action=document.getElementById("faction"+iteration+index).value;
     // alert(comment);
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
                  "add": "update"
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#fresponse').hasClass('alert-danger'))
                        {
                            $('#fresponse').removeClass('alert-danger');
                        }
                        $('#fresponse').removeClass('d-none');
                        $('#fresponse').addClass('alert-success');
                        $('#fresponse').html('Rule Are Updated');
                       setTimeout(function() {$("#fresponse").hide();}, 5000);
                       $("#fformid"+iteration).trigger("reset");
                      $("#fform"+iteration).hide();


                    }   
            });
          
    });
  $(document).on("click", "#fdelete"+iteration+index, function(){
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
                    $('#fform'+iteration+index).hide();
                    $('#fresponse').removeClass('d-none');
                    $('#fresponse').addClass('alert-success');
                    $('#fresponse').html('Rule are Deleted');
                     setTimeout(function() {$("#fresponse").hide();}, 5000);
                    //setTimeout(function(){ location.reload(); }, 500);
                }
        });
        
      });

});
</script>       
                    <?php if($no2 == 0){ ?>
                    <form style="margin-top: 5px;">
                      <div class="form-row" id="fform{{ $id }}{{ $no2 }}">
                        <div class="col">
                          <input type="text" id="fno{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="Sr.#" value="{{ $rows[0] }}" readonly style="text-align:center;">
                        </div>
                        <div class="col">
                          <input type="text" id="fcomment{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="Enter Comment" value="{{ $rows[1] }}" readonly>
                        </div>
                        <div class="col">
                          <input type="text" id="fsource_ip{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[2] }}" readonly>
                          <span id="fsource_msg{{ $id }}{{ $no2 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fdestination_ip{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[3] }}" readonly>
                          <span id="fdestination_msg{{ $id }}{{ $no2 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fsource_port{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[4] }}" readonly>
                          <span id="fsport_msg{{ $id }}{{ $no2 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fdestination_port{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[5] }}" readonly>
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="fprotocol{{ $id }}{{ $no2 }}" class="form-control form-control-sm" readonly>
                            <?php if($rows[6] == "tcp"){ ?>
                            <option value="tcp" selected>TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } elseif($rows[6] == "udp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp" selected>UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } else if($rows[6] == "icmp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp" selected>ICMP</option> 
                            <option value="*">*</option>
                            <?php }else{ ?> 
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp">ICMP</option> 
                            <option value="*" selected>*</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">

                          <input type="text" id="fflags{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG" value="{{ $rows[7] }}" readonly>
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="faction{{ $id }}{{ $no2 }}" name="action" readonly>
                            <?php if($rows[8] == "ACCEPT"){ ?>
                            <option value="ACCEPT" selected>ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php } else if($rows[8] == "DROP") { ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option style="background-color:#ffcc00;" value="DROP" selected>DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php }else if($rows[8] == "REJECTED"){ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option style="color:#ffcc00;" value="REJECTED" selected>REJECTED</option>
                            <?php }else{ ?>
                            <option value="ACCEPT" style="color: green !important;">ACCEPT</option> 
                            <option value="DROP" >DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <option style="color:#ffcc00;" value="{{ $rows[8] }}" selected>{{ $rows[8] }}</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">
                         <a class="edit btn btn-success btn-sm btn disabled" id="fedit{{ $iteration }}{{ $no2 }}"  title="update" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;" disabled>Update</a>
                            <a class="delete btn btn-danger btn-sm btn disabled" id="fdelete{{ $iteration }}{{ $no2 }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'FORWARD' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>         
                   <?php }else{ ?>
                      <form style="margin-top: 5px;">
                      <div class="form-row" id="fform{{ $id }}{{ $no2 }}">
                        <div class="col">
                          <input type="text" id="fno{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="Sr.#" value="{{ $rows[0] }}" style="text-align:center;" readonly>
                        </div>
                        <div class="col">
                          <input type="text" id="fcomment{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="Enter Comment" value="{{ $rows[1] }}">
                        </div>
                        <div class="col">
                          <input type="text" id="fsource_ip{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[2] }}" >
                          <span id="fsource_msg{{ $id }}{{ $no2 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fdestination_ip{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[3] }}">
                          <span id="fdestination_msg{{ $id }}{{ $no2 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fsource_port{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[4] }}">
                          <span id="fsport_msg{{ $id }}{{ $no2 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="fdestination_port{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[5] }}">
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="fprotocol{{ $id }}{{ $no2 }}" class="form-control form-control-sm">
                            <?php if($rows[6] == "tcp"){ ?>
                            <option value="tcp" selected>TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } elseif($rows[6] == "udp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp" selected>UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } else if($rows[6] == "icmp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp" selected>ICMP</option> 
                            <option value="*">*</option>
                            <?php }else{ ?> 
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp">ICMP</option> 
                            <option value="*" selected>*</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">

                          <input type="text" id="fflags{{ $id }}{{ $no2 }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG" value="{{ $rows[7] }}">
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="faction{{ $id }}{{ $no2 }}" name="action">
                            <?php if($rows[8] == "ACCEPT"){ ?>
                            <option value="ACCEPT" selected >ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php } else if($rows[8] == "DROP") { ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option style="background-color:#ffcc00;" value="DROP" selected>DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php }else if($rows[8] == "REJECTED"){ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option style="color:#ffcc00;" value="REJECTED" selected>REJECTED</option>
                            <?php }else{ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <option style="color:#ffcc00;" value="{{ $rows[8] }}" selected>{{ $rows[8] }}</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">
                         <a class="edit btn btn-success btn-sm" id="fedit{{ $iteration }}{{ $no2 }}"  title="update" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;" disabled>Update</a>
                            <a class="delete btn btn-danger btn-sm" id="fdelete{{ $iteration }}{{ $no2 }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'FORWARD' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>         
                   <?php } ?>

                     @endforeach
                  @endfor
                  {{--END FORWARD CHAIN  --}}




                   {{-- OUTPUT CHAIN --}}
      <script type="text/javascript">
$(document).ready(function(){

    var iteration= <?php echo $iteration; ?>;
    var servername= "<?php echo $server; ?>";
    // Set add new form display to none
    $("#oform"+iteration).hide();
    // Set div display to block
    $(".oadd-new"+iteration).click(function(){
      //alert("Add new");
        $("#oform"+iteration).show();
    });
    //Enable and Disable Flags Field
    $("#oprotocol"+iteration).change(function() {
      var proto=$("#oprotocol"+iteration).val()
      //alert(proto);
      if(proto == "tcp"){
          $("#oflags"+iteration).removeAttr('disabled');
      }else{
        //alert("Welcome");
        $("#oflags"+iteration).attr("disabled", "disabled");
      }
    });

   $("#osource_ip"+iteration).change(function() {
    var ip=$("#osource_ip"+iteration).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#osource_msg'+iteration).html('Valid IP ').css('color', 'green');
                }else{
                  $('#osource_msg'+iteration).html('Not Valid IP ').css('color', 'red');
                  $("#osource_ip"+iteration).focus();
                }
                console.log(response);
        });
    });
   
   $("#odestination_ip"+iteration).change(function() {
    var ip=$("#odestination_ip"+iteration).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#odestination_msg'+iteration).html('Valid IP ').css('color', 'green');
                }else{
                  $('#odestination_msg'+iteration).html('Not Valid IP ').css('color', 'red');
                  $("#odestination_ip"+iteration).focus();
                }
                console.log(response);
        });
    });

  //check source port validations
   function osource_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#osource_port'+iteration).oninput = osource_checkKey;
//check source port validations
 function odestination_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#odestination_port'+iteration).oninput = odestination_checkKey;
// Add row on add button click
  $(document).on("click", "#oadd"+iteration, function(){
      
      var no=document.getElementById("ono"+iteration).value;
      var comment=document.getElementById("ocomment"+iteration).value;
      var source_ip=document.getElementById("osource_ip"+iteration).value;
      var destination_ip=document.getElementById("odestination_ip"+iteration).value;
      var source_port=document.getElementById("osource_port"+iteration).value;
      var destination_port=document.getElementById("odestination_port"+iteration).value;
      var protocol=document.getElementById("oprotocol"+iteration).value;
      var flags=document.getElementById("oflags"+iteration).value;
      var oaction=document.getElementById("outaction"+iteration).value;
      //alert(oaction);
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
                  "action": oaction ,
                  "add": "add"
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#oresponse').hasClass('alert-danger'))
                        {
                            $('#oresponse').removeClass('alert-danger');
                        }
                        $('#oresponse').removeClass('d-none');
                        $('#oresponse').addClass('alert-success');
                        $('#oresponse').html('Record Are Added');
                       setTimeout(function() {$("#oresponse").hide();}, 5000);
                       $("#oformid"+iteration).trigger("reset");
                      $("#oform"+iteration).hide();


                    }   
            });
          
    });

  $(document).on("click", "#odelete"+iteration, function(){
                    $("#oform"+iteration).hide();
                    $('#oresponse').removeClass('d-none');
                    $('#oresponse').addClass('alert-success');
                    $('#oresponse').html('Rule are Deleted');
                     setTimeout(function() {$("#oresponse").hide();}, 5000);
                    //setTimeout(function(){ location.reload(); }, 500);
      });
  // Default Policy on button click
      $("#odefaultpolicy"+iteration).click( function(){
      
        var defaultpolicy=$(this).attr("data-click");
        var action=$("#oaction"+iteration).val()
       // alert(action);
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
                
                    $('#oresponse').removeClass('d-none');
                    $('#oresponse').addClass('alert-success');
                    $('#oresponse').html('Default Policy Updated');
                    setTimeout(function() {$("#oresponse").hide();}, 3000);
        });
        
        
    });

});


</script> 






                      <hr>
                  <div class="row" style="margin-top: 25px;">
                    <div class="col-lg-2" style="font-size: 22px;"><b>OUTPUT CHAIN</b></div>
                    
                      <div class="col-lg-4">
                       OUTPUT Default Policy
                      
                      
                      <select  style="width:auto; height:30px;" id="oaction{{ $iteration }}" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      
                      <a class="btn btn-info btn-sm addnew" id="odefaultpolicy{{ $loop->iteration }}" data-click="{{ $filename[0] }} {{ 'OUTPUT' }}"  style="color: white;"><i class="fa fa-refresh"></i>Change</a>
                      </div>
                   
                    <div class="col-lg-3 ">
                    <span class="d-none alert col-lg-12" id="response"></span>
                  </div>
                    <div class="col-lg-3 ">
                      
                      <button type="button"  class="btn btn-success btn-sm float-right oadd-new{{ $iteration }}" ><i class="fa fa-plus"></i> Add New</button>
                      
                       
                    </div>
                  </div>

                   <div class="row">
                    <span class="d-none alert col-lg-offset-4 col-lg-4" id="0response"></span>
                </div>
                <br>
                    
                    <div class="row" style="border-top: solid;border-bottom: solid;">
                        <div class="col text-center col-form-label-sm">
                         <b>Sr.#</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b> Comment</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Source IP</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Destination IP</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Soucre Port</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Destination Port</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b>Protocols</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Flags</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                          <b>Action</b>
                        </div>
                        <div class="col text-center col-form-label-sm">
                         <b> Update/Delete</b>
                        </div>
                      </div>
                      <form style="margin-top: 5px;" id="oformid{{ $id }}">
                      <div class="form-row" id="oform{{ $id }}">
                        <div class="col">
                          <input type="number" id="ono{{ $id }}" class="form-control form-control-sm" placeholder="Sr.#">
                        </div>
                        <div class="col">
                          <input type="text" id="ocomment{{ $id }}" class="form-control form-control-sm" placeholder="Enter Comment">
                        </div>
                        <div class="col">
                          <input type="text" id="osource_ip{{ $id }}" class="form-control form-control-sm" placeholder="0.0.0.0/0">
                          <span id="osource_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="odestination_ip{{ $id }}" class="form-control form-control-sm" placeholder="0.0.0.0/0">
                          <span id="odestination_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="osource_port{{ $id }}" class="form-control form-control-sm" placeholder="0-65535">
                          <span id="osport_msg{{ $id }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="odestination_port{{ $id }}" class="form-control form-control-sm" placeholder="0-65535">
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="oprotocol{{ $id }}" class="form-control form-control-sm">
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                          </select>
                        </div>
                            <div class="col">
                          <input type="text" id="oflags{{ $id }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG">
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="outaction{{ $id }}" name="action">
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                          </select>
                        </div>
                            <div class="col">
                          <a class="edit btn btn-success btn-sm" id="oadd{{ $iteration }}"  title="Add" style="color: white;">&nbsp;  Add  &nbsp; &nbsp; </a>
                            <a class="delete btn btn-danger btn-sm" id="odelete{{ $iteration }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'INPUT' }} "  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>
                              @php
                            $no = $loop->index;
                            @endphp

                            @for($i= $no; $i<=$no; $i++)
                            @foreach($inputdata[$i] as $row)
                                
                             @php
                              // print_r($row);
                              // echo "<br>";
                             $no3 = $loop->index;
                              $rows= explode("|", $row);
                              //print_r($rows);
                             @endphp
    {{-- Script for INPUT CHAIN--}}

 <script type="text/javascript">
$(document).ready(function(){

    var iteration= <?php echo $iteration; ?>;
    var index= <?php echo $no3; ?>;
    var servername= "<?php echo $server; ?>";
   
    //Enable and Disable Flags Field
    $("#oprotocol"+iteration+index).change(function() {
      var proto=$("#oprotocol"+iteration+index).val()
     // alert(proto);
      if(proto == "tcp"){
          $("#oflags"+iteration+index).removeAttr('disabled');
      }else{
        //alert("Welcome");
        $("#oflags"+iteration+index).attr("disabled", "disabled");
      }
    });

   $("#osource_ip"+iteration+index).change(function() {
    var ip=$("#osource_ip"+iteration+index).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#osource_msg'+iteration+index).html('Valid IP ').css('color', 'green');
                }else{
                  $('#osource_msg'+iteration+index).html('Not Valid IP ').css('color', 'red');
                  $("#osource_ip"+iteration+index).focus();
                }
                console.log(response);
        });
    });
   
   $("#odestination_ip"+iteration+index).change(function() {
    var ip=$("#odestination_ip"+iteration+index).val()
       $.ajax({
                url: '/checkip',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}",
                 'ip': ip,
               }
            }).done(function(response){
                if (response==='valid')
                { 
                 $('#odestination_msg'+iteration+index).html('Valid IP ').css('color', 'green');
                }else{
                  $('#odestination_msg'+iteration+index).html('Not Valid IP ').css('color', 'red');
                  $("#odestination_ip"+iteration+index).focus();
                }
                console.log(response);
        });
    });

  //check source port validations
   function osource_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#osource_port'+iteration+index).oninput = osource_checkKey;
//check source port validations
 function odestination_checkKey() {
    var clean = this.value.replace(/[^0-9,]/g, "")
                           .replace(/(,.*?),(.*,)?/, "$1");
    // don't move cursor to end if no change
    if (clean !== this.value) this.value = clean;
}

// demo
document.querySelector('#odestination_port'+iteration+index).oninput = odestination_checkKey;


// Update row on add button click
  $(document).on("click", "#oedit"+iteration+index, function(){
      //alert("Welcome");
      var no=document.getElementById("ono"+iteration+index).value;
      var comment=document.getElementById("ocomment"+iteration+index).value;
      var source_ip=document.getElementById("osource_ip"+iteration+index).value;
      var destination_ip=document.getElementById("odestination_ip"+iteration+index).value;
      var source_port=document.getElementById("osource_port"+iteration+index).value;
      var destination_port=document.getElementById("odestination_port"+iteration+index).value;
      var protocol=document.getElementById("oprotocol"+iteration+index).value;
      var flags=document.getElementById("oflags"+iteration+index).value;
      var action=document.getElementById("outaction"+iteration+index).value;
     // alert(comment);
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
                  "add": "update"
                }

            }).done(function(response){
                  if (response==='inserted')
                    {
                        if ($('#oresponse').hasClass('alert-danger'))
                        {
                            $('#oresponse').removeClass('alert-danger');
                        }
                        $('#oresponse').removeClass('d-none');
                        $('#oresponse').addClass('alert-success');
                        $('#oresponse').html('Rule are Updated');
                       setTimeout(function() {$("#oresponse").hide();}, 5000);
                       $("#oformid"+iteration).trigger("reset");
                      $("#oform"+iteration).hide();


                    }   
            });
          
    });
  $(document).on("click", "#odelete"+iteration+index, function(){
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
                    $('#oform'+iteration+index).hide();
                    $('#oresponse').removeClass('d-none');
                    $('#oresponse').addClass('alert-success');
                    $('#oresponse').html('Rule are Deleted');
                     setTimeout(function() {$("#oresponse").hide();}, 5000);
                    //setTimeout(function(){ location.reload(); }, 500);
                }
        });
        
      });

});
</script>       
                    <?php if($no3 == 0){ ?>
                    <form style="margin-top: 5px;">
                      <div class="form-row" id="oform{{ $id }}{{ $no3 }}">
                        <div class="col">
                          <input type="text" id="ono{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="Sr.#" value="{{ $rows[0] }}" readonly style="text-align:center;">
                        </div>
                        <div class="col">
                          <input type="text" id="ocomment{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="Enter Comment" value="{{ $rows[1] }}" readonly>
                        </div>
                        <div class="col">
                          <input type="text" id="osource_ip{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[2] }}" readonly>
                          <span id="osource_msg{{ $id }}{{ $no3 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="odestination_ip{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[3] }}" readonly>
                          <span id="odestination_msg{{ $id }}{{ $no3 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="osource_port{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[4] }}" readonly>
                          <span id="osport_msg{{ $id }}{{ $no3 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="odestination_port{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[5] }}" readonly>
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="oprotocol{{ $id }}{{ $no3 }}" class="form-control form-control-sm" readonly>
                            <?php if($rows[6] == "tcp"){ ?>
                            <option value="tcp" selected>TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } elseif($rows[6] == "udp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp" selected>UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } else if($rows[6] == "icmp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp" selected>ICMP</option> 
                            <option value="*">*</option>
                            <?php }else{ ?> 
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp">ICMP</option> 
                            <option value="*" selected>*</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">

                          <input type="text" id="oflags{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG" value="{{ $rows[7] }}" readonly>
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="outaction{{ $id }}{{ $no3 }}" name="action" readonly>
                            <?php if($rows[8] == "ACCEPT"){ ?>
                            <option value="ACCEPT" selected>ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php } else if($rows[8] == "DROP") { ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option style="background-color:#ffcc00;" value="DROP" selected>DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php }else if($rows[8] == "REJECTED"){ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option style="color:#ffcc00;" value="REJECTED" selected>REJECTED</option>
                            <?php }else{ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <option style="color:#ffcc00;" value="{{ $rows[8] }}" selected>{{ $rows[8] }}</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">
                         <a class="edit btn btn-success btn-sm btn disabled" id="oedit{{ $iteration }}{{ $no3 }}"  title="update" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;" disabled>Update</a>
                            <a class="delete btn btn-danger btn-sm btn disabled" id="odelete{{ $iteration }}{{ $no3 }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'OUTPUT' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form>         
                   <?php }else{ ?>
                      <form style="margin-top: 5px;">
                      <div class="form-row" id="oform{{ $id }}{{ $no3 }}">
                        <div class="col">
                          <input type="text" id="ono{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="Sr.#" value="{{ $rows[0] }}" readonly style="text-align:center;">
                        </div>
                        <div class="col">
                          <input type="text" id="ocomment{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="Enter Comment" value="{{ $rows[1] }}">
                        </div>
                        <div class="col">
                          <input type="text" id="osource_ip{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[2] }}">
                          <span id="osource_msg{{ $id }}{{ $no3 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="odestination_ip{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0.0.0.0/0" value="{{ $rows[3] }}">
                          <span id="odestination_msg{{ $id }}{{ $no3 }}"></span>
                        </div>
                            <div class="col">
                          <input type="text" id="osource_port{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[4] }}">
                        </div>
                            <div class="col">
                          <input type="text" id="odestination_port{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="0-65535" value="{{ $rows[5] }}">
                        </div>
                            <div class="col">
                          
                          <select  name="protocol"  id="oprotocol{{ $id }}{{ $no3 }}" class="form-control form-control-sm">
                            <?php if($rows[6] == "tcp"){ ?>
                            <option value="tcp" selected>TCP</option>
                            <option value="udp">UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } elseif($rows[6] == "udp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp" selected>UDP</option>
                            <option value="icmp">ICMP</option> 
                            <option value="*">*</option>
                            <?php } else if($rows[6] == "icmp"){?>
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp" selected>ICMP</option> 
                            <option value="*">*</option>
                            <?php }else{ ?> 
                            <option value="tcp">TCP</option>
                            <option value="udp">UDP</option> 
                            <option value="icmp">ICMP</option> 
                            <option value="*" selected>*</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">

                          <input type="text" id="oflags{{ $id }}{{ $no3 }}" class="form-control form-control-sm" placeholder="SYN,ACK,FIN,RST,PSH,URG" value="{{ $rows[7] }}">
                        </div>
                            <div class="col">
                          
                          <select class="form-control form-control-sm" id="outaction{{ $id }}{{ $no3 }}" name="action">
                            <?php if($rows[8] == "ACCEPT"){ ?>
                            <option value="ACCEPT" selected>ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php } else if($rows[8] == "DROP") { ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option style="background-color:#ffcc00;" value="DROP" selected>DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <?php }else if($rows[8] == "REJECTED"){ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option style="color:#ffcc00;" value="REJECTED" selected>REJECTED</option>
                            <?php }else{ ?>
                            <option value="ACCEPT">ACCEPT</option> 
                            <option value="DROP">DROP</option>
                            <option value="REJECTED">REJECTED</option>
                            <option style="color:#ffcc00;" value="{{ $rows[8] }}" selected>{{ $rows[8] }}</option>
                            <?php } ?>
                          </select>
                        </div>
                            <div class="col">
                         <a class="edit btn btn-success btn-sm" id="oedit{{ $iteration }}{{ $no3 }}"  title="update" data-toggle="tooltip" data-click="{{ 'update' }}" style="color: white;">Update</a>
                            <a class="delete btn btn-danger btn-sm" id="odelete{{ $iteration }}{{ $no3 }}" title="Delete"  data-toggle="tooltip" data-click="{{ $filename[0] }} {{ 'OUTPUT' }} {{$rows[0]}}"  style="color: white;">Delete</a>
                        </div>
                      </div>
                    </form> 
                   <?php } ?>

                     @endforeach
                  @endfor
                  {{--END OUTPUT CHAIN  --}}
                </div>
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
    </section>
  
</div>
<!-- .// Accordion -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>