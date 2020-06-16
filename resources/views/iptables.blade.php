{{-- @include('includes/navbar') --}}

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
    color: #404E67;
    background: #F5F7FA;
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
        padding-bottom: 10px;
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
    border-radius: 50px;
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
  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("table td:last-child").html();
  // Append table with add row form on add new button click
    $(".add-new").click(function(){
    $(this).attr("disabled", "disabled");
    var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" placeholder="Sr.#" name="no" id="no"></td>' +
            '<td><input type="text" class="form-control" placeholder="Comment" name="comment" id="comment"></td>' +
            '<td><input type="text" class="form-control" name="source_ip" placeholder="0.0.0.0/0" id="source_ip"></td>' +
            '<td><input type="text" class="form-control" name="destination_ip" placeholder="0.0.0.0/0" id="destination_ip"></td>' +
      '<td><input type="text" class="form-control" name="source_port" placeholder="0-65535" id="source_port"></td>' +
            '<td><input type="text" class="form-control" name="destination_port" placeholder="0-65535" id="destination_port"></td>' +
            '<td><input type="text" class="form-control" name="protocol" placeholder="TCP, UDP, ICMP" id="protocol"></td>' +
            '<td><input type="text" class="form-control" name="flags" id="flags" placeholder="SYN, ACK, FIN, URG"></td>' +
            '<td><input type="text" class="form-control" name="action" placeholder="ACCEPT/DROP" id="action"></td>' +
            '<td>' + actions + '</td>' +
        '</tr>';
      $("table").prepend(row);   
    $("table tbody tr").eq(0).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
  // Add row on add button click
  $(document).on("click", ".add", function(){
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
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").removeAttr("disabled");
       // add into text 
            $.ajax({
                url: '/addruleip',
                type: 'POST',
                data: { 
                  "_token": "{{ csrf_token() }}", 
                  "comment": comment,
                  "source_ip": source_ip, 
                  "destination_ip": destination_ip,
                  "source_port": source_port,
                  "destination_port": destination_port,
                  "protocol": protocol, 
                  "flags": flags,
                  "action": action 
                }

            }).done(function(response){
                alert("New Rule Created !");
            });

    }   
    });


  // Edit row on edit button click
  $(document).on("click", ".edit", function(){  
    var ids = ["comment", "source_ip", "destination_ip","source_port","destination_port","protocol","flags","action"];
      var readonly='';
        $(this).parents("tr").find("td:not(:last-child)").each(function(k,v){
           if(ids[k]=='name'){
                readonly='readonly';}
            else{
                readonly='';}
            if(ids[k]=='newemail'){
                 $(this).html('<input '+readonly+' type="email" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            }
            else if(ids[k]=='newpass'){
                 $(this).html('<input '+readonly+' type="password" id="'+ids[k]+'" class="form-control">');
            }
            else{
                $(this).html('<input '+readonly+' type="text" id="'+ids[k]+'" class="form-control" value="' + $(this).text() + '">');
            }
    });   
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".add-new").attr("disabled", "disabled");
    });

  // Delete row on delete button click
  $(document).on("click", ".delete", function(){
        var ruleno=$(this).attr("data-click");
        if(email!==undefined){
        $.ajax({
                url: '/deleteiprule/',
                type: 'POST',
                data: {
                 "_token": "{{ csrf_token() }}"

               }
            }).done(function(response){
                if (response==='deleted')
                {
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-success');
                    $('#response').html('User Deleted');
                    setTimeout(function(){ location.reload(); }, 500);
                }
        });
        }
        $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
    });
});

$(document).ready(function(){
  $(".show").click(function(){
      // alert("welcome");
     $(".h").show();
  });
});
</script>
</head>
<body>

<div class="container">
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
              
        @endphp
     
      
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" id= "servername" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" style="color: #007b5e;">
           
               <h4><strong> {{ $filename[0] }} - {{ $filename[1] }}</strong></h4>
              
              
          </a>
        </h4>
      </div>
      <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse">
        <div class="panel-body">
         {{--  @php
                  $no = $loop->index;
                  @endphp

                  @for($i= $no; $i<=$no; $i++) --}}

          <div class="table-responsive">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2"><h2>INPUT CHAIN</h2></div>
                    <div class="col-sm-5">
                      <div class="col-sm-4">
                        <small>INPUT Default Policy</small>
                      </div>
                      
                      <select class="col-sm-3" style="width:100px;"  id="action" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      <div class="col-sm-4">
                      <button type="button" class="btn btn-primary addnew"><i class="fa fa-pencil"></i> Change</button> 
                      </div>
                    </div>

                    <div class="col-sm-5">
                       <button type="button" class="btn btn-success addnew show" ><i class="fa fa-eye"></i> Show Advance</button> 

                      <button type="button" id="add-new" class="btn btn-info add-new addnew"><i class="fa fa-plus"></i> Add New</button>
                       
                    </div>
                </div>
            </div>
              
            <table class="table table-striped table-bordered table-responsive">
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
                        <td>{{ $rows[8] }}</td>
                        <td>
                           <a class="add btn btn-success btn-sm" title="Add" data-toggle="tooltip" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" title="Edit" data-toggle="tooltip" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" title="Delete"  data-toggle="tooltip" data-click="{{$rows[0], 'INPUT'}}"  style="color: white;">Delete</a>
                        </td>
                    </tr>
                   
                 @endforeach
                  @endfor
                </tbody>
                
            </table>
          
          </div>
              
          <div hidden class="h">
      <div class="table-responsive" >
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2"><h2>FORWARD CHAIN</h2></div>
                    <div class="col-sm-5">
                      <div class="col-sm-5">
                        <small>FORWARD Default Policy</small>
                      </div>
                      
                      <select class="col-sm-3" style="width:100px;"  id="action" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      <div class="col-sm-4">
                      <button type="button" class="btn btn-primary addnew"><i class="fa fa-pencil"></i> Change</button> 
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <button type="button" id="add-new" class="btn btn-info add-new addnew"><i class="fa fa-plus"></i> Add New</button>
                       
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
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
                        <td>{{ $rows[8] }}</td>
                        <td>
                           <a class="add btn btn-success btn-sm" title="Add" data-toggle="tooltip" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" title="Edit" data-toggle="tooltip" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" title="Delete"  data-toggle="tooltip" style="color: white;">Delete</a>
                        </td>
                    </tr>
                  @endforeach
                  @endfor
                </tbody>
            </table>
        </div>


        <div class="table-responsive show">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2"><h2>OUTPUT CHAIN</h2></div>
                    <div class="col-sm-5">
                      <div class="col-sm-5">
                        <small>OUTPUT Default Policy</small>
                      </div>
                      
                      <select class="col-sm-3" style="width:100px;"  id="action" name="action">
                        <option value="ACCEPT">ACCEPT</option> 
                        <option value="DROP">DROP</option>
                      </select>
                      <div class="col-sm-4">
                      <button type="button" class="btn btn-primary addnew"><i class="fa fa-pencil"></i> Change</button> 
                      </div>
                    </div>

                    <div class="col-sm-5">

                      <button type="button" id="add-new" class="btn btn-info add-new addnew"><i class="fa fa-plus"></i> Add New</button>
                       
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
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
                        <td>{{ $rows[8] }}</td>
                        <td>
                           <a class="add btn btn-success btn-sm" title="Add" data-toggle="tooltip" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" title="Edit" data-toggle="tooltip" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" title="Delete"  data-toggle="tooltip" style="color: white;">Delete</a>
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
