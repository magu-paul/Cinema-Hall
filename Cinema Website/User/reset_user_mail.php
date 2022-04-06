<?php include("connectionn.php");?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Email</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
	


			<div>
				<form method="post">
					<label for="check" >Change Email</label>
					<input type="email" id="login_email" placeholder="Email" name="email" required="">
                    <input type="text" id="New_name" placeholder="New User Name" name="new_uname" required="">
					<input type="password" id="login_pass" placeholder="Password" name="login_pass" required="">
					<button name="change" id="change">Change</button>
				</form>
				
			</div>
	</div>
</body>
</html>

<?php
if(isset($_POST['change']))
{
	$db=mysqli_connect("localhost","root","","movie");

	$email=$_POST['email'];
	$new_uname=$_POST['new_uname'];
	$logpass=$_POST['login_pass'];
	
	$msql=mysqli_query($db,"SELECT * from member where member_email='$email' and member_pass='$logpass'");



	if($row=mysqli_fetch_assoc($msql))
	{
		
		mysqli_query($db,
		"UPDATE `member` SET `member_name`='".$new_uname."' 
		WHERE `member_email`='".$email."';"
		);
		echo '<script>alert("Successfully Updated Email Login with The New Email")</script>';
		echo("<script>location.href='login.php'</script>");
	}
	else
	echo '<script>alert("Oops! email or Password is wrong.");</script>';

}
?>