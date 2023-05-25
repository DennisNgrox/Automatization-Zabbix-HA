<?php
$mysql = "/bin/mysql";
$host = 'localhost';
$user = 'root'; // Edit user
$password = 'PASSWORD'; // Edit password
$query = "SHOW REPLICA STATUS";

if (isset($argv[1])){
    $master=$argv[1];
}else{
    $master="check";
}

function set_weight($Slave_IO_Running,$Slave_SQL_Running,$Seconds_Behind_Master,$master){
    switch ($master){
        case "node01":
            return "up\n";
        break;

        case "node02":
            return "down\n";
        break;

        default:
            if (($Slave_IO_Running == 'Yes' && $Slave_SQL_Running == 'Yes' && $Seconds_Behind_Master < 10)||($Slave_IO_Running == 'Connecting' && $Slave_SQL_Running == 'Yes')){
                return "up\n";
            }else{
                return "down\n";
            }
        break;
    }
}
set_time_limit(0);
$socket = stream_socket_server("tcp://0.0.0.0:1234", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)\n";
} else {
    while ($conn = stream_socket_accept($socket,9999999999999)) {
        $cmd = "$mysql -h$host -u$user -p$password -Ee \"$query\" 2> /dev/null";
        exec("$cmd",$my_datas);

        $Slave_IO_Running = preg_grep('/Replica_IO_Running:/',$my_datas);
        $Slave_IO_Running = each($Slave_IO_Running);
        $Slave_IO_Running = trim(substr($Slave_IO_Running["value"],strpos($Slave_IO_Running["value"],":")+1));

        $Slave_SQL_Running = preg_grep('/Replica_SQL_Running:/',$my_datas);
        $Slave_SQL_Running = each($Slave_SQL_Running);
        $Slave_SQL_Running = trim(substr($Slave_SQL_Running["value"],strpos($Slave_SQL_Running["value"],":")+1));

        $Seconds_Behind_Master = preg_grep('/Seconds_Behind_Source:/',$my_datas);
        $Seconds_Behind_Master = each($Seconds_Behind_Master);
        $Seconds_Behind_Master = trim(substr($Seconds_Behind_Master["value"],strpos($Seconds_Behind_Master["value"],":")+1));

        $weight = set_weight($Slave_IO_Running,$Slave_SQL_Running,$Seconds_Behind_Master,$master);
        unset($my_datas);
        fputs ($conn, $weight);
        fclose ($conn);
    }
    fclose($socket);
}
?>
