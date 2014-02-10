
$(document).ready(function(){
$('#widget').css({"height":"30px","width":"120px"});

var para = $("<p>webraind</p>");
para.attr('id','widget_P'); 
para.css({"height":"30px","width":"120px","background-color":"#ffffff","border":"1px solid #000000","color":"#3b7b99",
          "text-align":"center","border-radius":"5px"});

/*var img = $('<img> </img>');
img.attr("src","http://localhost/~mragendrasingh/webbrained/images/Webraind_widget00.png");
img.css({"height":"30px","width":"100px"});
para.append(img);
var anchor = $('');
anchor.attr('href','#');
para.css({"height":"30px","width":"120px"});
anchor.append();*/
$('#widget').append(para);

//alert(document.URL);

$('#widget').click(function(){
//var URL =  "http://bullshit.com";//document.URL;
//var URL = "http://localhost/mragendrasingh/test001/header_exercise";
var URL = document.URL;
var post_string = "url="+URL;
//$.cookie("url",URL);
$(location).attr("href","http://localhost/~mragendrasingh/webbrained/PHP/SetCookie_Test.php?"+post_string);
 //alert("Widget got clicked"); //We will add the function to set cookie.
});

});
//<img src="http://localhost/~mragendrasingh/webbrained/images/Webraind_widget00.png"/>
/*
	$.ajax({
		type:"POST",
		 url:"http://localhost/~mragendrasingh/webbrained/PHP/SetCookie_Test.php",
		 data: post_string,
         success: function(html) {
           $(location).attr("href","http://localhost/~mragendrasingh/webbrained/PHP/SetCookie_Test.php");
         },
         beforeSend: function(){
         // alert("Sending....");
             }
			}); //end of Ajax
	return false;	
	-------
	$.post("http://localhost/~mragendrasingh/webbrained/PHP/SetCookie_Test.php",
                                                             {url:URL},function(){
                                                             $(location).attr("href","http://localhost/~mragendrasingh/webbrained/PHP/SetCookie_Test.php");
                                                             });	
	*/