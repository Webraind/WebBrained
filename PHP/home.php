<?php
session_start();
if(isset($_SESSION['username'])){ //if statement
$userName = $_SESSION['username'];
 	if(isset($_COOKIE["URL"]))
   	{
   		header("location: ./AnswerQuestion.php");
  	 }
 	else{
//connecting to the database
$db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Error: ".mysqli_error($db_connection));
//querying the database
$queryStmt ="SELECT * from USER where userHandle='$userName'" or die("Error: ".mysqli_error($db_connection) );
//Query Execution

$result = $db_connection->query($queryStmt) or die("Error: Cannot execute");


$row = $result->fetch_array() or die("Error:".mysqli_error($db_connection));
		if($row['profilepic']!= null){
			$profilepic = 'data:image/jpeg;base64,'.base64_encode($row['profilepic']);
										}
		else{
			$defaultImage = "../Images/defaultprofilepic.jpg";
			$imgbinary = fread(fopen($defaultImage,"r"),filesize($defaultImage));
			$profilepic = 'data:image/jpeg;base64,'.base64_encode($imgbinary);
			}
/*DEBUG:if(isset($row)){
echo"Variable is set";
}*/

?>
<!DOCTYPE html>
<html>
	<head>
	
	<title><?php echo $row['firstName']." ".$row['lastName'] ?></title>
	<link rel= "stylesheet" type ="text/css"  href="../CSS/home.css"/>
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	     <script src="../JS/JQ/jquery-1.10.2.min.js"></script>
	    <script src="../JS/JQ/jquery-ui.min.js"></script>
	    <?php echo <<<VAR
	    <script type="text/javascript">
	    var firstName = '{$row['firstName']}';
	    var lastName = '{$row['lastName']}';
	    var email = '{$row['email']}';
	    var profilepic = '$profilepic';
	    </script>
VAR;
	    ?>
	    <script text ="text/javascript" src="../JS/home.js"></script>
	</head>
	<body>
	<div id="header">
	   <div class="container_16">
		<header class="container_16">
		<div class="grid_12 Logo alpha">
		 <p><img src="../Images/Webraind002.png"></p>
	   </div>
	   <div class="grid_4 welcome omega">
	   		<ul>
     	<?php
		echo "<li><a href=logout.php> Logout </a></li>";
		echo "<li>Welcome  <span> ".$row['firstName'].'</span>!</li>'; ?>
		 </ul>	
	    </div>
		</header>
		</div><!-- Div class Container 16 -->
	</div> <!-- Div id header-->	
	
	<div id="main">
		<div class="container_16">
		<header class="container_16">
		<div class = "grid_16 main_body">
		<div class="grid_3 left_col alpha"> <ul>
		<li><p id='img_p'><?php echo '<img src ='.$profilepic .' alt="image"></img>' ?></p></li>
		<li><p><?php echo '<a href = "#">'.$row['firstName'].' '.$row['lastName'].'</a>'; ?></p></li>
		<li><p><?php echo '<a href = "#"> edit profile</a>'; ?></p></li>
		</ul>
		</div> <!-- left_col-->
		<div class="grid_9 mid_col">
		   <ul> 
		   <li><button id="crtbt"><p><span>Create MCQ</span></p></button></li>
		   <li><button id="ansbt"><p><span>Answer MCQ</span></p></button></li>
		   </ul>
		   <hr/>
		</div> <!-- mid col here it will have news create, answer mcqs and newfeed-->
		<div class="grid_4 right_col omega"></div>
		
		</div><!-- grid 16 -->
		
		</header>
		</div>
	</div><!-- main -->
	</body>
</html>
<?php	 }
 	}
 else { header("location: ../index.php");}?> 
