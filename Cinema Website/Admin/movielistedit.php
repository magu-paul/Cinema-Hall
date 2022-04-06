<?php include("connectionn.php")?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Movies</title>
    <link rel="stylesheet" href="animate.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://kit.fontawesome.com/e2277e6a95.js" crossorigin="anonymous"></script>
</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Fredoka&display=swap');
*{font-family:'Inter',sans-serif;}    

#sidenav
   {
        background-color:#ffffff;
        width:200px;
        height:100%;
        position: fixed;
        z-index: 1;
        box-shadow:6px 1px 20px rgba(69, 65, 78, 0.1);
        top:0;
        left:0;
        border-right: 1px solid #eee;
        overflow-x:hidden;
    }
	
	#links
	{
		list-style:none;
		padding:0;
    margin:0;	
    align-items: center;	
	}

  #active{
    transition:0.3s ease;
    font-size: 25px;
    color:black;
    border-bottom: 1.5px solid #eee;
    padding:20px 20px 20px 15px;
    margin-bottom: 20px;
    font-family: 'Fredoka', sans-serif;
}

li i{font-size:16px;margin-right:10px;}

#active i{
    color:#007bff;
}

#active_link{
    border-left:#007bff 3px solid;
    color:#007bff;
}
	
	li a
	{
		display:block;
		color:#83848a;
		font-size:16px;
        font-weight:600;
		text-decoration:none;
		padding:15px 20px;
	}
	
  li a:hover
	{
	color:#3b7ddd;
  transition:0.3s ease;
	}
	
    #logout{
  color:red;
}

#logout:hover{
  text-decoration: underline;
}
	
	
    #main{
        margin-left:150px;
        padding:0px 10px;
    }

::-webkit-scrollbar{
    width:0.25rem; 
}

::-webkit-scrollbar-thumb{
    background:#3b7ddd;
    opacity:0.65;
    border-radius: 1.5px;
}

::-webkit-scrollbar-track{
    background:white;
    opacity:0;
}

body,html{
    height:100%;
    margin:0;
    background-color:#f5f7fb;
}

#pageHeader{
font-size:30px;
color:#3b7ddd;
font-weight:bold;
display:block;
margin:0 auto;
width:89%;
padding-top:37px;
}

form{
    margin:0 auto;
    width:89%;
    padding:20px;
}

#middle *{
    vertical-align:middle;
}

#submit{
    text-decoration:none;
    color:white;
    background-color:#3b7ddd;
    padding:9px 20px;
    display:block;
    border-radius:20px;
    font-size:15px;
    font-weight:bold;
    border:3px solid #3b7ddd;
}

#submit:hover{
    border:3px solid #3b7ddd;
    color:#3b7ddd;
    background-color:transparent;
    transition:0.1s ease-in-out;
}


</style>

<body>

<div id="sidenav"></div>

<script>
$(function(){
  $("#sidenav").load("navigation.html");
});
</script>

<div id="main">
<div id="pageHeader">Edit Movie</div>

<?php
		if(isset($_GET["movid"]))
		{
		    $mid=$_GET["movid"];
			$result = mysqli_query($connect, "SELECT * from movies where mov_id=$mid");
			$row = mysqli_fetch_assoc($result);
?>

<form name="addmovie" method="post" action="" accept-charset="utf-8">

<label for="movie_name">Movie Name :</label>
<input type="text" name="movie_name" id="movie_name"  value="<?php echo $row['mov_name']?>">
<br><br>
<label for="movie_poster">Movie Poster :</label>
<input type="text" name="movie_poster" id="movie_poster"  value="<?php echo $row['mov_poster']?>">

<label for="background">Background image :</label>
<input type="text" name="background" id="background"  value="<?php echo $row['background']?>">

<p id="middle">
<label for="movie_info">Movie Info :</label>
<textarea rows="4" cols="50" name="movie_info" id="movie_info" ><?php echo $row['mov_info']?></textarea>
</p>


<p><input type="submit" name="upload" value="Update" id="submit">

</form>
<?php } ?>


</div>
</body>
</html>

<?php
if(isset($_POST['upload']))
{   
    $mvname = mysqli_real_escape_string($connect,$_POST["movie_name"]);
	$mvposter=mysqli_real_escape_string($connect,$_POST["movie_poster"]);
    $mvinfo = mysqli_real_escape_string($connect,$_POST["movie_info"]);
    $background = mysqli_real_escape_string($connect,$_POST["background"]);

    mysqli_query($connect,"UPDATE movies SET mov_name='$mvname',mov_poster='$mvposter',background='$background',mov_info='$mvinfo' WHERE mov_id='$mid'");
    echo("<script>alert('Update is saved');</script>");
    echo("<script>location.href='movielist.php'</script>");
}
?>






