<?php

$server = "localhost";
$host = "root";
$password = "";
$database = "bukutamu";

$koneksi = mysqli_connect($server, $host, $password, $database) or die(mysqli_error($koneksi));
