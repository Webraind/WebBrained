$(document).ready(function(){
     //alert(firstName);
 	//alert("yo!");
 	$('button').mouseenter(function(){
    		$(this).fadeTo('fast',0.75);
 				}); // mouse enter
 
 	$('button').mouseleave(function(){
   			$(this).fadeTo('fast',1);
 			});//mouse leave
 

      $('#crtbt').click(function(){
      		//alert("Click Function");
      		$(location).attr('href','../PHP/CreateMCQ.php');
      	 }); //End click
      $('#ansbt').click(function(){
           $(location).attr('href','../PHP/AnswerQuestion.php');
           }); 
}); //$document.ready