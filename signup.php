<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/progression.min.css">
  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="js/progression.min.js"></script>
</head>

<body>

  
  <div id="w">
    <div id="content">
      <img style="text-align:center" src ="images/logomap.png"/>
	  <h1>Want to see what's being cooked behind? Please sign up ? </h1>
      
      <form id="registerform" method="post" action="showtrackingcode.php">
        <div class="formrow">
          <label for="username">Username</label>
          <input data-progression="" type="text" name="username" id="username" class="basetxt" tabindex="1" data-helper="Any name with at least 6 characters.">
          <p class="errmsg">Please add some more characters</p>
        </div>
        
        <div class="formrow">
          <label for="email">Email Address</label>
          <input data-progression="" type="email" name="email" id="email" class="basetxt" tabindex="2" data-helper="Where do we send your verification email?">
          <p class="errmsg">Please enter a proper e-mail</p>
        </div>
		
			<div class="formrow">
          <label for="websitename">Website URL</label>
          <input data-progression="" type="text" name="websitename" id="websitename" class="basetxt" tabindex="3" data-helper="Please enter your fully qualified website url like http://www.map.kitchen ">
          <p class="errmsg">Please enter proper website url</p>
        </div>
		
		<div class="formrow">
          <label for="phone">Phone Number</label>
          <input data-progression="" type="text" name="phone" id="phone" class="basetxt" tabindex="4" data-helper="So that we can contact you.">
          <p class="errmsg">Please enter phone number</p>
        </div>
        
        <div class="formrow">
          <label for="password1">Password</label>
          <input data-progression="" type="password" name="password1" id="password1" class="basetxt" tabindex="5" data-helper="Make sure you can remember it!">
        </div>
        
        <div class="formrow">
          <label for="password2">Password(again)</label>
          <input data-progression="" type="password" name="password2" id="password2" class="basetxt" tabindex="6" data-helper="Please re-enter the password again.">
          <p class="errmsg">Passwords do not match!</p>
        </div>
		
	
		
        
        <input type="submit" id="submitformbtn" class="submitbtn" value="Sign Up">
      </form>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script type="text/javascript">
$(function(){
  $("#registerform").progression({
    tooltipWidth: '200',
    tooltipPosition: 'right',
    tooltipOffset: '0',
    showProgressBar: true,
    showHelper: true,
    tooltipFontSize: '14',
    tooltipFontColor: 'fff',
    progressBarBackground: 'fff',
    progressBarColor: '7ea2de',
    tooltipBackgroundColor: 'a5bce5',
    tooltipPadding: '7',
    tooltipAnimate: true
  })
  var errorMessage = true;
  $('#username').on('blur', function(){
    var currval = $(this).val();
    
    if(currval.length < 6) {
      $(this).next('.errmsg').slideDown();
	  errorMessage = true;
    } else {
      // the username is 6 or more characters and we hide the error
	  errorMessage = false;
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#email').on('blur', function(){
    // email regex source http://stackoverflow.com/a/17968929/477958
    var mailval = $(this).val();
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(mailval)) {
      $(this).next('.errmsg').slideDown();
	  errorMessage = true;
    } else {
	  errorMessage = false;
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#websitename').on('blur', function(){
  var websitename = $(this).val();
    
    var pattern = new RegExp("(http|ftp|https)://[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:/~+#-]*[\w@?^=%&amp;/~+#-])?");
    if(!pattern.test(websitename)) {
      $(this).next('.errmsg').slideDown();
	  errorMessage = true;
    } else {
	  errorMessage = false;
      $(this).next('.errmsg').slideUp();
    }
  
  });
  

  
  $('#password2').on('blur', function(){
    var pwone = $('#password1').val();
    var pwtwo = $(this).val();
    
    if(pwtwo.length < 1 || pwone != pwtwo) {
      $(this).next('.errmsg').slideDown();
	  errorMessage = true;
    } else if(pwone == pwtwo) {
	errorMessage = false;
      // both passwords match and we hide the error
      $(this).next('.errmsg').slideUp();
    }
  });
$("#registerform").submit(function(e){
   if(errorMessage == true)
   {
    e.preventDefault();
	}
  });
  
});
</script>
</body>
</html>