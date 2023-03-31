<?php 

session_start();


define('SITEURL','http://localhost/foodx/');
$server='localhost';
$user='root';
$pass='';
$dbname='foodx';

// Establishing connection
$conn=mysqli_connect($server,$user,$pass) or die(" ERROR: ".mysqli_error($conn)) ;
$db_select=mysqli_select_db($conn,$dbname) or die(" ERROR: ".mysqli_error($conn)) ;

?>