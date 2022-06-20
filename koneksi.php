<?php
$hostname = "localhost";
$database = "api";
$user = "root";
$pass = "";

$connect = mysqli_connect($hostname, $user, $pass, $database);

//script cek koneksi

if(!$connect){
    die("Koneksi Tidak Berhasil: " .mysqli_connect_error());
}