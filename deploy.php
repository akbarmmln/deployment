<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $filename = "../../log/depyloy.log";
    $fh = fopen($filename, "a") or die("Could not open log file.");
    
    $ms = $_GET['ms'];
    if($ms == "ms-admin"){
        $LOCAL_ROOT = "/ms-admin";
        include('Net/SSH2.php'); 
        $ssh = new Net_SSH2('103.253.212.57', 2223);
        if (!$ssh->login('xxxxx', 'xxxxxxx')) {
            $data = "Login Failed";
            fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $data\n") or die("Could not write file");
            fclose($fh);
            exit('Login Failed');  
        }
        $stream_pre1 = $ssh->exec('rm -rf ms-admin');

        $stream_pre3 = $ssh->exec('git clone https://github.com/akbarmmln/ms-admin.git');
        echo $stream_pre3;
        fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $stream_pre3\n") or die("Could not write file");

        echo "<br>";

        $stream_pre4 = $ssh->exec('ls');
        echo $stream_pre4;
        fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $stream_pre4\n") or die("Could not write file");
        
        echo "<br>";

        $stream_pre5 = $ssh->exec('source /home/souh8667/nodevenv/ms-admin/10/bin/activate && cd /home/souh8667/ms-admin && npm install && npm cache clean --force');
        $stream_pre5 .= " done installing npm";
        echo $stream_pre5;
        fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $stream_pre5\n") or die("Could not write file");

        echo "<br>";

        $stream_pre6 = $ssh->exec('source /home/souh8667/nodevenv/ms-admin/10/bin/activate && cd /home/souh8667/ms-admin && touch tmp/restart.txt');
        $stream_pre6 .= "finish";
        echo $stream_pre6;
        fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $stream_pre6\n") or die("Could not write file");
    }else{
        $LOCAL_ROOT = "unknown(.$ms.)";
        $data = "process failed";
        fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $data\n") or die("Could not write file");
    }
    fclose($fh);
    
    // $connection = ssh2_connect('103.253.212.57', 2223);
    // ssh2_auth_password($connection, 'xxxxx', 'xxxxxxx');
    // $stream = ssh2_exec($connection, 'ls');
    // stream_set_blocking($stream, true);
    // $data_stream = "";
    // while ($buf = fread($stream,4096)) {
    //     $data_stream .= $buf;
    // }
    // echo $data_stream;
    // fwrite($fh, date("d-m-Y, H:i")." - $LOCAL_ROOT - $data_stream\n") or die("Could not write file");
?>