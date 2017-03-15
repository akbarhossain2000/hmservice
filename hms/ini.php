<?php
$host="localhost";
$user="root";
$pass="";
$db="home_services";

$conn = mysql_connect($host, $user, $pass) or die("Connection Failed!");
mysql_select_db($db, $conn) or die("Database couldn't select!");
?>