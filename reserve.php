<?php
session_start();
include_once('include/model.php');
require_once('include/control.php');
$objectcontrol=new control;
if(isset($_POST['save']))
{
    $name=$_POST['name'];
    $date_reserve=$_POST['date'];
    $time_reserve=$_POST['time'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $clientid=$_SESSION['clientsession'];
    list($bool,$msg)=$objectcontrol->validatereserve($date_reserve,$time_reserve,$name,$number,$email,$phone);
    if($bool==false)
    {
        echo $msg;
        include_once('reservation.php');
    }
    else
    {
        $insert=new model;
        $query=$insert->insertQuery("reservation","date_reserve,time_reserve,name,number,email,phone,clientid,adminid",
        "'$date_reserve','$time_reserve','$name','$number','$email','$phone',$clientid,1");
        if($query)
        {
            $_SESSION['massage']="your reservation is success";
            $_SESSION['mas_type']="success";
            header("location:reservation.php");
        }
        else
        {
            echo "false";
            echo mysqli_error();
        }
    }
}