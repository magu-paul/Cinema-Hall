<?php include("connectionn.php");?>

<!DOCTYPE html>

<head>
   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Manage Seat</title>
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
	
*{
box-sizing:border-box;
font-family: 'Open Sans',sans-serif;
}

p{color:white;}

body{
background-color:#f5f7fb;
display:flex;
flex-direction:column;
justify-content:center;
height:100vh;
margin:0;
align-items:center;
}

#container{
margin-left:150px;
padding:0px 10px;
}


.screen{
	background-color:grey;
	height:80px;
	border-top-left-radius:20px;
	border-top-right-radius:20px;
	width:450px;
	margin:15px 0;
	transform:rotateX(-45deg);
	box-shadow:0 3px 10px rgba(255,255,255,0.7);
}

ol {
  list-style: none;
  padding: 0;
  margin: 0;
}

.seats {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  margin-right:-40px;
  justify-content: flex-start;
}
.seat{
  display: flex;
  flex: 0 0 14.28571%;
  padding: 5px;
  position: relative;
}
.seat:nth-child(3){
  margin-right: 20px;
}
.seat input[type="checkbox"]{
  position: absolute;
  opacity: 0;
}
.seat input[type="checkbox"]:checked + label{
  background: #fcad03;
}
.seat input[type="checkbox"]:disabled + label{
  background: #ddd;
  text-indent: -9999px;
  overflow: hidden;
}
.seat input[type="checkbox"]:disabled + label:after{
  content: "X";
  text-indent: 0;
  position: absolute;
  top: 4px;
  left: 50%;
  transform: translate(-50%, 0%);
}
.seat input[type="checkbox"]:disabled + label:hover{
  box-shadow: none;
  cursor: not-allowed;
}
.seat label {
  display: block;
  position: relative;
  width: 100%;
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  line-height: 2rem;
  padding: 4px;
  color: #fff;
  background:red;
  border-top-left-radius:10px;
  border-top-right-radius:10px;
}
.seat label:hover{
  cursor: pointer;
  box-shadow: 0px 0 7px 3px #ccc;
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

#button_submit{
	left:50%;
	right:50%;
}

 </style>
 
 
 <body>
 <div id="sidenav"></div>

<script>
$(function(){
  $("#sidenav").load("navigation.html");
});

</script>
	 
<div id="container">
 <form name="movieform" method="POST">
    <div class="screen"></div>

<div class="row">
   	<ol class="seats" type="A">
		  <li class="seat">
			<input type="checkbox" class="checks" id="1A" value="1A" name="checkbox[]"/>
			<label for="1A">1A</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="1B" value="1B" name="checkbox[]"/>
			<label for="1B">1B</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="1C" value="1C" name="checkbox[]"/>
			<label for="1C">1C</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="1D" value="1D" name="checkbox[]"/>
			<label for="1D">1D</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="1E" value="1E" name="checkbox[]"/>
			<label for="1E">1E</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="1F" value="1F" name="checkbox[]"/>
			<label for="1F">1F</label>
		  </li>
		</ol>
</div>
<div class="row">
   	<ol class="seats" type="A">
		  <li class="seat">
			<input type="checkbox" class="checks" id="2A" value="2A" name="checkbox[]"/>
			<label for="2A">2A</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="2B" value="2B" name="checkbox[]"/>
			<label for="2B">2B</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="2C" value="2C" name="checkbox[]"/>
			<label for="2C">2C</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" id="2D" class="checks" value="2D" name="checkbox[]"/>
			<label for="2D">2D</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="2E" value="2E" name="checkbox[]"/>
			<label for="2E">2E</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="2F" value="2F" name="checkbox[]"/>
			<label for="2F">2F</label>
		  </li>
		</ol>
</div>
<div class="row">
   	<ol class="seats" type="A">
		  <li class="seat">
			<input type="checkbox" class="checks" id="3A" value="3A" name="checkbox[]"/>
			<label for="3A">3A</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="3B" value="3B" name="checkbox[]"/>
			<label for="3B">3B</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="3C" value="3C" name="checkbox[]"/>
			<label for="3C">3C</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="3D" value="3D" name="checkbox[]"/>
			<label for="3D">3D</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="3E" value="3E" name="checkbox[]"/>
			<label for="3E">3E</label>
		  </li>
		  <li class="seat">
			<input type="checkbox" class="checks" id="3F" value="3F" name="checkbox[]"/>
			<label for="3F">3F</label>
		  </li>
		</ol>
</div>

</div>

<?php 
$hsql=mysqli_query($connect,"SELECT * FROM hall LEFT JOIN showtime on hall.showtime_id=showtime.showtime_id");
?>

<label for="hall">Hall</label>
<select name="hall" id="hall">
<?php while($row=mysqli_fetch_assoc($hsql)){?>
    <option value="<?php echo $row['hall_id']?>">Hall <?php echo $row['hall_no']?> at <?php echo date('h:i A',strtotime($row['show_start']))?></option>
<?php }?>
</select>

<div id="button_submit">
<input type="submit" value="Confirm" id="submit" name="submit">
<label><input type="checkbox" id="All"/>Choose all</label>
<script>
$("#All").change(function(){
	$("#container input[type=checkbox]").prop('checked', $(this).prop("checked"),true);
});
</script>
</div>
</form>

</body>
</html>



<?php 

if(isset($_POST['submit']))
{
    $hall=$_POST['hall'];
	$status=0;

    foreach($_POST['checkbox'] as $seats)
    {
        $sql=mysqli_query($connect,"INSERT INTO seat(seat_no,hall_id,seat_status)VALUES('$seats','$hall','$status')");
        $run=mysqli_query($connect,$sql);
    }

    if($run)
    {
        echo '<script>alert("Record Saved");</script>';
    }

    echo("<script>location.href='manageseat.php'</script>");
}
?>





