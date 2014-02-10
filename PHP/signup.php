<?php
session_start();
//Declaration and Assignment of the variable.
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName']; 
$email = $_POST['email'];
$userHandle = $_POST['userHandle'];
$password = md5($_POST['password']);
$gender = $_POST['gender'];

// connecting to the database
 $db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Error: ".mysqli_error($db_connection));
 // Sql statemnt to check.
 $queryStmt = "SELECT * from USER where USERHANDLE='$userHandle' || EMAIL='$email'" or die("Error: ".mysqli_error($db_connection) );
 // Insert Statement
 $insertStmt = "INSERT into USER (firstName,lastName,email,userHandle,password,gender) VALUES('$firstName','$lastName','$email','$userHandle','$password','$gender')";
 //Query Execution
 $result = $db_connection->query($queryStmt) or die("Error: Cannot execute");
 $row = $result->fetch_array();
 $num_of_rows = $result->num_rows;
 $goahead;
 if($num_of_rows >=1)
 {
    if($row['userHandle'] == $userHandle && $row['email'] != $email )
                         {
    				echo 'userHandle exists';
                            }
    else if($row['email'] == $email && $row['userHandle'] != $userHandle){
  							echo 'email exists';
  							}
  	else if($row['email'] == $email && $row['userHandle'])
  	                       {
  	                        
  	                        echo "email and userHandle exits";
  	                       }	
  	              else{
  	                     echo "Must be a mistake";
  	               }         				
 } else{
      $insert_result = $db_connection->query($insertStmt);// or die('false');
 	if($insert_result)
  		{ 
  		echo 'true';
  		 $_SESSION['username'] = $userHandle;
  			}
  	else
 			 {
 			 echo 'Signup failed';
  				}
// $insert_result->free();
 
 }
 
 
 $result->free();
 $db_connection->close();

?>