<?php

$url = $_GET['url'];
//$url = "http://bullshit.com"; 

setcookie("URL",$url,time()+3600);
//var_dump($_POST);
//setcookie("URL",NULL,time()+3600);
//header("location: ./AnswerQuestion.php");
if ($url)
{
//echo $url;
header("location: ./AnswerQuestion.php");
}
?>
