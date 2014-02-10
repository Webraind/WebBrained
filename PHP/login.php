<?php
session_start();
//echo var_dump($_POST);
$userHandle = $_POST['userHandle'];//"mragen";
$password = md5($_POST['password']);//"abc123";//md5("abc123");
//echo "UserHANDLE". $userHandle;
//echo "Password".$password;
//Connceting to database
$db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Error: ".mysqli_error($db_connection));
// Query Statement for authentication
$queryStmt = "SELECT * from USER where userHandle='$userHandle' && PASSWORD='$password'" or die("Error: ".mysqli_error($db_connection) );
//Query Execution

$result = $db_connection->query($queryStmt) or die("Error: Cannot execute");

$row = $result->fetch_array(); //or die("Error: Cannot fetch array");
/*DEBUG: foreach ( $row as $i)
{
echo $i."<br/>";
}
echo $row['userHandle'];*/
$num_of_rows = $result->num_rows;
//echo $num_of_rows;
//Authentication
$newURL = "profile.php";
if($num_of_rows >= 1)
{

 //header('Location: '.$newURL);
 echo 'true';
 $_SESSION['username']=$row['userHandle'];
 //setcookie("userHandle", $_SESSION['username'], time()+3600);
 //echo "SESSION NAME:".$_SESSION['username'];

}
else{

//session_destroy();
//header("Location: ../index.php?msg=Invalid%20Login");
echo 'false';
}

$result->free();
$db_connection->close();




/*
echo mysqli_num_rows(mysqli_query(mysqli_connect('localhost','root','admin','webraind'),"SELECT * from user WHERE firstName='Mragendra'"));
1
php > echo mysqli_num_rows(mysqli_query(mysqli_connect('localhost','root','admin','webraind'),"SELECT * from user"));
*/
?>

