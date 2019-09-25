<?php 
include('connection.php');
session_start();
extract($_POST);
if (isset($_POST['submit'])) 
{
if ( $email =="" || $password =="" ) 
 {
  $error_message="Fill all the fileds first"; 
  }
  else
  {
        $pass  = mysqli_real_escape_string($conn, $_POST['password']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
  $sql=mysqli_query($conn,"SELECT * from user where email='$email' and pass='$pass' ");//Checking Login Credential

  $r=mysqli_num_rows($sql);

 if($r==true)
  { 
$_SESSION['user']=$email;
               
             
//$success_message="Login Successful ";       
header("Location:mail.php");
}
else 
{

        $error_message="Invalid login Credential";
 }
}
}
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
    <link href="favicon.png" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 </head>
<body>
<section id="cover">
    <div id="cover-caption">
    	
    	 <h1 style="color: white">Admin Login</h1>
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
	<form method="post" class="form-inlin justify-content-center form-group">

	    <tbody>
      <tr>
        <td>User Name</td>
        <td><input type="email" name="email" placeholder="Enter Email Id" class="form-control" required="true"></td>
        
      </tr>

      <tr>
        <td>Password</td>
        <td><input type="Password" name="password" placeholder="Password" class="form-control" required="true"></td>
      </tr>


      <tr>
      	<td></td>
      	<td><input type="submit" value="Login" name="submit" class="btn-success"></td>
      </tr>

    </tbody>
	</form>
</table>
</div>
</section>
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
