<?php include("connectionn.php");
session_start();
if(isset($_GET['mid']) AND isset($_GET['stime']))
  {
	  $mid=$_GET['mid'];
	  $stime=$_GET['stime'];
  }
?>

<!DOCTYPE html>

<head>
   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="favicon.ico?v=1" type="image/x-icon"/><title>FreshPeeks</title>
 </head>
 
 <style>
 @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400&display=swap');

*{
box-sizing:border-box;
font-family: 'Open Sans',sans-serif;
}

p{color:white;}

body{
background-color:#1b1b1b;
display:flex;
flex-direction:column;
justify-content:center;
height:100vh;
margin:0;
align-items:center;
}

#container{
margin-bottom:30px;
}


.screen{
	background-color:#fff;
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

.occupy input[type="checkbox"]:disabled + label{
  background:#ddd;
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

.title{
	font-size:40px;
	transform:translateY(-30px);
	color:white;
	font-family:'Roboto Mono';
}

.sub{
	font-size:20px;
	transform:translateY(-20px);
	color:white;
	font-family:'Roboto Mono';
}

#button1{
	opacity:0;
}



 </style>
 
 
 <body>

<?php 
$result=mysqli_query($connect,"SELECT * from movies");
$count=mysqli_num_rows($result);
?>

  <?php 
	  if(isset($_GET['mid']))
	  {
		  $mid=$_GET['mid'];
		  $result = mysqli_query($connect, "select * from movies where mov_id=$mid ");
		  $row = mysqli_fetch_assoc($result); 
		  $result2=mysqli_query($connect,"SELECT * FROM hall JOIN showtime ON hall.showtime_id=showtime.showtime_id where showtime.showtime_id=$stime");
		  $row2=mysqli_fetch_assoc($result2);
		  $resultseat=mysqli_query($connect,"SELECT * FROM seat JOIN hall ON seat.hall_id=hall.hall_id where hall.showtime_id=$stime");
		  
	      if($resultseat == null || mysqli_num_rows($resultseat) <= 0){ ?>
            <script type="text/javascript">
				alert("There's no hall available for this showtime yet");
				window.location.href = 'menumovie.php';
			</script>
		  <?php } 
	
		  $hallid= $row2['hall_id'];
	  }
	   ?>

	   <span class="title"><?php echo $row['mov_name'];?></span>
	   <span class="sub"><b>Hall <?php echo $row2['hall_no'];?></b> <?php echo date('h:i A',strtotime($row2['show_start']))?></span>

<div id="container">
 <form name="movieform" method="POST">
    <div class="screen"></div>

<div class="row">
   	<ol class="seats" type="A">
		  <?php 
		    do{$seats=mysqli_fetch_assoc($resultseat);
			  if($seats['seat_status']=='1'){?>
		    <li class="seat occupy">
			<input type="checkbox" class="checks" id="<?php echo $seats['seat_no']?>" value="<?php echo $seats['seat_no']?>" name="checkbox[" disabled/>
			<label for="<?php echo $seats['seat_no']?>"><?php echo $seats['seat_no']?></label>
			</li>
			<?php }else if ($seats['seat_status']=='0'){?>
			<li class="seat">
			<input type="checkbox" class="checks" id="<?php echo $seats['seat_no']?>" value="<?php echo $seats['seat_no']?>" name="checkbox[]"/>
			<label for="<?php echo $seats['seat_no']?>"><?php echo $seats['seat_no']?></label>
			</li>
		  <?php }}while($seats['seat_no']!='1F');?>
		</ol>
</div>

<div class="row">
   	<ol class="seats" type="A">
		  <?php 
		    do{$seats=mysqli_fetch_assoc($resultseat);
			  if($seats['seat_status']=='1'){?>
		    <li class="seat occupy">
			<input type="checkbox" class="checks" id="<?php echo $seats['seat_no']?>" value="<?php echo $seats['seat_no']?>" name="checkbox[" disabled/>
			<label for="<?php echo $seats['seat_no']?>"><?php echo $seats['seat_no']?></label>
			</li>
			<?php }else if ($seats['seat_status']=='0'){?>
			<li class="seat">
			<input type="checkbox" class="checks" id="<?php echo $seats['seat_no']?>" value="<?php echo $seats['seat_no']?>" name="checkbox[]"/>
			<label for="<?php echo $seats['seat_no']?>"><?php echo $seats['seat_no']?></label>
			</li>
		  <?php }}while($seats['seat_no']!='2F');?>
		</ol>
</div>

<div class="row">
   	<ol class="seats" type="A">
		  <?php 
		    do{$seats=mysqli_fetch_assoc($resultseat);
			  if($seats['seat_status']=='1'){?>
		    <li class="seat occupy">
			<input type="checkbox" class="checks" id="<?php echo $seats['seat_no']?>" value="<?php echo $seats['seat_no']?>" name="checkbox[" disabled/>
			<label for="<?php echo $seats['seat_no']?>"><?php echo $seats['seat_no']?></label>
			</li>
			<?php }else if ($seats['seat_status']=='0'){?>
			<li class="seat">
			<input type="checkbox" class="checks" id="<?php echo $seats['seat_no']?>" value="<?php echo $seats['seat_no']?>" name="checkbox[]"/>
			<label for="<?php echo $seats['seat_no']?>"><?php echo $seats['seat_no']?></label>
			</li>
		  <?php }}while($seats['seat_no']!='3F');?>
		</ol>
</div>

</div>


<div id="purchase">

<p>Ticket Type : 
<select id="tickettype" name="tickettype">
<option value="13">Adult</option>
<option value="9">Children</option>
<option value="7">Senior</option>
<option value="10">Student</option>
</select>

</div>
<p><span id="sums"></span></p>

<input type="submit" value="Confirm" id="submit" name="submit">
</form>
</body>
</html>



<?php 
if(!empty($_POST['checkbox'])){?>

    <div style="color:white">You chose

	<?php 
	foreach($_POST['checkbox'] as $seats)
	{
      echo $seats;echo" ";
	}
	
	$_SESSION['checkbox']=$_POST['checkbox'];
	?>
   </div>

         <script>
			document.getElementById("submit").style.display="none";
			document.getElementById("container").style.display="none";
			document.getElementById("purchase").style.display="none";
		    setTimeout(function(){ 
			var answer=confirm("Proceed to payment ? "); 
			if(answer)
			location.href='paymentpage.php?mid=<?php echo$row['mov_id'];?>';},400);
         </script>
<?php 
}

if(isset($_POST['submit']))
{
	if(!empty($_POST['checkbox']))
{
	foreach($_POST['checkbox'] as $seat)
    {
		$status=1;
        mysqli_query($connect,"UPDATE seat SET seat_status='$status' WHERE hall_id='$hallid' and seat_no='$seat'");
    }
	$price=$_POST['tickettype'];
	$checked_arr=$_POST['checkbox'];
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$now=date('y-m-d');
	$count =count($checked_arr);
	$total=(($price*$count)*0.08)+($price*$count);
	
	if(isset($_SESSION["mib"]))
		$cid=$_SESSION["mib"];
	else
	    $cid=1;

	mysqli_query($connect,"INSERT INTO booking(booking_date,member_id,booking_price,movie_id) VALUES('$now','$cid','$total','$mid')");
	$bookid=mysqli_insert_id($connect);
    unset($_SESSION['bookid']);
    $_SESSION['hallid']=$row2['hall_id'];
	$_SESSION['bookid']=$bookid;
}
}
?>





