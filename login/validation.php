<?php
session_start();
require_once('../include/model.php');
require_once('../include/control.php');
$objectcontrol=new control;
if(isset($_POST['login']))
{
    $choose=$_POST['choose'];
    if($_POST['choose']=="admin")
    {
        if(isset($_SESSION['adminsession']))
        {
            header("location:navbar.php");
            exit;
        }
        else
        {
            $_SESSION['adminname']=$_POST['name'];
            $_SESSION['adminpassword']=$_POST['password'];
            $name=$_POST['name'];
            $password=$_POST['password'];
            list($bool,$msg)=$objectcontrol->validateadminLogin($name,$password,$choose);
            if($bool==false)
            {
                echo $msg;
            }
            else
            {
                $loginRes = $msg;
                $loginData = mysqli_fetch_array($loginRes);
                $_SESSION['adminsession'] = $loginData['id'];
                header("location:navbar.html");
                exit;
            }
        }
    } 
    elseif($_POST['choose']=="chef")
    {
        if(isset($_SESSION['chefsession']))
        {
            header("location:navbar2.php");
            exit;
        }
        else
        {
            $_SESSION['chefname']=$_POST['name'];
            $_SESSION['chefpassword']=$_POST['password'];
            $name=$_POST['name'];
            $password=$_POST['password'];
            list($bool,$msg)=$objectcontrol->validatechefLogin($name,$password,$choose);
            if($bool==false)
            {
                echo $msg;
            }
            else
            {
                $loginRes = $msg;
                $loginData = mysqli_fetch_array($loginRes);
                $_SESSION['chefsession'] = $loginData['id'];
                header("location:navbar2.html");
                exit;
            }
        }
    } 
    elseif($_POST['choose']=="client")
    {
        if(isset($_SESSION['clientsession']))
        {
            header("location:../index.php");
            exit;
        }
        else
        {
            $_SESSION['clientname']=$_POST['name'];
            $_SESSION['clientpassword']=$_POST['password'];
            $name=$_POST['name'];
            $password=$_POST['password'];
            list($bool,$msg)=$objectcontrol->validateclientLogin($name,$password,$choose);
            if($bool==false)
            {
                echo $msg;
            }
            else
            {
                $loginRes = $msg;
                $loginData = mysqli_fetch_array($loginRes);
                $_SESSION['clientsession'] = $loginData['id'];
                header("location:../index.php");
                exit;
            }
        }
    } 

}
elseif(isset($_POST['register']))
{
    if($_POST['choose']=="client")
    {
        $choose=$_POST['choose'];
        $_SESSION['clientname']=$_POST['name'];
        $_SESSION['clientpassword']=$_POST['password'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        list($bool,$msg)=$objectcontrol->validateclientregister($name,$password,$choose);
            if($bool==false)
            {
                echo $msg;
            }
            else
            {
                $objModel = new model;
                $regQuesryRes = $objModel->insertQuery("client","username , password","'$name','$password'");
                if($regQuesryRes)
                {
                    echo "your account is created so login";
                    include_once('index.html');
                }
                else
                {
                    echo mysqli_error();
                }
            }
    } 
}
else
{
    header("location:../index.php");
}