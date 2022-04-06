<?php
include("connectionn.php");

$msql=mysqli_query($connect,"SELECT * from movies");
$bsql=mysqli_query($connect,"SELECT * from hall");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Showtime</title>
    <link rel="stylesheet" href="animate.css">
    <script type="text/javascript">
    function confirmation(){
	var answer=confirm("Are you sure you want to delete?");
	return answer;}
    </script>
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
        margin-left:200px;
        padding:0px 10px;
    }

body,html{
    height:100%;
    margin:0;
    background-color:#f5f7fb;
    overflow-x:hidden;
}

#pageHeader{
font-size:30px;
color:#3b7ddd;
font-weight:bold;
display:block;
margin:0 auto;
width:99%;
padding-top:37px;
}

form{
    margin:0 auto;
    width:99%;
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
    
.table{
overflow:auto;
height:300px;
width:99%;
border-radius:12px;
}

.table thead th{
    position:sticky;
    top:0;
    z-index:1;
    background-color:#393939;
    color:#3b7ddd;
}

table
{  
border-collapse: collapse;
width: 89%;
box-shadow: 0 0 .875rem 0 rgba(33,37,41,.05);
margin: 0 auto;
}

th,td{padding:8px 16px;text-align:center;}

tr{
    color:#7e7b72;
    background-color: #222222;
}

table tr:first-child th:first-child{
    border-top-left-radius:12px;
}

table tr:first-child th:last-child{
    border-top-right-radius:12px;
}

table tr:last-child td:first-child{
    border-bottom-left-radius:12px;
}

table tr:last-child td:last-child{
    border-bottom-right-radius:12px;
}

.table::-webkit-scrollbar{
    width:0.25rem; 
}

    .table::-webkit-scrollbar-thumb{
    background:#1b1b1b;
    opacity:0.65;
    border-radius: 1.5px;
    }
    .table::-webkit-scrollbar-track{
    background:white;
    opacity:0;
    }

table tr:first-child th:first-child{
    border-top-left-radius:12px;
  }

  table tr:first-child th:last-child{
    border-top-right-radius:12px;
  }

  table tr:last-child td:first-child{
    border-bottom-left-radius:12px;
  }

  table tr:last-child td:last-child{
    border-bottom-right-radius:12px;
  }

  .buttonDelete{
    text-decoration:none;
    color:white;
    background-color:red;
    padding:5px 12px;
    display:block;
    border-radius:9px;
    border:2px solid red;
}

.buttonDelete:hover{
    border:2px solid red;
    color:red;
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
<div id="pageHeader">Manage Showtime</div>

<form name="addshowtime" method="post" enctype="multipart/form-data">

<label for="showtime">Showtime : </label>
<input type="time" name="showtime" id="showtime" min="09:00" max="23:00" required>
<br><br>

<label for="showend">Show End : </label>
<input type="time" name="showend" id="showend" min="09:00" required>

<p id="middle">

<label for="movie">Movie : </label>
<select name="movie" id="movie">
<?php 
while($row_movie=mysqli_fetch_assoc($msql)){?>

<option value="<?php echo $row_movie['mov_id']?>"><?php echo $row_movie['mov_name']?></option>
<?php }?>
</select>


<p><input type="submit" name="upload" value="Add" id="submit">

</form>

<form name="addhall" method="post" enctype="multipart/form-data">

<label for="hall">Hall No :  </label>
<select name="hall" id="hall">
    <option value="1">Hall 1</option>
    <option value="2">Hall 2</option>
    <option value="3">Hall 3</option>
    <option value="4">Hall 4</option>
    <option value="5">Hall 5</option>
    <option value="6">Hall 6</option>
</select>

<label for="showtimeid">Showtime : </label>
<select name="showtimeid" id="showtimeid">
<?php 
$sql=mysqli_query($connect,"SELECT * FROM showtime JOIN movies ON showtime.mov_id=movies.mov_id");
$tsql=mysqli_query($connect,"SELECT * FROM showtime JOIN movies ON showtime.mov_id=movies.mov_id");
while($row_time=mysqli_fetch_assoc($tsql)){?>
<option value="<?php echo $row_time['showtime_id']?>"><?php echo $row_time['mov_name'];echo "&nbsp"?><?php echo date('h:i A',strtotime($row_time['show_start']))?></option>
<?php }?>
</select>

<p><input type="submit" name="upload_hall" value="Add" id="submit">

</form>

<div class="table">
<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Movie</th>
        <th>Show Start</th>
        <th>Show End</th>
        <th colspan="2">Action</th>
    </tr> 
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($sql)){?>

<tr>
    <td><?php echo $row['showtime_id']?></td>
    <td><?php echo $row['mov_name']?></td>
    <td><?php echo $row['show_start']?></td>
    <td><?php echo $row['show_end']?></td>
	<td><a class="buttonDelete" href="manageshowtime.php?sid=<?php echo $row['showtime_id'];?>" onclick="confirmation();">Delete</a></td>
</tr>

<?php }?>
</tbody>
</table>
</div>

</div>
</body>
</html>

<?php

if(isset($_POST['upload']))
{   

	$db=mysqli_connect("localhost","root","","movie") or die("Couldn't connect to the server");

    $showtime=$_POST['showtime'];
    $showend=$_POST['showend'];
    $movie=$_POST['movie'];

    $sqladd1="INSERT INTO showtime(mov_id,show_start,show_end)VALUES('$movie','$showtime','$showend')";
    
	if(mysqli_query($db,$sqladd1))
	{
		echo '<script>alert("Record Saved");</script>';
	}    

}

if(isset($_POST['upload_hall']))
{
    $db=mysqli_connect("localhost","root","","movie") or die("Couldn't connect to the server");

    $hall=$_POST['hall'];
    $showid=$_POST['showtimeid'];

    $check=mysqli_query($connect,"SELECT * FROM hall WHERE hall_no='$hall' AND showtime_id='$showid' ");
    
    if(mysqli_num_rows($check)>0)
    {
      echo "<script>alert('This hall and showtime already exists')</script>";
    }
    else
    {
        $sqladd2="INSERT INTO hall(hall_no,showtime_id)VALUES('$hall','$showid')";
    
        if(mysqli_query($db,$sqladd2))
        {
            echo '<script>alert("Record Saved");</script>';
        }    
        else
            echo '<script>alert("Record not saved.Try again");</script>';
    }
 
}

if(isset($_REQUEST["sid"]))
{
    $sid=$_REQUEST["sid"];

    mysqli_query($connect,"DELETE FROM showtime WHERE showtime_id='$sid' ");
    echo("<script>location.href='manageshowtime.php'</script>");
}
?>








