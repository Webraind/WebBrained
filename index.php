<?php
session_start(); 
if(!isset($_SESSION['username'])){?>
<!DOCTYPE html>

<html>

	<head>
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

	   
		<link rel= "stylesheet" type ="text/css"  href="CSS/Index.css"/>
		<title>Webraind</title>
		<script>
		 $(document).ready(function(){
		  
		
	    });
		</script>
		 <script text="text/javascript" src="JS/script.js"></script>
	</head>
<body>



  <!-- Page header [Signin]-->
	
	<div id = "header">
		<div class = "container_16">
	 		<header class="container_16">
		<div class="grid_8 Logo alpha">
		 <p><img src="./Images/Webraind002.png"></p>
	   </div>
	   <div class="grid_8 signin omega">
	   
	   		<form> <!-- action="PHP/login.php"-->
	   			<ul>
	   			 	<li><input type="text" id="userHandle" name="userHandle" placeholder="Username"/></li>
	   			 	<li><input type="password" id="password" name="password" placeholder="Password"/></li>
	   			 	<li>
	   			 	<button id="button">
							<span>Sign in</span>
						</button>
	   			 	</li>
	   			</ul>
	   			
	   		</form>
	   		 <div id="signinmsg"><p>forgot <a href="#">username/password?</a></p></div>
	   </div>
	  <div class="grid_16 omega" id="error"></div>

	
	 </header>
  </div>
    </div>
  <!-- Sign Up -->  
    <div class = "container_16">
	<header class = "container_16">
     <div class = "grid_4 alpha">&nbsp;</div>
	<div class = "grid_8 signup "  style="white-space:nowrap;">
	
	<form>
	  <ul >
	  	<li>Sign up!</li>
	  	<li><input type="text" id="firstName" maxlength="30" placeholder="First Name"/> </li>
		<li><input type="text" id="lastName" maxlength="30" placeholder="Last Name"/> </li>
		<li><input type="email" id="email"  maxlength="30" placeholder="email"/> </li>
		<li><input type="text" id="userHandle01"  maxlength="30" placeholder="New Username"/> </li>
		<li><input type="text" id="confirmUserHandle"  maxlength="30" placeholder="Confirm Username"/> </li>
		<li><input type="password" id="password01"  maxlength="30" placeholder="password"/></li>
		<li><label>Male</label><input type="radio"  class="radio" name="gender" id="gender" value="male" /><br>
		<label>Female</label><input type="radio" class="radio" name="gender" id="gender" value="female" /></li>
				
						<li><button id="button"">
							<span>Sign up</span>
						</button></li>
					</ul>
    </form>
   <div class="grid_16 omega" id="signup_error"></div>
    </div>
    <script>
   /*  var firstName = document.getElementById("firstName");
     var lastName = document.getElementById("lastName");
     var email = document.getElementById("email");
     var userHandle = document.getElementById("userHandle01");
     var password = document.getElementById("password01");
     var gender = document.getElementById("gender");
     
     var showSignupDetails = function (){
     alert(firstName.value+" , "+lastName.value+" , "+email.value+" , "+userHandle.value+" , "+ password.value+" , "+gender.value);
     };
    */
    </script>
    <div class = "grid_4 omega">&nbsp;</div>
	</header>
	</div>
</body>
</html>
<?php } else { header("location: PHP/home.php");}?>