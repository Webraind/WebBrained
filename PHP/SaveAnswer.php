<?php
session_start();
 $qid = $_POST['qid'];
 $user = $_SESSION['username'];
 $attempts = $_POST['attempts'];
 $result = $_POST['result'];
 if($_POST['result'] == 'skip') {
 $score = 'NULL';
 } else
 {
  $score = $_POST['score'];
  $score = intval($score); 
 }
 $skip = $_POST['skip'];
 $qid = intval($qid);
 $attempts = intval($attempts);
 /*$score = intval($score); 
 $test = $qid +1;*/
//echo "QID: $qid";
//echo "TEST: $test";
  //db connect
 $db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Error: ".mysqli_error($db_connection));
 //echo $skip;
  function cleanup($db_connection,$qid,$user)
  {
    $delete = "DELETE from ANSWER where QID =$qid  and user = '$user'";
    $delete_result = $db_connection->query($delete) or die('ERROR:'.mysqli_error($db_connection));
		    if($delete_result)
    			{
    			return 'clear';
    			}
   }
   
   function insertResult($db_connection,$qid,$user,$attempts,$result,$score)
   {	
   			$insert = "INSERT into ANSWER (qid,user,attempts,result,score) VALUES($qid,'$user',$attempts,'$result',$score)";
   			$insert_result = $db_connection->query($insert) or die("Error:.".mysqli_error($db_connection));
            return $insert_result;
   }

 if($skip == 'true')
 {
  
  $status = cleanup($db_connection,$qid,$user);
   if($status == 'clear') 
  	 {
    	 $insert_query = insertResult($db_connection,$qid,$user,$attempts,$result,$score);
   		}
 
  }
  else
  {
 	
 	//Insert Statement
   $insert_query = insertResult($db_connection,$qid,$user,$attempts,$result,$score);
  
  }
if($insert_query)
 {
 echo "true";
 }
 else
 {
 echo "false";
 }
?>