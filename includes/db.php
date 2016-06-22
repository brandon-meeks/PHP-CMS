<?php

$database = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db_name' => 'cms'
];

$connection = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['db_name']);

//if($connection) {
//    echo "db is connected";
//}

?>