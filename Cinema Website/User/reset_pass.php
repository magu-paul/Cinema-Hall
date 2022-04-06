<?php include("connectionn.php");?>

<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	

			<div>
				<form method="post" >
					<label for="check" aria-hidden="true">Change Password</label>
					<input type="email" id="login_email" placeholder="Email" name="login_email" required="">
					<input type="password" id="login_pass" placeholder="Password" name="pass" required="">
                    <input type="password" id="login_pass" placeholder="Repeat Password" name="re_pass" required="">
					<button name="reset" id="reset">Reset</button>
				</form>
			</div>
	</div>
</body>
</html>

<?php
if(isset($_POST['reset']))
{
  $db=mysqli_connect("localhost","root","","movie");

    $error="";
	$logemail=$_POST['login_email'];
	$pass1=$_POST['pass'];
    $pass2=$_POST['re_pass'];


    $query = mysqli_query($db,
    "SELECT * FROM `member` WHERE `member_email`='".$logemail."';"
    );
    $row = mysqli_num_rows($query);
    if ($row==""){
        $error .= '<h2>Invalid Link</h2>
      <p>The link is invalid/expired. Email is not recognized.</p>
      <p><a href="login.php">
      Click here</a> to register.</p>';
          }
          if ($pass1!=$pass2){
            $error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
              }
              if($error!=""){
                echo "<div class='error'>".$error."</div><br />";
                }else{
                
                mysqli_query($db,
                "UPDATE `member` SET `password`='".$pass1."' 
                WHERE `member_email`='".$logemail."';"
                );

                echo '<script>alert("Successfully Updated Password Login with The New Password")</script>';
		echo("<script>location.href='login.php'</script>");
	  }	



}
?>