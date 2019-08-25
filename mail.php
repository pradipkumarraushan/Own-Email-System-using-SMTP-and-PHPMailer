<?php  
session_start();
include('connection.php');
if(!isset($_SESSION["user"])){
  echo 'Please login to view this page!';
  header('Location: login_view.php');
  die();
}
else {
extract($_POST);
if (isset($_POST['submit'])) 
{
if ( $email =="" || $subject =="" || $name =="" ||  $message =="") 
 {
  $error_message="Fill all the fileds first"; 
  }
  else
  {
require_once 'vendor/autoload.php';
$mail = new PHPMailer\PHPMailer\PHPMailer;
//Enable SMTP debug mode
$mail->SMTPDebug = 0;
//set PHPMailer to use SMTP
$mail->isSMTP();
//set host name
$mail->Host = "SMTP hostname";
// set this true if SMTP host requires authentication to send mail
$mail->SMTPAuth = true;
//Provide username & password
$mail->Username = "user_name";
$mail->Password = "password";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;// Enter  port number 

$mail->From = "your own domain email id";

$mail->FromName =  " ".$_POST['name']." ";

$mail->addAddress($_POST["email"]); 

/*
$file = "attachment/".basename($_FILES['attachment']['name']);
move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
$mail->addAttachment("attachment/".basename($_FILES['attachment']['name']));
*/

if(isset($_FILES['file'])):		 
	//$validextensions = array("jpeg", "jpg", "png" , "pdf" );
	foreach($_FILES['file']['name'] as $k => $ar):
		
	//	$temporary = explode(".", $_FILES['file']['name'][$k]);
	//	$file_extension = end($temporary);
	//	if ((($_FILES['file']['type'][$k] == "image/png") || ($_FILES['file']['type'][$k] == "image/jpg") || ($_FILES['file']['type'][$k] == "image/jpeg") || ($_FILES['file']['type'][$k] == "application/pdf")
	//	) && ($_FILES['file']['size'][$k] < 10000000)//Approx. 1000kb files can be uploaded.
	//	&& in_array($file_extension, $validextensions)) 
		{                                   
			/*if ($_FILES['file']['error'][$k] > 0)
			{
				echo "Return Code: " . $_FILES['file']['error'][$k] . "<br/><br/>";
			}
			else
			{
				if (file_exists("attachment/" . $_FILES['file']['name'][$k])) {
					echo $_FILES['file']['name'][$k] . " <span id='invalid'><b>already exists.</b></span> ";
				}
				else
				{*/
					$sourcePath = $_FILES['file']['tmp_name'][$k]; // Storing source path of the file in a variable
					$targetPath = "attachment/".$_FILES['file']['name'][$k]; // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					$mail->addAttachment("attachment/".$_FILES['file']['name'][$k]);
				/*}
			}*/
	//	}
	//	else
	//	{
	//	$error_message= "Invalid file Size or Type ";
		}
	endforeach;
endif;

$mail->isHTML(true);

$mail->Subject =" ".$_POST['subject']." ";
$body = "<html>
           <head> </head>
                <body> ".$_POST['message']." <br> 


                 </body>
            </html>";
$body .= '......<br>
<table id="zs-output-sig" style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse; width: 550px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-collapse: collapse; font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828;"><span style="font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828; display: inline;">Kind Regards,</span></td>
</tr>
<tr>
<td style="border-collapse: collapse; padding-bottom: 7px; height: 7px;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="92">
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-collapse: collapse; line-height: 0px;"><img src="https://ucarecdn.com/e4ae6988-225c-4b23-aff5-a1262ad59475/-/resize/92x120/img.png" width="92" height="120" border="0" /></td>
</tr>
</tbody>
</table>
</td>
<td style="border-collapse: collapse; padding-right: 7px; width: 7px;" width="7">&nbsp;</td>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-collapse: collapse; font-family: Calibri, Helvetica, sans-serif; font-size: 25.0px; font-style: normal; line-height: 32px; font-weight: normal; color: #282828;"><span style="font-family: Calibri, Helvetica, sans-serif; font-size: 30.0px; font-style: normal; line-height: 32px; font-weight: normal; color: #282828; display: inline;">PRADIP KUMAR RAUSHAN</span></td>
</tr>
<tr>
<td style="border-collapse: collapse; font-family: Calibri, Helvetica, sans-serif; font-size: 21.0px; font-style: normal; line-height: 23px; font-weight: bold; color: #282828;"><span style="font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 23px; font-weight: bold; color: #282828; display: inline;">CSE - SDM College Of Engineering And Technology.</span></td>
</tr>
<tr>
<td style="border-collapse: collapse; font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828;"> <span style="font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828; display: inline;">( Web Developer ).<br><br></span></td>
</tr> 

<tr>
<td style="border-collapse: collapse; font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828;"><span style="font-family: Calibri, Helvetica, sans-serif; font-size: 14.0px; font-style: normal; line-height: 16px; font-weight: normal; color: #5e4036; display: inline;">Mobile:</span> <span style="font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828; display: inline;">+919035867192</span></td>
</tr>
<tr>
<td style="border-collapse: collapse; font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828;"><span style="font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #5e4036; display: inline;">Address:</span> <span style="font-family: Calibri, Helvetica, sans-serif; font-size: 15.0px; font-style: normal; line-height: 17px; font-weight: normal; color: #282828; display: inline;">Karnataka,India.</span></td>
</tr>
<tr>
<td style="border-collapse: collapse; padding-bottom: 3px; height: 3px;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
<td style="border-collapse: collapse; padding-right: 8px; width: 8px;">&nbsp;</td>
<td style="border-collapse: collapse; background-color: #000000; width: 3px;">&nbsp;</td>
<td style="border-collapse: collapse; padding-right: 8px; width: 8px;">&nbsp;</td>
<td>
<table style="font-family: Arial,Helvetica,sans-serif; line-height: 0px; font-size: 1px; padding: 0px; border-spacing: 0px; margin: 0px; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td><a style="font-size: 0px; line-height: 0px;" href="https://www.facebook.com/pradipkumarraushan" title="Facebook" rel="nofollow noopener"><img src="https://gimm.io/assets/social/24/171616/04facebook.gif" alt="facebook" width="24" height="24" border="0" /></a></td>
</tr>
<tr>
<td style="border-collapse: collapse; padding-bottom: 5px; height: 5px;">&nbsp;</td>
</tr>
<tr>
<td><a style="font-size: 0px; line-height: 0px;" href="https://github.com/pradipkumarraushan" title="GitHub" rel="nofollow noopener"><img src="https://gimm.io/assets/social/24/000000/04github.gif" alt="github" width="24" height="24" border="0" /></a></td>
</tr>
<tr>
<td style="border-collapse: collapse; padding-bottom: 5px; height: 5px;">&nbsp;</td>
</tr>
<tr>
<td><a style="font-size: 0px; line-height: 0px;" href="https://www.linkedin.com/in/pradipkumarraushan" title="Linkedin" rel="nofollow noopener"><img src="https://gimm.io/assets/social/24/000000/04linkedin.gif" alt="linkedin" width="24" height="24" border="0" /></a></td>
</tr>
<tr>
<td style="border-collapse: collapse; padding-bottom: 5px; height: 5px;">&nbsp;</td>
</tr>
<tr>
<td><a style="font-size: 0px; line-height: 0px;" title="Email" href="mailto:admin@pradip-github.epizy.com" rel="nofollow"><img src="https://ucarecdn.com/33ed08dc-a3e0-451f-afaf-4091eb842ffb/-/crop/426x280/236,119/-/preview/" alt="https://ucarecdn.com/33ed08dc-a3e0-451f-afaf-4091eb842ffb/-/crop/426x280/236,119/-/preview/" width="26" height="17" border="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="border-collapse: collapse; padding-bottom: 8px; height: 8px;">&nbsp;</td>
</tr>
<tr>
<td style="border-collapse: collapse;">&nbsp;</td>
</tr>
</tbody>
</table>';

$mail->MsgHTML($body);
        if(!$mail->send()) {
            $error_message = "Mailer Error : ". $mail->ErrorInfo;
        } else {
            $success_message = "Email Sent Successfully";
        }
        
 }
}}
?>
<!DOCTYPE html>
<html lang="en-US">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PRADIP KUMAR RAUSHAN">
    <meta name="keywords" content="PRADIP KUMAR RAUSHAN">
    <meta name="author" content="PRADIP KUMAR RAUSHAN">
    <link href="../favicon.png" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="ckeditor_4.8.0_full/ckeditor/ckeditor.js"></script>
 </head>
<body onLoad="setInterval('tt()',1000)">

      
       <h1 style="color: black" class="text-center">Compose Email</h1>
       <?php if(!empty($success_message)) { ?>
                <?php echo '<script language="javascript">';
echo 'alert("'.$success_message.'")';
echo '</script>'; ?>
                <?php } ?>
                <?php if(!empty($error_message)) { ?>
                <?php
                 echo '<script language="javascript">';
echo 'alert("'.$error_message.'")';
echo '</script>';
                  
                  ?>
                <?php } ?>
<table class="table table-dark table-striped col-sm-6 offset-sm-3 text-center " >
  <form method="post" enctype="multipart/form-data" class="form-inlin justify-content-center form-group">

      <tbody>
      <tr>
        <td>Time / Date</td>
        <td><span class="btn btn-info" style="color:white" id="tar"></span></td>
        
      </tr>


      <tr>
        <td>To</td>
        <td><input type="email" name="email" placeholder="Enter Recipient Email Id" class="form-control"></td>
        
      </tr>

      <tr>
        <td>Subject</td>
        <td><input type="text" name="subject" placeholder="Subject" class="form-control"></td>
      </tr>

      <tr>
        <td>Your Name</td>
        <td><input type="text" name="name" placeholder="Your Name" class="form-control"></td>
      </tr>


      <tr>
        <td>Message</td>
        <td>

               
          <textarea name="message" id="text" placeholder="Write Your Message Here" class="form-control" ></textarea>
          <script>CKEDITOR.replace( 'text' );</script>
        </td>
      </tr>

      <tr>
        <td>Attachment</td>
        <td><input type="file" name="file[]"  id="img" class="form-control" multiple="multiple" onchange="validateImage()"></td>
      </tr>

      <tr>
        <td><a href="logout.php"><input type="button" value="Sign out" class="btn-danger"></a></td>

        <td><input type="submit" value="Send Mail" name="submit" class="btn-success"></td>
      </tr>

    </tbody>
  </form>
</table>

<script type="text/javascript">
function validateImage() {
    var formData = new FormData();

    var file = document.getElementById("img").files[0];

    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "gif" && t != "pdf") {
        alert('Please select a valid  file');
        document.getElementById("img").value = '';
        return false;
    }
    if (file.size > 5242880) {
        alert('Max Upload size is 5MB only');
        document.getElementById("img").value = '';
        return false;
    }
    return true;
}


   function tt()
  {
   var d=new Date();
   var t=d.getHours()+":"+ d.getMinutes()+":"+ d.getSeconds()+" / "+ d.toDateString() ;
   document.getElementById("tar").innerHTML=t;  
  }

</script>
<style>
html,
body{
 height: 100%;
}

#cover {
  background: #222 url('') center center no-repeat;
  background-size: cover;
  height: 100%;
  text-align: center;
  display: flex;
  align-items: center;
}

#cover-caption {
  width: 100%;
}
</style>
</body>
</html>
