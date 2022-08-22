<?php
date_default_timezone_set("UTC");
putenv("TZ=Africa/Cairo");

$con = mysqli_connect("localhost","root","","hospital");

// Check connection
if (mysqli_connect_errno())
  {
 header('location:500.php');
   }

mysqli_query($con,"SET NAMES utf8");

?>




<?php

function checkuserlogin(){
	if(isset($_COOKIE['user'] ) && !empty($_COOKIE['user']))
	    return $_COOKIE['user'];
	else
	    return false;
        }

?>




