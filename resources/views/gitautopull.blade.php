@extends('layouts.main')

@section('content')
  <div class="container-fluid py-3">
    @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card mb-3">
      <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center">
          <h5 class="m-sm-0 text-info font-weight-bold git_auto_pull_page_heading">Integrate Repo With New Servers</h5>

          <div>
            <form method="POST" action="/delete-ip" class="form-inline d-sm-inline">
              @csrf

              <select class="form-control form-control-sm mr-1 mb-2 mb-sm-0" name="select_ip" id="select_ip">
                <option value="">Select IP</option>

                <?php
                  $ip_data = [];
                  $ip_file = fopen('../common_files/whitelist.txt', 'r');
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

              <button class="btn btn-sm btn-danger mr-2 mb-2 mb-sm-0" id="delete_ip_btn">Delete IP</button>
            </form>

            <form method="POST" action="/add-ip" class="form-inline d-sm-inline">
              @csrf

              <input type="text" class="form-control form-control-sm mr-1" name="add_white_list_ip" id="add_white_list_ip" placeholder="Add white list IP">

              <button class="btn btn-sm btn-success" id="add_ip_btn">Add IP</button>
            </form>
          </div>
        </div>
      </div>

      <div class="card-body">
        <form action="/git-repos" method="POST">
          @csrf

          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="repo_url">Repo Url</label>
                  <input type="text" class="form-control" name="repo_url" id="repo_url" placeholder="Repo Url">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="repo_branch">Repo Branch</label>
                  <input type="text" class="form-control" name="repo_branch" id="repo_branch" placeholder="Branch Name">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="prefix">Prefix</label>
                  <input type="text" class="form-control" name="prefix" id="prefix" placeholder="Prefix">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="secret_token">Secret Token</label>
                  <input type="text" class="form-control" name="secret_token" id="secret_token" placeholder="Secret Token">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="server_name">Server Name</label>
                  <select name="server_name" id="server_name" class="w-100">
                    <option value="">Select Server</option>

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
                        $extracted_server_names[] = $exploded_server_names[0];
                      }
                    ?>

                    @foreach ($extracted_server_names as $extracted_server_name)
                      <option value="{{ $extracted_server_name }}">{{ $extracted_server_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="server_path">Server Path</label>
                  <input type="text" class="form-control" name="server_path" id="server_path" placeholder="Server Path">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 text-right">
                  <button class="btn btn-primary btn-sm px-4">Add</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
        <h5 class="m-0 text-info font-weight-bold git_auto_pull_page_heading" id="repo_heading">Hide Repo's and Assigned Servers</h5>
      </div>

      <div class="card-body" id="repo_block">
        <table class="table table-striped table-bordered" style="width:100%" id="repo_records_table">
          <thead>
            <tr>
              <th>Sr. #</th>
              <th>Repo Url</th>
              <th>Server Name</th>
              <th>Server Path</th>
              <th>Branch</th>
              <th>Prefix</th>
              <th>Secret Token</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
              @foreach($repos as $repo)
                <tr>
                  <td>{{ $repo->id }}</td>
                  <td>{{ $repo->repo_url }}</td>
                  <td>{{ $repo->server_name }}</td>
                  <td>{{ $repo->server_path }}</td>
                  <td>{{ $repo->repo_branch }}</td>
                  <td>{{ $repo->prefix }}</td>
                  <td>{{ $repo->secret_token }}</td>
                  <td><a class="btn btn-sm btn-danger" href="{{ route('repos.destroy', ['repo' => $repo->id]) }}">Delete</a></td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h5 class="m-0 text-info font-weight-bold git_auto_pull_page_heading">Logs</h5>
      </div>

      <div class="card-body">
          <table class="table table-striped table-bordered" style="width:100%" id="logsTable">
            <thead>
              <tr>
                <th>Sr. #</th>
                <th>Server's</th>
                <th>Repo</th>
                <th>Branch</th>
                <th>Prefix</th>
                <th>Message</th>
                <th>Time</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($logs as $log)
                <tr>
                  <td>{{ $log->id }}</td>
                  <td>{{ $log->server }}</td>
                  <td>{{ $log->repo }}</td>
                  <td>{{ $log->branch }}</td>
                  <td>{{ $log->prefix }}</td>
                  <td>{{ $log->log }}</td>
                  <td>{{ $log->date_time }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
@endsection