<?php
session_start();
require_once('include/model.php');
require_once('include/control.php');
$objectcontrol=new control;
if(isset($_POST['send']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $file=$_FILES["file"];
    $up=move_uploaded_file($file['tmp_name'],"front/images/".$file["name"]);
    $folder="front/images/".$file['name'];
    $comment=$_POST['text'];
    $clientid=$_SESSION['clientsession'];
    if($_POST['name']==NULL)
    {
        echo "sorry enter your name";
        include_once'content.php';
    }
    elseif($_POST['email']==NULL)
    {
        echo "sorry enter your email";
        include_once'content.php';
    }
    elseif($_POST['text']==NULL)
    {
        echo "sorry enter your comment";
        include_once'content.php';
    }
    else
    {
        $selectobject= new model;
        $loginQuesryRes = $selectobject->selectQuery("contact","*","email='$email' AND name='$name'");
        if($loginQuesryRes==false)
        {
            $insert=new model;
            $query=$insert->insertQuery("contact","name,email,comment,image,clientid",
            "'$name','$email','$comment','$folder',$clientid");
            if($query)
            {
                $_SESSION['massage']="your reservation is success";
                $_SESSION['mas_type']="success";
                header("location:contact.php");
            }
            else
            {
                echo "false";
                echo mysqli_error();
            }
        }
        else
        {
            echo "sorry this information is insert before";
            header('location:contact.php');
        }
    }
}