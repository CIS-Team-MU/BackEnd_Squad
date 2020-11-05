<?php
session_start();
require_once('include/config.php');
$objConfig = new config;
$strQuery = "SELECT * FROM gallary";
$query = mysqli_query($objConfig->mySQLLink,$strQuery);
include_once('front/gallery.html');