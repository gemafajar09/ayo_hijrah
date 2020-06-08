<?php
$base_url = "http://localhost/ayo_hijrah/";
date_default_timezone_set('Asia/Jakarta');
$server = "localhost";
$user = "root";
// $password = "";
$password = "";
$database = "ayo_hijrah";

$con = mysqli_connect($server, $user, $password, $database) or die(mysqli_connect_error());
