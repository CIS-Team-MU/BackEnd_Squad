<?php
session_start();
require_once('include/config.php');
$objConfig = new config;
$strQuery = "SELECT * FROM menu WHERE type='drinks'";
$queryRes = mysqli_query($objConfig->mySQLLink,$strQuery);
$strQuery = "SELECT * FROM menu WHERE type='lunch'";
$query = mysqli_query($objConfig->mySQLLink,$strQuery);
$strQuery = "SELECT * FROM menu WHERE type='dinner'";
$Res = mysqli_query($objConfig->mySQLLink,$strQuery);
include_once('front/menu.html');