<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Management</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/e68b4820fd.js" crossorigin="anonymous"></script>

 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<style type="text/css">
    html, body {
        font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
        color: #404E67;
        background: #F5F7FA;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
    }
    .table-responsive {
        margin: 30px auto;
        background: #fff;
        padding: 20px;  
        box-shadow: 0 2px 2px rgba(0,0,0,.05);
    }
    .table-wrapper {
        width: 1000px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;  
        box-shadow: 0 2px 2px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
        height: 30px;
        font-weight: bold;
        font-size: 12px;
        text-shadow: none;
        min-width: 100px;
        border-radius: 0px;
        line-height: 13px;
    }
    .table-title .add-new i {
        margin-right: 4px;
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
    .navbar-dark .navbar-nav .nav-link {
    color: #f8f9fa;
    }
    .navbar-brand {
    font-size: 1.25rem;
    float: left;
    height: 50px;
    padding: 11px 15px;
    /*font-size: 16px;*/
    }
    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    width: 14%;
    }
    .navbar{
        border-radius: 0;
        padding: 0rem 1rem;
        font-size: 16px;
    }
    .dropdown-menu {
      right: 0;
      left: auto;
    }

    .select2-selection__rendered {
      line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
      height: 36px !important;
    }
    .select2-selection__arrow {
      height: 36px !important;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: white;
    }

    @media (max-width: 600px) {
      .git_auto_pull_page_heading, #navbar_brand_name {
        font-size: 16px;
      }
    }
    .modal-open .modal {
        padding-top: 50px;
    }
/*    .modal-content {
        padding-top: 50px;
    }*/
</style>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_template').select2();

    $('#select_template_servers').select2({
        placeholder: "Select Server"
    });
    var flag=true;
    var match=false;
    var edit=false;
    $('[data-toggle="tooltip"]').tooltip();
    var actions = '<a class="add btn btn-success btn-sm" title="Add" data-toggle="tooltip" style="color:white;">Add</a><a class="edit btn btn-success btn-sm" title="Edit" data-toggle="tooltip" style="color:white;">Edit</a><a class="cancel btn btn-warning btn-sm" onClick="window.location.reload();" title="Cancel" data-toggle="tooltip" style="color:white;">Cancel</a>';
    // Append table with add row form on add new button click
    $(".add-new").click(function(){
        $(this).attr("disabled", "disabled");
        var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" id="newname" class="form-control" name="name"></td>' +
            '<td><input type="email" id="newemail" class="form-control" name="email"></td>' +
            '<td><input type="password" id="newpass" class="form-control" name="email"></td>' +
            '<td>' + actions + '</td>' +
        '</tr>';
        $("table").prepend(row);        
        $("table tbody tr").eq(0).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();

    });

   function validateEmail($email) 
   {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          if( !emailReg.test( $email ) ) {
            flag=false;
          } else {
            flag=true;          }
    }
    // Add row on add button click
    $(document).on("click", ".add", function(){
        var empty = false;
        var input = $(this).parents("tr").find('input[type="text"]');
        var input1 = $(this).parents("tr").find('input[type="password"]');
        var input2 = $(this).parents("tr").find('input[type="email"]');

        input.each(function(){
            if(!$(this).val()){
                $(this).addClass("error");
                empty = true;
            } else{
                $(this).removeClass("error");
            }
        });

        input1.each(function(){
            if(!$(this).val()){
                $(this).addClass("error");
                empty = true;
            } else{
                $(this).removeClass("error");
            }
        });

        input2.each(function(){
            if(!$(this).val()){
                $(this).addClass("error");
                empty = true;
            } else{
                validateEmail($(this).val());
                $(this).removeClass("error");
            }
        });

        $(this).parents("tr").find(".error").first().focus();
        if(!empty){
            if (flag===true){
            var name=document.getElementById("newname").value;
            var email=document.getElementById("newemail").value;
            var password=document.getElementById("newpass").value;
            <?php
            foreach ($users as $user)
            {
                ?>
                if(email==='<?php echo $user->email; ?>' || name==='<?php echo $user->name; ?>' )
                {
                    match=true;
                }
                <?php
            }
            ?>
            if (match && !edit)
            {

                $('#response').removeClass('d-none');
                $('#response').addClass('alert-danger');
                $('#response').html('Same Email/Name Cannot be Registered');
                setTimeout(function(){ location.reload(); }, 2000);
            }
            else{
                input.each(function(){
                    $(this).parent("td").html($(this).val());
                });         
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").removeAttr("disabled");

                // add data into database 
                $.ajax({
                    url: '/user_management',
                    type: 'POST',
                    data: { "_token": "{{ csrf_token() }}", "name": name, "email": email, "password": password}

                }).done(function(response){
                    if (response==='inserted')
                    {
                        if ($('#response').hasClass('alert-danger'))
                        {
                            $('#response').removeClass('alert-danger');
                        }
                        $('#response').removeClass('d-none');
                        $('#response').addClass('alert-success');
                        $('#response').html('User Added');
                        setTimeout(function(){ location.reload(); }, 300);
                    }
                    else if (response==='updateded')
                    {
                        if ($('#response').hasClass('alert-danger'))
                        {
                            $('#response').removeClass('alert-danger');
                        }
                        $('#response').removeClass('d-none');
                        $('#response').addClass('alert-success');
                        $('#response').html('User Updateded');
                        setTimeout(function(){ location.reload(); }, 300);
                    }
                    
                });
            }
        }
        else{ 
                    $('#response').removeClass('d-none');
                    $('#response').addClass('alert-danger');
                    $('#response').html('Enter Valid Email');
        }
             
        }
    });

    // Edit row on edit button click
    $(document).on("click", ".edit", function(){    
        edit=true;
    var ids = ["newname", "newemail", "newpass"];
        var readonly='';
        $(this).parents("tr").find("td:not(:last-child)").each(function(k,v){
            if(ids[k]=='newemail'){
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
        $(this).parent().append('<a class="cancel btn btn-warning btn-sm" onClick="window.location.reload();" title="Cancel" data-toggle="tooltip" style="color:white;">Cancel</a>');
        $(this).parents("tr").find(".add, .edit").toggle();
        $(".add-new").attr("disabled", "disabled");
    });

    // Delete row on delete button click
    $(document).on("click", ".delete", function(){
        var email=$(this).attr("data-click");
        if(email!==undefined){
        $.ajax({
                url: '/user_management/'+email,
                type: 'DELETE',
                data: { "_token": "{{ csrf_token() }}"}
            }).done(function(response){
                if (response==='deleted')
                {
                    if ($('#response').hasClass('alert-danger'))
                    {
                        $('#response').removeClass('alert-danger');
                    }
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
</script>
</head>
<body>
@include('includes.nav')
<div class="container">
    <div class="table-responsive">
        <form>
          <div class="row">
            <div class="col-sm-8"><h2><b>Current User Details</b></h2></div>
        </div>


        
        <div class="hidden"></div>

          <div class="form-group">
            <label>User Name </label>
            <input type="text" class="form-control" id="current_user" placeholder="Hamza" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label>Confirm Password </label>
            <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" required>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <hr>
        <div class="table-responsive">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4"><h2><b>Users List</b></h2></div>
                    <div class="col-sm-8">
                        <button type="button" class="btn btn-primary add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                    <div class="d-none alert col-sm-12" id="response"></div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-responsive" >
                <thead style="border-top: solid;border-bottom: solid;">
                    <tr>
                        <th>User Name</th>
                        <th>Email </th>
                        <th>Password </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($users as $user)
                        <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>****************</td>
                         <td>
                            <a class="add btn btn-success btn-sm" title="Add" data-toggle="tooltip" style="color: white;">Add</i></a>
                            <a class="edit btn btn-success btn-sm" title="Edit" data-toggle="tooltip" style="color: white;">Edit</a>
                            <a class="delete btn btn-danger btn-sm" title="Delete" data-click="{{$user->email}}" data-toggle="tooltip" style="color: white;">Delete</a>                      
                        </td>
                        </tr>
                        @endforeach
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>    
</body>
</html>
