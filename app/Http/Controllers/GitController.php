<?php

namespace App\Http\Controllers;

use App\Git;
use App\PullLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repos = Git::all();
        $logs = PullLog::all();
        return view('gitautopull', ["repos" => $repos, "logs" => $logs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'repo_url' => ['bail', 'required', 'url', 'max:255'],
            'repo_branch' => ['bail', 'required', 'alpha', 'max:255'],
            'prefix' => ['bail', 'max:255'],
            'secret_token' => ['bail', 'required', 'max:255'],
            'server_name' => ['bail', 'required', 'max:255'],
            'server_path' => ['bail', 'required', 'regex:/[^\/]$/', 'max:255'],
        ]);

        Git::create($validated_data);

        return redirect()->back()->with("message", "Repo added successfully!");
    }

    public function store_ip(Request $request)
    {
        $validated_data = $request->validate([
            'add_white_list_ip' => ['bail', 'required', 'ip', 'max:255'],
        ]);

        $ip_file = fopen('../common_files/whitelist.txt', 'a');
        fwrite($ip_file, $validated_data['add_white_list_ip'] . "\n");
        fclose($ip_file);

        return redirect()->back()->with("message", "Ip Address added successfully!");
    }

    public function destroy_ip(Request $request)
    {
        $validated_data = $request->validate([
            'select_ip' => ['bail', 'required', 'ip', 'max:255'],
        ]);

        $contents = file_get_contents('../common_files/whitelist.txt');
        $contents = str_replace($validated_data['select_ip']."\n", '', $contents);
        file_put_contents('../common_files/whitelist.txt', $contents);

        return redirect()->back()->with("message", "Ip Address deleted successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($repo)
    {
        Git::where('id', $repo)->delete();

        return redirect()->back()->with('message', 'Repo deleted successfully!');
    }




    public function hook()
    {
        function readFileData($path){
            if(file_exists($path) == 1){
                $file = fopen($path, 'r');
                $data=[];
                while (($line = fgets($file, 4096)) !== false) {
                    $data[] = $line;
                }
                if (!feof($file)) {
                    $error = "Error: unexpected fgets() fail\n";
                }
                fclose($file);
                return $data;
            }else{
                return false;
            }
        }

        function removeLines($file){
            if(!empty($file)){
                foreach($file as $index => $line){
                    $file[$index] = str_replace("\n","",$file[$index]);
                }
            }
            return $file;
        }

        $method = $_SERVER['REQUEST_METHOD'];
        header("Content-Type:application/json");
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        $xGitlabEvent = isset($_SERVER["HTTP_X_GITLAB_EVENT"]) ? trim($_SERVER["HTTP_X_GITLAB_EVENT"]) : '';
        $secret_token_requested = isset($_SERVER["HTTP_X_GITLAB_TOKEN"]) ? trim($_SERVER["HTTP_X_GITLAB_TOKEN"]) : '';
        $request_from_ip = isset($_SERVER['REMOTE_ADDR']) ? trim($_SERVER['REMOTE_ADDR']) : '';
        $data = json_decode(trim(file_get_contents('php://input')), true);
        extract($data);
        $ref = explode("/", $ref);
        $repo_ssh = $project['git_ssh_url'];
        $branch = $ref[2];
        $commit = explode(":",$commits[0]['message']);
        $prefix = $commit[0];

        $data = readFileData('../common_files/whitelist.txt');
        $my_whitelist_ips = removeLines($data);

        $servers_array = Git::all();

        $by_repo_filtered = [];
        $by_branch_filtered = [];
        $by_prefix_filtered = [];
        if($servers_array){
            foreach ($servers_array as $key => $value) {
                if ($value['repo_url'] == $repo_ssh) {
                    $by_repo_filtered[] = $value;
                }
            }
        }
        if($by_repo_filtered){
            foreach ($by_repo_filtered as $key => $value) {
                if ($value['repo_branch'] == $branch) {
                    $by_branch_filtered[] = $value;
                }
            }
        }
        $server_names = [];
        if($by_branch_filtered){
            foreach ($by_branch_filtered as $key => $value) {
                if ($value['prefix'] == $prefix) {
                    $by_prefix_filtered[] = $value;
                    $server_names[] = $value['server_name'];
                }
            }
        }
        $server_names_string = implode(",",$server_names);

        if (!empty($by_repo_filtered)) {
            if (!empty($by_branch_filtered)) {
                if (!empty($by_prefix_filtered)) {
                    if($method == "POST"){
                        if($contentType == "application/json"){
                            if($xGitlabEvent == "Push Hook"){
                                if (in_array($request_from_ip, $my_whitelist_ips)){

                                    foreach ($by_prefix_filtered as $key => $value) {
                                        $value = json_decode($value, true);
                                        extract($value);
                                        if($secret_token_requested == $secret_token){
                                            $command = "sudo bash ../bashscripts/gitautopull.sh ".$server_name." ".$server_path;
                                            passthru($command);
                                            $status = readFileData('../common_files/gitautopull_status.txt');
                                            $status = removeLines($status);

                                            if($status[0] == "ok" || $status[0] == "OK"){
                                                DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_name, $repo_url, $branch, $prefix, 'Pull Success', 'success', date('Y-m-d h:i:s')));
                                            }else{
                                                DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_name, $repo_url, $branch, $prefix, 'Error in executing bashscript!', 'failed', date('Y-m-d h:i:s')));
                                            }
                                        }else{
                                            DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_names_string, $repo_ssh, $branch, $prefix, 'Incorrect token!', 'failed', date('Y-m-d h:i:s')));
                                        }
                                    }

                                }else{
                                    DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_names_string, $repo_ssh, $branch, $prefix, $request_from_ip.' (Unidentified IP Address!)', 'failed', date('Y-m-d h:i:s')));
                                }
                            }else{
                                DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_names_string, $repo_ssh, $branch, $prefix, 'Invalid x-gitlab-event ('.$xGitlabEvent.')!', 'failed', date('Y-m-d h:i:s')));
                            }
                        }else{
                            DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_names_string, $repo_ssh, $branch, $prefix, 'Invalid content-type ('.$contentType.')', 'failed', date('Y-m-d h:i:s')));
                        }
                    }else{
                        DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array($server_names_string, $repo_ssh, $branch, $prefix, 'Please Use POST Method', 'failed', date('Y-m-d h:i:s')));
                    }
                }else{
                    DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array('No Server found', $repo_ssh, $branch, $prefix, 'No server found for this Prefix!', '0', date('Y-m-d h:i:s')));
                }
            }else{
                DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array('No Server found', $repo_ssh, $branch, $prefix, 'No server found for this Branch!', '0', date('Y-m-d h:i:s')));
            }
        }else{
            DB::insert("insert into pull_logs(server, repo, branch, prefix, log, status, date_time) values(?, ?, ?, ?, ?, ?, ?)", array('No Server found', $repo_ssh, $branch, $prefix, 'No server found for this Repo!', '0', date('Y-m-d h:i:s')));
        }
    }
}
