<?php

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_TABLE = "luoghi";

$db = mysqli_conn($DB_HOST,$DB_USER,$DB_PASS,$DB_TABLE);

if(!$db){
    die('errore di connessione').mysqli_exeption_error();
}




?>