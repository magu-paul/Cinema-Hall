<!DOCTYPE html>
<html>
<head>
	<title>Admin || Login Page</title>
	<link rel="stylesheet" type="text/css" href="styleadmin.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
		<div class="login-content">
			<form method="POST" action="Admin Dashboard.php">
				
				<h2 class="title">Admin Login</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<input type="text" name="username" placeholder="Username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input type="password" name="password" placeholder="Password">
            	   </div>
            	</div>
            	
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    
</body>
</html>

<?php 

include("connectionn.php");

if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$pass=$_POST['password'];

	$sql=mysqli_query($connect,"SELECT * from admin where admin_name='$username' and admin_pass='$pass' ");

	if($row=mysqli_fetch_assoc($sql))
	{
		session_start();
        $_SESSION["aid"]=$row["admin_id"];
		echo '<script>alert("Successfully Login");</script>';
		echo("<script>location.href='Admin Dashboard.php'</script>");
	}
	else
	echo '<script>alert("Details not match in database");</script>';

}

?>