<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "f01";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("Failed to Connect!");
}
?>