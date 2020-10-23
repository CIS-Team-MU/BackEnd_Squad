<?php
session_start();
$file="massege.html";
if(isset($_POST['chat']))
{
	$_SESSION['massege']=$_POST['textarea'];
	$_SESSION['date']=date('h:i:s');
	$oldchat=file_get_contents($file);
	$newchat=$_SESSION['username']."is said :".$_SESSION['massege']." "."at".$_SESSION['date']."<br />".$oldchat;
	file_put_contents($file,$newchat);
	echo "<iframe src=$file> </iframe>";
}
else
{
	header("locatin:chat.html");
}
echo "<br />";
echo "<a href=out.php>out</a>";