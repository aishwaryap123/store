<?php
$servername="localhost";
$username="aishwaryap";
$password="password";
$dbname="aishwaryap_products";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connection failed :".$conn->connect_error);
}

?>