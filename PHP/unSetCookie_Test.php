<?php

$url = $_GET['url'];
$option = $_GET['option'];

setcookie("URL",NULL,time()+3600);
//var_dump($_POST);
//setcookie("URL",NULL,time()+3600);
//header("location: ./AnswerQuestion.php");
if ($option == 'randomize')
		{
//echo $url;
			header("location: ./AnswerQuestion.php");
		} else
		{
			header("location: ".$url);
		}	
?>
