<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Remote Clients</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <!--  -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://unpkg.com/jquery.terminal/js/jquery.terminal.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/jquery.terminal/css/jquery.terminal.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/e68b4820fd.js" crossorigin="anonymous"></script>
        <!--  -->

 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <style>
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
            h5{
                font-weight: bold;
            }
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            textarea{
                background-color: #D8E4FF;
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
        </style>
        <script type="text/javascript">
        $(document).ready(function () {
            $('#select_template').select2();
            $('#select_template_servers').select2({
                placeholder: "Select Server"
            });
        });
            function myFunction() {
              var copyText = document.getElementById("commands");
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
                $('#response').removeClass('d-none');
                $('#response').addClass('alert-success');
                $('#response').html('Copied to The Clipboard ');
                setTimeout(function(){ window.open("https://127.0.0.1:4200", "_blank"); }, 2000);
            }
            function ChangeStatus() {
                var today = new Date();
                var currentMinute = today.getMinutes();
                var currentHour = today.getHours();
                $.ajax({
                    url: '/remote/update',
                    type: 'POST',
                    data: { "_token": "{{ csrf_token() }}"}
                }).done(function(response){
                       if (response==='checked')
                       {
                            location.reload();
                       }
                });   
            }
            setInterval(function() { ChangeStatus(); }, 120000);
            function writedata(th)
            {
                var form=$(th).parent().closest("form");
                console.log(form.serialize());
                $.ajax({
                    url: '/remote/write',
                    type: 'POST',
                    data: form.serialize()
                }).done(function(response){
                    $("#commands").text("nc -lvp "+response);
                });
            }
        </script>

    </head>
    <body>
       @include('includes.nav')
       <br><br>
        <div class="container">
           <div class="alert" role="alert">
            <h2 class="text-center font-weight-bold" style="color: green">Remote Shell</h2>
        </div>
        <hr/>
        <div class="form-row">
            <div class="col">
            <h5><b>IP Address</b></h5>
            </div>
            <div class="col">
            <h5><b>User Name</b></h5>
            </div>
            <div class="col">
            <h5><b>Status</b></h5>
            </div>
            <div class="col">
            <h5><b>Actions</b></h5>
            </div>
        </div>
        @foreach($data as $row)
        @php
          $fields= explode(":", $row);
          echo "<br>";
          // print_r($fields);  
        @endphp
        <form action="/remote/write" method="POST">
            @csrf
        <div class="form-row">
        <div class="col">
        <input type="text" id="ip" name="ip" value="{{ $fields[0] }}" class="form-control" placeholder="IP Address" readonly>
        </div>
        <div class="col">
        <input type="text" id="name" name="name" value="{{ $fields[1] }}" class="form-control" placeholder="Username" readonly>
        </div>
        <div class="col">
        <input type="text" id="status" name="status" value="{{ $fields[2] }}" 
        class="<?php if($fields[2]=='Online'){ echo "bg-success"; } else { echo "bg-danger" ; }  ?> font-weight-bold text-white form-control status" placeholder="Status" readonly>
        </div>
        <div class="col">
        <!-- <button type="submit" class="form-control btn btn-outline-danger" value="Start" >Start</button> -->
        <input type="button" name="btn" value="Start Shell" onclick="writedata(this)" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" <?php if($fields[2]=='Online'){} else { echo "disabled" ; }  ?> class="form-control btn btn-outline-danger"/>
        </div>
        </div>
        </form>
        @endforeach

<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Please paste the command the into the terminal</h5>
            </div>
            <div class="d-none alert col-sm-12" id="response"></div>
            <div class="modal-body">
                <textarea id="commands" name="commands" rows="2" cols="50"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" onclick="myFunction()" class="btn btn-outline-danger" value="Start" >Copy</button>
            </div>
        </div>
    </div>
</div>

    </body>
</html>
