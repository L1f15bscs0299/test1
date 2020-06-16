<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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
        <!--  -->
        <style>
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
        </style>
    </head>
    <body>
         <nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link fa fa-home" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link fa fa-key" data-toggle="modal" data-target="#keyModal" href="/key">My Public key</a>
      </li>
      <li class="nav-item">
        <a class="nav-link fa fa-plus" data-toggle="modal" data-target="#myModal" href="#">Add Server</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Interface</a>
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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="/add_server" enctype="multipart/form-data" id="form">
        @csrf
        <div class="modal-body">
            <label>Server Name</label>
                <br><br>
            <input class="form-control mr-sm-2" class="form-control col-md-7 col-xs-12" name="server_name" id="server_name" placeholder="Server name" type="text">
            <div id="error"></div>
        </div>
        <div class="modal-body">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ip Address <span class="required">*</span> </label>
                <br><br>
            <input class="form-control mr-sm-2"  class="form-control col-md-7 col-xs-12" id="server_ip" name="server_ip" placeholder="Ip Address" type="text">
            <div>
                <p id="ip-error"></p>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-primary" id="submit-button">Save changes</button>
        </div>
    </form>
    </div>
  </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="keyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Public Key</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
              <textarea name="public_key" style="width: 100%; height:150px;" readonly>{{ $key }}</textarea>
<!--             <input class="form-control mr-sm-2" class="form-control col-md-7 col-xs-12" name="server_name" id="server_name" placeholder="Server name" type="text"> -->
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        </div>

    </div>
  </div>
</div>
              <div class="container">
       <div class="alert alert-primary" role="alert">
        <h2 class="alert-heading">Remote Clients!</h2>
    </div>
    <hr/>
    <form action="write.php" method="POST">
    <div class="form-row">
    <div class="col">
    <input type="text" name="name" value="" class="form-control" placeholder="IP Address" readonly>
    </div>
    <div class="col">
    <input type="text" name="ip" value="" class="form-control" placeholder="Username" readonly>
    </div>
    <div class="col">
    <input type="text" name="status" class="form-control" placeholder="Status" required>
    </div>
    <div class="col">
    <input type="submit" class="form-control btn btn-outline-danger" value="Start">
    </div>
    </div>

    </form>

  

    <hr>
    <div class="col-sm-8">
    <div id="terminal" class="col-sm-8"></div>
    <script>
    $('body').terminal({
        hello: function(what) {
            this.echo('Hello, ' + what +
                      '. Wellcome to this terminal.');
        }
    }, {
        greetings: 'My First Terminal'
    });
    </script>
    </div>



       <!--  <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> -->

    </body>
</html>
