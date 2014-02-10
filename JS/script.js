
 $(document).ready(function(){
   
    var $button = $('button');
    var $signin_button = $('.signin #button');

     $button.mouseenter(function(){
	       $(this).fadeTo('fast',0.75)});
	 $button.mouseleave(function(){
	       $(this).fadeTo('fast',1)});
	  
	//Signing in 
	 
	$('#error').hide();
	$('.signin button').click(function(){
	  userHandle =$('.signin #userHandle').val();
	  password = $('.signin #password').val();
	  //alert(" UH "+userHandle+" PW: "+password);
		 $.ajax({
			 type: "POST",
			 url:  "./PHP/login.php",
			 data: "userHandle="+userHandle+"&password="+password,
			 success: function(html){
			    var res = $.trim(html);
			   // alert("look"+res+"look");
			               if(res=='true'){
	 						     //alert("look"+res+"look");
	 							 $(location).attr('href','PHP/home.php');
							 }
							 else{
							 //alert("look"+res+"look");
							 $('.signin input').css("border","2px solid #ff0000");
							 $('#error').show(function(){$(this).html('<p>Incorrect <span>username/password</span></p>');
							 							$(this).css({"margin-left":"-240px","margin-top":"10px"});
							                            });
							 }
							},
	 		 beforeSend:function(){
   							 $('#add_error').html('Logging in...');
  							 }
				 }); //End Ajax
	           return false;
	     }); // end Click
     
	   //signup
	   $('.signup #button').click(function(){
	   firstName = $('.signup #firstName').val();
	   lastName = $('.signup #lastName').val();
	   email = $('.signup #email').val();
	   userHandle = $('.signup #userHandle01').val();
	   confirmUserHandle = $('.signup #confirmUserHandle').val();
	   password = $('.signup #password01').val();
	   gender = $('input:radio[name=gender]:checked').val()
	  // alert(firstName+","+lastName+","+email+","+userHandle+","+confirmUserHandle+","+password+","+gender);
	   if(firstName == "" || lastName == "" || email == "" || userHandle == "" || confirmUserHandle == ""|| password == "" )
	    {
	     $('.signup  form input').css("border","2px solid #ff0000");
	     $('#signup_error').show(function(){$(this).html('<p>One or more field is empty!</p>');
							 							$(this).css({"left":"125px","margin-top":"10px","color":"#ff0000","position":"relative"});
							                            });
							                            
	    // alert("oops!");
	    }
	    else if( userHandle != confirmUserHandle)
	    {
	      $('.signup form #userHandle01').css("border","2px solid #ff0000");	
	      $('.signup form #confirmUserHandle').css("border","2px solid #ff0000");
	      $('#signup_error').show(function(){$(this).html('<p>Different usernames! </p>');
							 						$(this).css({"left":"150px","margin-top":"10px","color":"#ff0000","position":"relative"});
							                    });	
	    }
	   else{
	   		$.ajax({
	        	type:"POST",
	        	url: "PHP/signup.php",
	        		data: "userHandle="+userHandle+"&password="+password+"&firstName="+firstName+"&lastName="+lastName+"&email="+email+"&gender="+gender,
	        		success: function(html){
	        		 var res = $.trim(html);
	         		//alert(res);
	        						if(res == 'email exists')
	        								{ 
	        							$('.signup form #email').css("border","2px solid #ff0000");	
	        						    $('#signup_error').show(function(){$(this).html('<p>Email exists! </p>');
							 						$(this).css({"left":"200px","margin-top":"10px","color":"#ff0000","position":"relative"});
							                    });
	        							
	        						 
	                                		}
	                                else if(res == 'userHandle exists')
	                                		{
	                                		$('.signup form #userHandle01').css("border","2px solid #ff0000");	
	                                		$('#signup_error').show(function(){$(this).html('<p>Username exists! </p>');
							 						$(this).css({"left":"125px","margin-top":"10px","color":"#ff0000","position":"relative"});
							                    });
	                                		}
	                                else if(res == 'email and userHandle exits')
	                                		{
	                                		$('.signup form #email').css("border","2px solid #ff0000");	
	                                		$('.signup form #userHandle01').css("border","2px solid #ff0000");	
	                                 		$('#signup_error').show(function(){$(this).html('<p>Email & Username exists! </p>');
							 						$(this).css({"left":"125px","margin-top":"10px","color":"#ff0000","position":"relative"});
							                    });
	                                		}		
	                                else if(res == 'true')
	                                		{ 
	                               
	                                 		$(location).attr('href','PHP/home.php');
	                                		}
	                                	else
	                                		{ 
	                                		     $('.signup form #userHandle01').css("border","2px solid #ff0000");	
	                                			$('#signup_error').show(function(){$(this).html('<p>Signup failed,The username is more then 10 characters. </p>');
							 						$(this).css({"left":"0px","margin-top":"10px","color":"#ff0000","position":"relative"});
							                    });
	                               		  }
	         		},
	        		 beforeSend: function(){//alert("processing");
	        		 }
	         
	  			 }); // end Ajax
	  			 
	  // return false;
	   
	   } //if
	 return false;
	   });//Ends Click  
	
 
});

 
   