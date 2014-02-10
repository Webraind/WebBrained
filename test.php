<!DOCTYPE html>
<html>
	<head>
		<link rel= "stylesheet" type ="text/css"  href="stylesheet.css"/>
		<title>Webraind</title>
	</head>
<body>

	<div id = "header">
		<p><img src="./Webraind001.png"></p>
	</div>
	

	<div class = "login">
	<form>
		<table>
			<tr>
				
				<td><input type="text" id="userHandle" placeholder="@userHandle"/> </td>
			</tr>
			<tr>
				
				<td><input type="password" id="password" placeholder="password"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<button id="button" onclick="showDetails()">
							<span>Sign in</span>
						</button>
					</center>
				</td>
			</tr>
    	</table>
    </form>
    <p>
    	<ul>
    		<li>forgot <a href="#">username/password?</a></li>
    		<li>New user? <a href="#"><span>Sign up!</span></a></li>
    	</ul>
    </p>
    <script language ="Javascript">
    
	var userHandle = document.getElementById("userHandle");
	var password = document.getElementById("password");
	var showDetails = function(){
	  confirm("The username you entered is "+userHandle.value+" and the password "+password.value);
	  
	};
	
	</script>
	</div>
</body>
</html>