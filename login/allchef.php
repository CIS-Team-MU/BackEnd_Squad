<?php
session_start();
require_once('../include/model.php');
require_once('../include/control.php');
$id=0;
$update=false;
$name="";
$password="";
if(isset($_POST['save']))
{
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $name=$_POST['name'];
        $password=$_POST['password'];
        $adminid=$_SESSION['adminsession'];
        $file=$_FILES["file"];
        $up=move_uploaded_file($file['tmp_name'],"../front/images/".$file["name"]);
        $folder="front/images/".$file['name'];
        if($_POST['name']==NULL)
        {
            echo "sorry enter your chef name";
            include_once'addchef.html';
        }
        elseif($_POST['password']==NULL)
        {
            echo "sorry enter chef password";
            include_once'addchef.html';
        }
        else
        {
            $selectobject= new model;
            $loginQuesryRes = $selectobject->selectQuery("stuff","*","name='$name'");
            if($loginQuesryRes==false)
            {
                $insert=new model;
                $query=$insert->insertQuery("stuff","name,password,img,adminid",
                "'$name','$password','$folder',$adminid");
                if($query)
                {
					$_SESSION['massage']="this record has been saved";
	                $_SESSION['mas_type']="success";
                    header("location:addchef.php");
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
                header("location:addchef.php");
            }
        }
    }
    else
    {
        echo "invalid way to save data";
        include_once('navbar.html');
	}
}
elseif(isset($_GET['delete']))
{
	$id=$_GET['delete'];
	$selectobject= new model;
	$QuesryRes = $selectobject->deleteQuery("stuff","id=$id");
	if($QuesryRes)
	{
		$_SESSION['massage']="this record has been delete";
	    $_SESSION['mas_type']="danger";
		header("location:addchef.php");
	}
	else
	{
		echo mysqli_error();
	}
}
elseif(isset($_GET['edit']))
{
	$id=$_GET['edit'];
	$update=true;
	$selectobject= new model;
	$QuesryRes = $selectobject->selectQuery("stuff","*","id=$id");
	$data=mysqli_fetch_array($QuesryRes);
	if($data['id']==$id)
	{
		$name=$data['name'];
		$password=$data['password'];
		$img=$data['img'];
	}
}
elseif(isset($_POST['update']))
{
	$id=$_POST['id'];
	$name=$_POST['name'];
	$password=$_POST['password'];
	$selectobject= new model;
	$QuesryRes = $selectobject->selectQuery("stuff","img","id=$id");
	$data=mysqli_fetch_array($QuesryRes);
	$img=$data['img'];
	$object= new model;
	$QuesryRes = $object->updateQuery("stuff","name='$name' ,password='$password' ,img='$img'","id=$id");
	$_SESSION['massage']="this record has been update";
	$_SESSION['mas_type']="warning";
	header("location:addchef.php");
}