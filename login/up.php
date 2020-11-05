<?php
session_start();
require_once('../include/model.php');
require_once('../include/control.php');
$id=0;
$update=false;
$name="";
if(isset($_POST['save']))
{

        $name=$_POST['name'];
        $adminid=$_SESSION['adminsession'];
        $file=$_FILES["file"];
        $up=move_uploaded_file($file['tmp_name'],"../front/images/".$file["name"]);
        $folder="front/images/".$file['name'];
        if($_POST['name']==NULL)
        {
            echo "sorry enter your img name";
            include_once'gallary.php';
        }
        else
        {
            $selectobject= new model;
            $loginQuesryRes = $selectobject->selectQuery("gallary","*","name='$name'");
            if($loginQuesryRes==false)
            {
                $insert=new model;
                $query=$insert->insertQuery("gallary","name,img,adminid",
                "'$name','$folder',$adminid");
                if($query)
                {
					$_SESSION['massage']="this record has been saved";
	                $_SESSION['mas_type']="success";
                    header("location:gallary.php");
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
                include_once('gallary.php');
            }
        }
}
elseif(isset($_GET['delete']))
{
	$id=$_GET['delete'];
	$selectobject= new model;
	$QuesryRes = $selectobject->deleteQuery("gallary","id=$id");
	if($QuesryRes)
	{
		$_SESSION['massage']="this record has been delete";
	    $_SESSION['mas_type']="danger";
		header("location:gallary.php");
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
	$QuesryRes = $selectobject->selectQuery("gallary","*","id=$id");
	$data=mysqli_fetch_array($QuesryRes);
	if($data['id']==$id)
	{
		$name=$data['name'];
		$img=$data['img'];
	}
}
elseif(isset($_POST['update']))
{
	$id=$_POST['id'];
	$name=$_POST['name'];
	$selectobject= new model;
	$QuesryRes = $selectobject->selectQuery("gallary","img","id=$id");
	$data=mysqli_fetch_array($QuesryRes);
	$img=$data['img'];
	$object= new model;
	$QuesryRes = $object->updateQuery("gallary","name='$name',img='$img'","id=$id");
	$_SESSION['massage']="this record has been update";
	$_SESSION['mas_type']="warning";
	header("location:gallary.php");
}