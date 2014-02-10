$(document).ready(function(){
 //alert("Hey ho!");



 
 $('button').click(function(){
 question = $('#question').val();
 CH_1 = $('#CH_1').val();
 CH_2 = $('#CH_2').val();
 CH_3 = $('#CH_3').val();
 CH_4 = $('#CH_4').val();
 answer = $('#Answer').val();
 topic = $('#topic').val();
 source = $('#source').val();
 post_string = "question="+question+"&CH_1="+CH_1+"&CH_2="+CH_2+"&CH_3="+CH_3+"&CH_4="+CH_4+"&answer="+answer+"&topic="+topic+"&source="+source;
	//alert(source);
	if(question== "" || CH_1 =="" || CH_2 =="" || CH_3 =="" || CH_4 =="" || answer =="" || topic =="" || source =="")
	{
	 $('.mid_col form textarea').css("border","2px solid #FF0000");
	 $('.mid_col form input').css("border","2px solid #FF0000");
	 $('#error_msg').show(function(){
	 $(this).html('<p> One or more fields are empty</p>');
   		$(this).css("color","#FF0000"); 
   		});
	}
	
	else if(answer == CH_1 || answer == CH_2 || answer == CH_3 || answer == CH_4){
		$.ajax({
				type: "POST",
				url: "./InsertQuestion.php",
				data: post_string,
				success:function(html){
										var res = $.trim(html);
	  									if(res == 'true'){
	 									 				 $('#msg').show(function(){
	 									 				$(this).html('<ul><li><p>Question Created!!!</p></li>\
	 									 				             <li><p><button id="CAQ" style="height: 60px;width:150px;background-color:#3b7b99;"> Create Another Question</button></p></li>\
	 									 				             <li><p><a href="home.php">Home</p></li><ul>');
	 									 				            $('#CAQ').click(function(){
	 									 				            //$(location).attr("href","./CreateMCQ.php");
	 									 				             	$('#msg').hide(); 
	 									 				             	$('#question').val('');
	 									 				             	$('#CH_1').val('');
	 									 				          		$('#CH_2').val('');
	 									 				              	$('#CH_3').val('');
	 									 				              	$('#CH_4').val('');
	 									 				              	$('#Answer').val('');
	 									 				              	$('#topic').val('');
	 									 				              	$('#source').val('');
	 									 				            $(location).attr("href","./CreateMCQ.php");
	 									 				             
	 									 				            }); 
	 									 				 });
	 									 				$('#req_status').hide();
	 								 			}
	 								   else{
	  												//alert(res);
	  												}
	 										 },
	  			beforeSend: function(){
	  			                $('.mid_col form').hide(); 
	  							$('#req_status').show(function(){
	  									$(this).html("<p>Processing...</p>");
	  									$(this).css({
	  										"height": "80px", 
											"width":"200px",
											"background-color":"#B1CAD6",
											"font-weight":"bold"
	  										}); //css
	  										
	  										});
	  							}
	  		});//end ajax 
	
   		}
   		else{
   		 $('.mid_col form textarea').css("border","1px solid");
	    $('.mid_col form input').css("border","1px solid");
   		$('.mid_col #Answer').css("border","2px solid #FF0000");
   		$('#error_msg').show(function(){
   		$(this).html('<p> Answer should be on of the four choices</p>');
   		$(this).css("color","#FF0000");
   		});
   		}//If statment
   		return false;
 });//Click

});