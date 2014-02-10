<?php
session_start();
if(isset($_SESSION['username'])){ //if statement
$username = $_SESSION['username'];
// connecting to the Database
$db_connection = mysqli_connect('localhost','root','admin','webraind') or die("Echo:".$db_connection);

function mcqCount($db_connection)
 {
   $cnt_query = "SELECT * from MCQ";
   $cnt_result = $db_connection->query($cnt_query);
   
   $rows = $cnt_result->fetch_array();
   $num_of_rows = $cnt_result->num_rows;
   return $num_of_rows;
 }
 
 function userMcqCount($db_connection,$user)
 {
    $usrMcqCnt = "SELECT * from ANSWER where RESULT<>'skip' and USER ='".$user."'";
    $usrMcqCnt_result = $db_connection->query($usrMcqCnt);
    
    $rows = $usrMcqCnt_result->fetch_array();
    $num_of_rows =  $usrMcqCnt_result->num_rows;
    return $num_of_rows;
 }
 
 function mcqCountWidget($db_connection,$url)
 {
 		$query = 'SELECT qid from MCQ where SOURCE LIKE  "%'.$url.'%"';
		$result = $db_connection->query($query);
		
		$rows = result_to_array($result);
		$row = array();
		$num_of_rows = $result->num_rows;
		for ($i=0; $i<$num_of_rows;$i++)
		{
		 $row[$i] = $rows[$i]['qid'];
		}
		return $row;
		
 	
 } //mcqCountwidget
 
 function mcqUserWidget($db_connection, $username, $url)
    {
 		$query = "SELECT M.qid, A.qid, A.result FROM MCQ M, ANSWER A WHERE M.source LIKE  '$url' AND A.result <>'skip' AND M.qid = A.qid AND A.user ='$username'";// '".$username."'";
 		$result = $db_connection->query($query) or die("ERROR:".mysqli_error($db_connection));
 		//$result->fetch_array();
 		$rows = result_to_array($result);
 		$num_of_rows = $result->num_rows;
 		$row = array();
 		for ($i=0; $i<$num_of_rows;$i++)
		{
		 $row[$i] = $rows[$i]['qid'];
		}
 		//var_dump($rows);  
 		return $row;
 
 
 		}

function result_to_array($result)
		{
  			$rows = array();
  			while($row = $result->fetch_assoc() )
  			{
    		$rows[] = $row;
  			}
  		return $rows;
		} //function result_to_array
function queryMCQ($db_connection,$qid){
		$query = 'SELECT * from MCQ where QID='.$qid.'';
		$result = $db_connection->query($query);
		$row = $result->fetch_array();
		return $row; 
		} //Function queryMCQ
function queryMCQ_Widget($db_connection,$url){
		$query = 'SELECT * from MCQ where SOURCE LIKE  "%'.$url.'%"';
		$result = $db_connection->query($query);
		$row = $result->fetch_array();
		return $row; 
}		
function checkSkip($db_connection,$qid,$username){
        $query = 'SELECT * from ANSWER where QID='.$qid.' and USER="'.$username.'" '; //when mutliple users attempt question we must also include username
        $result = $db_connection->query($query);
        $row = array();
        $row = $result->fetch_row();
         if ($row){
         		   if(array_search('incorrect',$row) || array_search('correct',$row) )
        				{
        					return 'false';
        				}
        			elseif(array_search('skip',$row) ){
        			  return 'true';
        			}	
         		}
        	else {
        		return 'true';
        }
    }	//function CheckSkip
    
  function setSkip($db_connection,$qid,$username)  
  {
   $query = 'SELECT * from ANSWER where QID='.$qid.' and USER="'.$username.'" '; //when mutliple users attempt question we must also include username
        $result = $db_connection->query($query);
        $row = array();
        $row = $result->fetch_row();
        if ($row){
         		   if(array_search('skip',$row) ){
        			  return 'true';
        			}	
         		}
        	else {
        		return 'false';
        }
  	
    } //function setSkip
    
   
function randID($db_connection){
  $query = "SELECT qid from MCQ"; //Database query to fetch all the rows. 
  $result = $db_connection->query($query);
  $numOfRows = $result->num_rows;
  $row = array();
  $row = result_to_array($result);
  $row_qid =array();
   for($i=0; $i<=$numOfRows;$i++)
  		 {
  			 $row_qid[$i]=$row[$i]['qid'];
  		 }
   $max = max($row_qid);
   
   $rand_qid = rand(1,$max);
   while(!array_search($rand_qid,$row_qid))
  		 {
    		  $rand_qid = rand(1,$max);
    		  //echo $rand_qid;
      
  		 }
   return $rand_qid;
  }  //function RandID	
  
  function randIDWidget($db_connection,$url){
  $query = "SELECT qid from MCQ WHERE SOURCE LIKE '%".$url."%'"; //Database query to fetch all the rows. 
  $result = $db_connection->query($query);
  $numOfRows = $result->num_rows;
  $row = array();
  $row = result_to_array($result);
  $row_qid =array();
   for($i=0; $i<$numOfRows;$i++)
  		 {
  			 $row_qid[$i]=$row[$i]['qid'];
  		 }
   //$max = max($row_qid);
	//$min = min($row_qid);
	//var_dump($row_qid);
	//echo "MIM:".$min;
   $rand_key = array_rand($row_qid,1);
   $rand_qid = $row_qid[$rand_key];
   //echo $rand_qid;
   while(!array_search($rand_qid,$row_qid))
  		 {
    		  $rand_key = array_rand($row_qid,1);
              $rand_qid = $row_qid[$rand_key];
    		  
      
  		 }
   return $rand_qid;
    //echo $rand_qid;
  }  //function RandID	
  
  
$topic = 'random';//$_POST['topic'];
$skip = 'false';
 $MCQs = mcqCount($db_connection);
 $usrMCQs =  userMcqCount($db_connection,$username); 
 //echo $MCQs;
 //echo $usrMCQs;
 // debug - test 
// $url = 'http://bullshit.com'; //Either get it via $_POST or Set Cookie. 
 if(isset($_COOKIE["URL"]))
 { 
 $topic = null;  
 $url = $_COOKIE["URL"];
 //echo $url;
 $rows = mcqCountWidget($db_connection,$url);
 
 $mcqsCount = sizeof($rows);
 //echo $mcqsCount;
 //var_dump($rows);
 $usrRows = mcqUserWidget($db_connection, $username, $url);
 
 $usrMcqsCount = sizeof($usrRows);
 //echo  $usrMcqsCount;
 $cookie_option = 'false';
 
 }

if($topic == 'random')
		{
		if ($MCQs == $usrMCQs)
			{
			 $outOfQuestion = 'true';
			}
		else if($usrMCQs < $MCQs)
			{
			    $outOfQuestion = 'false';
				$randomQid = randID($db_connection);
				//echo $randomQid;	
 				//echo"<br>";
 		
 		
 				while(checkSkip($db_connection,$randomQid,$username) == 'false')
 						{
 		  					$randomQid = randID($db_connection);
 							//$skip = 'true';	
 							//echo $randomQid;	
 							//echo"<br>";
 						}
 						//echo $randomQid;
 						//echo "<br>";
 						$skip = setSkip($db_connection,$randomQid,$username);	
 						$MCQ = queryMCQ($db_connection,$randomQid);
	
 						/*foreach($MCQ as $i)
 								{
 									echo $i;
 									echo "<br>";
 									} */
 				}
 			else 
 			    {
 			    $outOfQuestion = 'error';
 			    }	
 			
 		}
 elseif($topic == null && $url) {
 
                       if ($mcqsCount == $usrMcqsCount)
							{
			 					$outOfQuestion = 'true';
			 					$cookie_option = 'true';
								}
					else if($usrMcqsCount < $mcqsCount) {			
 		                 $randomQid = randIDWidget($db_connection,$url); 
                  //echo $randomQid; 
        		          while(checkSkip($db_connection,$randomQid,$username) == 'false')
 								{
 		  								$randomQid = randIDWidget($db_connection,$url);
 		  								//$skip = 'true';	
 		
 								}   
 						//echo $randomQid;
 						$skip = setSkip($db_connection,$randomQid,$username);	
     					$MCQ = queryMCQ($db_connection,$randomQid);
     					$cookie_option = 'true';
     					}
     					else{
     					 $outOfQuestion = 'error';
     					}
     
       //echo "<script>alert('URL Function works');</script>";
 }		
 else
 		{
  			echo "<script>alert('Rest is still under construction!');</script>";
 		} //End if
 		
//Fetching the user details
//Query
$query_stmt = "SELECT * from USER where userHandle='$username'";
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

<html>
<head>
<link rel= "stylesheet" type ="text/css"  href="../CSS/answerMCQ.css"/>
	 <script src="../JS/JQ/jquery-1.10.2.min.js"></script>
	    <script src="../JS/JQ/jquery-ui.min.js"></script>
	    <script text="text/javascript" src="../JS/answerMCQ.js"></script>
<title>Random Questions</title>
</head>
<body>
	<?php echo <<<VAR
				<script type="text/javascript">
				var correctAnswer = '{$MCQ['ANSWER']}';
				var source = '{$MCQ['SOURCE']}';
				var qid = '{$MCQ['QID']}'; 
				var username ='{$username}';
				var skip = '{$skip}';
				</script>
VAR;
?>
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
<?php
       if($outOfQuestion == 'true')
       {?>
        <h1 style="color:red; font-size:40px; position: relative; text-align: center;">OOPS!!!!</h1>   
            <h2 style="color:red; font-size:20px; position: relative; text-align: center;">You Ran Out of Questions </h2>
            <div id="crtbtn" >
            <p style="position:relative; text-align: center;">
            <button id="CAQ" style="height: 60px;width:150px;background-color:#3b7b99; font-size: 16px;"> Create More Questions</button></p>
            </div>
            
 <?php      }
       else if($outOfQuestion == 'error'){
?>  
              <h1 style="color:red; font-size:40px; position: relative; text-align: center;">Application Broken, contact Web-admin!</h1>   
<?php       }
       else {		
?>
<ul id="Options">
	<li><?php echo'<div id="question">'.$MCQ['QUESTION'].'</div>';?><li>
	<li><?php echo'<button class="options" value="'.$MCQ['CH_1'].'">A:&nbsp; '.$MCQ['CH_1'].'</button>'?></li>
	<li><?php echo'<button class="options" value="'.$MCQ['CH_2'].'">B:&nbsp; '.$MCQ['CH_2'].'</button>'?></li>
	<li><?php echo'<button class="options" value="'.$MCQ['CH_3'].'">C:&nbsp; '.$MCQ['CH_3'].'</button>'?></li>
	<li><?php echo'<button class="options" value="'.$MCQ['CH_4'].'">D:&nbsp; '.$MCQ['CH_4'].'</button>'?></li>
<ul>
<div id="Status"></div>
<div id="correctAnswer"></div>
<div id="source"><p><ul><li><?php echo "Source: <a href='#' onclick = 'popUp()'>".$MCQ['SOURCE']."</a>"; ?></li></ul></p></div>
<ul class="ActionBtns">
	<li><button id="Skip">Skip Question</button></li>
	<li><button id="Next">Next Question</button></li>
	<li><button id="ShowAnswer">Show Answer</button></li>
	
	
</ul>
<?php } ?>
<?php if($cookie_option == 'true')
{ 
?> <ul class="ActionBtns" style="top: 110px;">
<li><button id="goBack">Let's Go Back!</button></li>
<li><button id ="random"> Random MCQ </button></li>
</ul>

<?php } ?>
 </div> <!-- mid col here it will have news create, answer mcqs and newfeed-->
		
	
		</div><!-- grid 16 -->
		</header>
		</div>
	</div><!-- main -->	

</body>
</html>
<?php }
 else { header("location: ../index.php");}?> 
