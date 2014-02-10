<?php
session_start();
if(isset($_SESSION['username'])){ //if statement
$userName = $_SESSION['username'];
//Starting the connection
$db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Error: ".mysqli_error($db_connection));
//Query
$query_stmt = "SELECT * from USER where userHandle='$userName'";
//Executing Query
$result = $db_connection->query($query_stmt);
//storing elements in $row
$row = $result->fetch_array() or die("Error:".mysqli_error($db_connection));
//Profile picture 
if($row['profilepic']!= null){
	$profilepic = 'data:image/jpeg;base64,'.base64_encode($row['profilepic']);
	}
else{
	$defaultImage = "../Images/defaultprofilepic.jpg";
	$imgbinary = fread(fopen($defaultImage,"r"),filesize($defaultImage));
	$profilepic = 'data:image/jpeg;base64,'.base64_encode($imgbinary);
}
$firstName = $row['firstName'];
$lastName = $row['lastName'];

  
?>

<!DOCTYPE html>
<html>
	<head>
	<title>Create MCQ</title>
	<link rel= "stylesheet" type ="text/css"  href="../CSS/CreatMCQ.css"/>
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	     <script src="../JS/JQ/jquery-1.10.2.min.js"></script>
	    <script src="../JS/JQ/jquery-ui.min.js"></script>
	    <script text="text/javascript" src="../JS/createMCQ"></script>
	</head>
	<body>
	<div id="header">
	   <div class="container_16">
		<header class="container_16">
		<div class="grid_12 Logo alpha">
		 <p><img src="../Images/Webraind002.png"></p>
	   </div>
	  <div class="grid_2 profpic">
	  <ul>
	  <?php echo '<li> <img src ='.$profilepic .' alt="image"></img></li>' ;
	  echo '<li> <div id="cred"><span>'.$firstName.'</span></div></li>' ;
	  ?>
	  
	  </ul>
	  </div>
	   <div class="grid_2 welcome omega">  
	   		<ul>
     	<?php
		echo "<li><a href=logout.php> Logout </a></li>";
		echo "<li><a href=home.php> <span>Home</span></a></li>"; 
		?>
		 </ul>
	    </div>
		</header>
		</div><!-- Div class Container 16 -->
	</div> <!-- Div id header-->	
	<div id="main">
		<div class="container_16">
		<header class="container_16">
		<div class = "grid_16 main_body">
		
		<div class="grid_16 mid_col">
		<div id="msg"></div>
		<form><!-- method="post">-->
		<ul>
		<li>Create MCQ</li>
		<li><textarea id="question" name="question" maxlength="100" placeholder="Question"></textarea></li>
		<li><input type="text" id="CH_1" maxlength="30" placeholder="Choice 1"></input></li>
		<li><input type="text" id="CH_2" maxlength="30" placeholder="Choice 2"></input></li>
		<li><input type="text" id="CH_3" maxlength="30" placeholder="Choice 3"></input></li>
		<li><input type="text" id="CH_4" maxlength="30" placeholder="Choice 4"></input></li>
		<li><input type="text" id="Answer" maxlength="30" placeholder="Correct Answer"></input></li>
		<li><input type="text" id="topic" maxlength="30" placeholder="Topic"></input></li>
		<li><input type="url" id="source"  maxlength="100" placeholder="source"></input></li>
		<li><div id="error_msg"></div></li>
		<li><button>Create Question</button></li>
		</ul>
		</form>
		<div id="req_status"></div>
	</div> <!-- mid col here it will have news create, answer mcqs and newfeed-->
		
		
		</div><!-- grid 16 -->
		</header>
		</div>
	</div><!-- main -->	
	 
	</body>
</html>

<?php }
 else { header("location: ../index.php");}?> 


