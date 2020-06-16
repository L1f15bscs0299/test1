<?php

function check_malicious($username,$ipaddress)
{
    $status=true;
    if (preg_match('/[\'^£$%&*()}{@#~?><>,;|=+¬-]/', $username)) {
        $status=false;
    }
    if (!filter_var($ipaddress,FILTER_VALIDATE_IP)) {
        $status=false;
    }

    return $status;
}

//filename to write username and ip addresses
$filename="/var/www/iptables/iptablesmanagerlaravel/remoteshell/data.txt";

$malicious_logs="/var/www/iptables/iptablesmanagerlaravel/remoteshell/malicious_logs.txt";

//filename to read shell info
$readFile=fopen("/var/www/iptables/iptablesmanagerlaravel/remoteshell/command.txt","r") or die ("unable to open file");
$strings=fread($readFile,filesize("/var/www/iptables/iptablesmanagerlaravel/remoteshell/command.txt"));

//if request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //if ipaddress and username variable are set
    if(isset($_GET['ipaddress']) && isset($_GET['username'])) {
        $username=$_GET['username'];
        $ipaddress=$_GET['ipaddress'];
        if (check_malicious($username,$ipaddress)) {
            //now replace the old request with latest request
            $command="sed -i '/".$username."/d' data.txt";
            shell_exec($command);

            //concatenate username and ipadderss and write them in data.txt
            $content=$_GET['username'].":".$_GET['ipaddress'].":".date("h-i-s")"\n";
            $file=fopen($filename,'a');
            fwrite($file,$content);
            fclose($file);
            $lines=file($filename);
            $lines=array_unique($lines);
            file_put_contents($filename,implode($lines));

            //if shell info is present or not
            if (filesize("/var/www/sh.pf.com.pk/command.txt") != '0' ) {
                $shell=explode("\n",$strings);

                //check if IP address of request matches with the one written in data.txt
                if ($_SERVER['REMOTE_ADDR'] == $shell[0] && $_GET['username'] == $shell[1] ) {
                    echo "Username:".$shell[1];
                    echo "\nPort:".$shell[2];
                }
                // 0 means invalid data or invalid request
                else echo "0";
            }
        }
        // 0 means invalid data or invalid request
        else
        {
            $file=fopen($malicious_logs,'a');
            $content=$_GET['username'].":".$_GET['ipaddress'].":".$_SERVER['REMOTE_ADDR']."\n";
            fwrite($file, $content);
            fclose($file);
            echo "0";
        }

    }
    else {
        // 0 means invalid data or invalid request
        echo "0";
    }
}
else {
    // 0 means invalid data or invalid request
    echo "0";
}