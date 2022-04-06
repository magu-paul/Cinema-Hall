<?php include("connectionn.php");?>

<!DOCTYPE html>
<html>
<head>
	<title>Login/Sign Up</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="check" aria-hidden="true">

			<div class="login">
				<form method="post">
					<label for="check" aria-hidden="true">User Name</label>
					<input type="text" id="login_email" placeholder="User Name" name="user_name" require>
					
					<button name="reset_name" id="login">NEXT</button>
				</form>
				
				
			</div>
			
	</div>
</body>
</html>
<?php
if(isset($_POST['reset_name']))
{
  $db=mysqli_connect("localhost","root","","movie");

    $error="";
	$name=$_POST['user_name'];
	


    $query = mysqli_query($db,
    "SELECT * FROM `member` WHERE `member_name`='".$name."';"
    );
    $row = mysqli_num_rows($query);
    if ($row==""){
		echo '<script>alert("User Name not available")</script>';
          }else{
			alert('Name successfully found');
			header("Location: reset_pass.php?success=registered");
			exit();
		  }
    }
?>