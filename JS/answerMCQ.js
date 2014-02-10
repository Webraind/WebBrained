function send_result(post_string)
     {
       $.ajax({
       type: "POST",
        url: "./SaveAnswer.php",
        data: post_string,
        success: function(html){
        		var response = $.trim(html);
        		if(response == 'true')
        		 {
        		// alert(response);
        		 $(location).attr("href","./AnswerQuestion.php");
        		 }
        		 else{
        		 // alert(response);
        		 alert("Application broken");
        		 }	
        		},
        beforeSend: function(){
          //alert("Saving...");
        }
       });
     } 	
     
 function popUp()
 {
  //alert(source);
  url = source;
  myWindow  = window.open(url, "Source",'height=400, width=400');
  myWindow.focus();
 }    
$(document).ready(function(){
      // alert(correctAnswer);
      	//alert(qid);
      	//alert(username);
     
      	 $('#Next').attr("disabled","disabled");
     attmpts = 0;
     var result;
     var score = 3;
     $('.options').mouseenter(function(){
      										$(this).fadeTo('fast',0.80);
      											});
      $('.options').mouseleave(function(){
      										$(this).fadeTo('fast',1);
      											}); 	
      	      														
     $('.options').click(function(){
      		 $(this).css("background-color","#3D5266");
      		 opt = $(this).val();
        		//alert("You picked "+opt);
        		if(attmpts < 4){
        				if(opt == correctAnswer){
        				             attmpts++; 
        							$('#Status').html("<p>This is correct! Number of attempts "+attmpts+"</p>");
        							$('#status p').css({"color":"green","font-weight":"bold"});
        							$(this).css({"background-color":"#69a74e"});
        							result = "correct";
        							if(attmpts == 1){
        								score = 4;
        								}
        								
        							}
        				else{
        							
        							attmpts++;
        							$('#Status').html("<p>This was attempt number "+attmpts+", sorry incorrect answer</p>");
        							$('#Status p').css({"color":"red","font-weight":"bold"});
        							$(this).css({"background-color":"#FF7575"});
        							result = "incorrect";
        							score--;
        					}
        					
        			}
        			else{
        			 alert("You ran out of attempts");
        			}
        	//	
         $(this).attr("disabled","disabled");	
         // if user tries more then three attempts, remaing buttons are disabled
       	
         if(attmpts == 3 || opt == correctAnswer)
      	{
      	 $('.options').attr("disabled","disabled");
      	 $('#Next').removeAttr("disabled");
      	 $('#ShowAnswer').attr("disabled","disabled");
      	 $('#Skip').attr("disabled","disabled");
      	}	
         
      	}); // click
        
        $('#ShowAnswer').click(function(){
             // alert("show answer");
        	$(this).fadeTo("fast",0);
        	$('#Next').removeAttr("disabled");
        	$('#Skip').attr("disabled","disabled");
        	$('.options').attr("disabled","disabled");
            $('#correctAnswer').html("<p><ul><li>Correct answer is: "+correctAnswer+"</li></ul></p>");
            result = "incorrect";
            score = 0;
             //alert(status);
        	}); // Show answer click function
      	
      	$('#Next').click(function(){
      	//alert(attmpts);
      	//if(attmpts == 3){alert("You run out of attempts");};
      	post_string = "qid="+qid+"&user="+username+"&attempts="+attmpts+"&result="+result+"&score="+score+"&skip="+skip;
      	//alert(post_string);
      	send_result(post_string);
      	});
      	$('#Skip').click(function(){
      	$('#ShowAnswer').attr("disabled","disabled");
      	$('.options').attr("disabled","disabled");
      	post_string = "qid="+qid+"&user="+username+"&attempts="+attmpts+"&result=skip&score="+null+"&skip="+skip;
      	send_result(post_string);
      	//alert(post_string);
      	});
      	
      	$('#CAQ').click(function(){
      	 $(location).attr("href", "./CreateMCQ.php");
      	});
      	
      	$('#goBack').click(function(){
      	
      	var post_string="url="+source+"&option=back";
      	$(location).attr("href", "./unSetCookie_Test.php?"+post_string);
      	});
      	$('#random').click(function(){
      	$(location).attr("href","./unSetCookie_Test.php?option=randomize");
      	});
});

