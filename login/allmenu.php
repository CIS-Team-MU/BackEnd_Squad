<?php
session_start();
require_once('../include/model.php');
require_once('../include/control.php');
$id=0;
$update=false;
$name="";
$price="";
$content="";
$type="";
if(isset($_POST['save']))
{

        $name=$_POST['name'];
        $price=$_POST['price'];
        $content=$_POST['content'];
        $type=$_POST['type'];
        $stuffid=$_SESSION['chefsession'];
        $file=$_FILES["file"];
        $up=move_uploaded_file($file['tmp_name'],"../front/images/".$file["name"]);
        $folder="front/images/".$file['name'];
        if($_POST['name']==NULL)
        {
            echo "sorry enter your food name";
            include_once'addmenu.php';
        }
        elseif($_POST['price']==NULL)
        {
            echo "sorry enter food price";
            include_once'addmenu.php';
        }
        elseif($_POST['content']==NULL)
        {
            echo "sorry enter food content";
            include_once'addmenu.php';
        }
        elseif($_POST['type']==NULL)
        {
            echo "sorry enter food type";
            include_once'addmenu.php';
        }
        else
        {
            $selectobject= new model;
            $loginQuesryRes = $selectobject->selectQuery("menu","*","name='$name'");
            if($loginQuesryRes==false)
            {
                $insert=new model;
                $query=$insert->insertQuery("menu","name,price,content,img,type,stuffid",
                "'$name','$price','$content','$folder','$type',$stuffid");
                if($query)
                {
					$_SESSION['massage']="this record has been saved";
	                $_SESSION['mas_type']="success";
                    header("location:addmenu.php");
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
                include_once('addmenu.php');
            }
        }
}
elseif(isset($_GET['delete']))
{
	$id=$_GET['delete'];
	$selectobject= new model;
	$QuesryRes = $selectobject->deleteQuery("menu","id=$id");
	if($QuesryRes)
	{
		$_SESSION['massage']="this record has been delete";
	    $_SESSION['mas_type']="danger";
		header("location:addmenu.php");
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
	$QuesryRes = $selectobject->selectQuery("menu","*","id=$id");
	$data=mysqli_fetch_array($QuesryRes);
	if($data['id']==$id)
	{
		$name=$data['name'];
        $price=$data['price'];
        $content=$data['content'];
        $type=$data['type'];
		$img=$data['img'];
	}
}
elseif(isset($_POST['update']))
{
	$id=$_POST['id'];
	$name=$_POST['name'];
    $price=$_POST['price'];
    $content=$_POST['content'];
    $type=$_POST['type'];
	$selectobject= new model;
	$QuesryRes = $selectobject->selectQuery("menu","img","id=$id");
	$data=mysqli_fetch_array($QuesryRes);
	$img=$data['img'];
	$object= new model;
	$QuesryRes = $object->updateQuery("menu","name='$name',price='$price',content='$content',img='$img' ,type='$type'","id=$id");
	$_SESSION['massage']="this record has been update";
	$_SESSION['mas_type']="warning";
	header("location:addmenu.php");
}