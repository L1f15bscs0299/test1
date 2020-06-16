<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Git Auto Pull</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e68b4820fd.js" crossorigin="anonymous"></script>
  <style>
    #select_ip, #add_white_list_ip {
      width: 200px;
    }

    #delete_ip_btn, #add_ip_btn {
      width: 70px;
    }

    body {
      font-family: 'Roboto', sans-serif;
      font-size: 14px;
    }

    #repo_heading:hover {
      cursor: pointer;
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
</head>
<body>
  @include('includes.nav')

  @yield('content')


<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!--   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function () {
      $('#repo_records_table').DataTable({
        "ordering": false,
        "scrollX": true,
        "paging": false,
        "searching": false
      });

      $('#logsTable').DataTable({
        "ordering": false,
        "scrollX": true
      });

      $('#repo_heading').click(function() {
        $('#repo_block').toggle('slow');

        if ($(this).text() == "Hide Repo's and Assigned Servers") {
          $(this).text("Show Repo's and Assigned Servers");
        } else {
          $(this).text("Hide Repo's and Assigned Servers");
        }
      });

      $('#server_name').select2();

      $('#select_template').select2();

      $('#select_template_servers').select2({
        placeholder: "Select Server"
      });
    });
  </script>
</body>
</html>