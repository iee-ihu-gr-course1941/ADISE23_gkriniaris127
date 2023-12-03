<?php

$host = 'localhost';
$db = 'game';
require_once "db_upass.php";

$user =$DB_USER;
$pass =$DB_PASS;

if(gethostname() == "users.iee.ihu.gr") {
    $mysqli = new mysqli($host, $user, $pass, $db, null , '/home/student/it/2017/it175127/mysql/run/mysql.sock');
} else {
    
    $mysqli = new mysqli($host, $user, $pass, $db, );
    
}

if($mysqli->connect_error) {
    echo "Failed to connect to MySQL: (" .
    $mysqli-> connect_error .") ". $mysqli->connect_error;
}

?>