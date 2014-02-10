<?php
session_start();
//echo var_dump($_POST);
 $question = $_POST['question'];
 $ch1 = $_POST['CH_1'];
 $ch2 = $_POST['CH_2'];
 $ch3 = $_POST['CH_3'];
 $ch4 = $_POST['CH_4'];
 $answer = $_POST['answer'];
 $topic = $_POST['topic'];
 $source = $_POST['source'];
 $username = $_SESSION['username'];
 //db connect
 $db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Error: ".mysqli_error($db_connection));
 //Insert Statement
 $insert_stmt ="INSERT into MCQ (question,ch_1,ch_2,ch_3,ch_4,answer,topic,user,source) VALUES('$question','$ch1','$ch2','$ch3','$ch4','$answer','$topic','$username','$source')";
 
 $insert_result = $db_connection->query($insert_stmt) or die("Error:.".mysqli_error($db_connection));
 
 if($insert_result)
 {
 echo 'true';
 }
 else
 {
 echo 'false';
 }
 ?>