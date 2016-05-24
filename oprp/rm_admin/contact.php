<?php  require_once("../_php/init_rmadmin.php"); 

if(isset($_POST["submit"])){
	
	$user = User::getDetailByID($session->user_id);
	$name = $user->uname;
	$email = $user->email;
	$from = "From: Contact Form <no-reply@dce.edu>";
	$content = "Username : {$name}\n";
	$content .= "Email : {$email}\n\n";
	$content .= $_POST['content']; 
	
	$sub  = "Resume Manager [RM Admin] - ".$_POST['subject'];
	$to   = "garg.sahil25@gmail.com";
	
/*	echo $to."<br/>";
	echo $from."<br/>";
	echo $sub."<br/>";
	echo $content."<br/>";*/
	
	$sent = @mail($to,$sub,$content,$from);
		
	if($sent) $msg = setErrNotMsg("Mail has been sent successfully.");		
	else $msg = setErrMsg("Mail cannot be sent. Please try later.");
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Contact</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 

$(document).ready(function() { 
  $("#contact_form").validate({ 
	rules: { 
	  content: { required: true}
	}, 
	messages: { 
	  content: { required: "<br/>Please enter the content of the message" }
	} 
  }); 
}); 

</script>

</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/menu.php"); ?>
            
<!--body-->
            	
                
<table width="100%" cellpadding="0" cellspacing="20" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr><td>
    
        <table width="100%" cellpadding="0" cellspacing="10" border="0" align="left">
        <tr height="40px" valign="middle"><td><span class="topicTxt">Contact Us</span></td></tr>
        <tr valign="top"><td width="100%">
        	
            <form action="" method="post" id="contact_form">
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
			<tr><td><strong>Subject</strong></td>
            	<td><select name="subject">
                	<option>Query</option>
                    <option>Suggestions</option>
                    <option>Report a Bug</option>
                	</select></td></tr>
            <tr><td colspan="2"><strong>Content</strong><br/>
            	<textarea id="content" name="content" cols="60" rows="5"></textarea></td></tr>
            <tr><td colspan="2"><input type="submit" value="Send" name="submit" class="submitStyle"/></td></tr>          
            </table>
            </form>
        
        </td></tr>
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>