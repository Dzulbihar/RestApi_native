<?php
$username ="DASHBOARDGRAFIK";
$password ="123456";
$database ="LOCALHOST/orcl";
$connect=oci_connect ($username,$password,$database);
if(!$connect) {
	$err=oci_error();
	echo "Gagal tersambung ke ORACLE", $err['text'];
} 



// $username ="TRUKING";
// $password ="truking2022";
// $database ="10.130.0.238:1521/dbtes";
// $connect=oci_connect ($username,$password,$database);
// if(!$connect) {
// 	$err=oci_error();
// 	echo "Gagal tersambung ke ORACLE", $err['text'];
// } 