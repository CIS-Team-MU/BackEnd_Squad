<?php
session_start();
if(isset($_SESSION['user']))
{
	header("location:chat.html");
}
elseif(isset($_POST['login']))
{
    if($_POST['username']!==null)
    {
    if(strlen($_POST['username'])<6)
    {
    echo "sorry this name is small enter another one"."<br>";
    include_once"index.html";
    }
    else
    {
        $_SESSION['username']=$_POST['username'];
        if(file_exists("userfile/".$_SESSION['username']))
        {
          $get=file_get_contents("userfile/".$_SESSION['username']);
          $finaldata=json_decode($get);
          echo "<pre>";
          print_r($finaldata);
          echo "</pre>";
          echo "<h1>going for groupchating</h1>"."<br>";
          echo "<a href=chat.html>go chating</a>"; 
        }
        else
        {
          echo "sory you dont have an account"."<br>";
          echo "<a href='register.html'>create account</a>";
          echo "<br />";
          echo "<a href=out.php>out</a>";
        }
    }
    }
    else
    {
      echo "sorry enter your username"."<br>";
      include_once'register.html';
    }
}
elseif(isset($_POST['register']))
{
	if($_POST['name']&&$_POST['username']!=null)
	{
	   if(filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT)==FALSE)
	   {
	      echo "sorry inter valid phone number"."<br>";
	      include_once"register.html";
	   }
	   else
	   {
         $_SESSION['username']=$_POST['username'];
         $_SESSION['name']=$_POST['name'];
         $_SESSION['phone']=$_POST['phone'];
         $_SESSION['Email']=$_POST['Email'];
         if(file_exists("userfile/".$_SESSION['username']))
         {
	       echo "sorry you aready have account so login:[".$_SESSION['Email']."]"."<br>";	
	       include_once "index.html";
         }
         else
         {
	       $data=array(
	       "username"=>$_SESSION['username'],
	       "name"=>$_SESSION['name'],
	       "phone"=>$_SESSION['phone'],
	       "Email"=>$_SESSION['Email']);
	       $json_data=json_encode($data);
	       $put=file_put_contents("userfile/".$_SESSION['username'],$json_data);
	       $get=file_get_contents("userfile/".$_SESSION['username']);
	       $finaldata=json_decode($get);
	       echo "<pre>";
	       print_r($finaldata);
	       echo "</pre>";
	       echo "<h1>going for groupchating</h1>"."<br>";
           echo "<a href=chat.html>go chating</a>";
           echo "<br />";
echo "<a href=out.php>out</a>";
	     }
	   }	
    }
    else
    {
    	echo "sorry full this field"."<br>";
    	include_once'register.html';
    }
}
else
{
	include_once'index.html';
}