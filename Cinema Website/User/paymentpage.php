<?php include("connectionn.php");
session_start();
if(isset($_REQUEST['mov_id']))
  {
	  $mid=$_REQUEST['mov_id'];
  }

?>

<!DOCTYPE html>

<head>
   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ticket</title>
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
height:100vh;
margin:0;
padding:0;
}

#right{
	float:left;
	margin-left: 40px;
}

#left{
	background-color:white;
	width:400px;
	display:block;
	height:100vh;
	float: left;
}

#left img{
	
	width:90%;
    margin-left:auto;
	margin-right:auto;
	margin-top: 30px;
	display: block;
	height:450px;
}

.textmain{
	text-align: center;
	font-size: 3rem;
	margin-top: 60px;
}

.column{
	display: flex;
	flex-wrap: wrap;
    margin:10px 16px;
}

.col50,.col25,.col75{
	padding:0 16px;
}

.col50{
	flex:50%;
}

label{
	margin-bottom: 10px;
	display: block;
	color:white;
}

input[type=text]{
	width:100%;
	margin-bottom: 20px;
	padding:12px;
	border:1px solid #6C63FF;
	border-radius: 3px;
}

.textMain{
	color:white;
	text-align: center;
	font-size: 3rem;
}

#textdetail{
	color:white;
	display:block;
	text-align: center;
	font-size: 3rem;
}

#textTicket{
	color:white;
	text-align: center;
	display:none;
	font-size: 3rem;
}

.textsub{
	text-align: center;
	color:#F50057;
	margin-top: -20px;
}

#btn{
	width:100%;
	color:white;
	background-color: #F50057;
	padding:12px;
	margin:10px 0;
	border:none;
	border-radius:3px;
	cursor:pointer;
	font-size: 17px;
}

#btn:hover{
	background-color: #e01e62;
	transition: ease-in-out 0.15s;
}

ul,ul li{
  padding:10px;
}

#print{
	opacity: 0;
}

#qrcode{
	display: block;
	margin:0 auto;
	width:50%;
}

#form{
	display:block;
}
 </style>

 
 <body>
	 
<div id="left">
	<h1 class="textmain">Checkout</h1>
	<h2 class="textsub">Just one little thing</h2>
	<img src="images/undraw_horror_movie_3988.svg">
</div>

<div id="right">

<div class="column" style="margin-top: 10px;">
 <div class="col50">
<form name="payment" method="POST" id="form">
	<h3 class="textMain">Payment Details</h3>

	<label for="full" name="full" id="full">Name on Card</label>
	<input type="text" id="full" name="fullname" placeholder="Joe Mama John Cena">

	<label for="creditno" name="creditno" id="creditno">Credit Card Number</label>
	<input type="text" id="creditno" name="creditno" placeholder="1111-2222-3333-4444">

	<label for="address" name="address" id="address">Exp Month</label>
	<input type="text" id="address" name="address" placeholder="September">


    <div class="column">

	     <div class="col50">
	     <label for="state" name="state" id="state">Exp Year</label>
	     <input type="text" id="city" name="city" placeholder="2077">
         </div>

	     <div class="col50">
	     <label for="zip" name="zip" id="zip">CVV</label>
	     <input type="text" id="zip" name="zip" placeholder="911">
         </div>

    </div><button id="btn" type="submit" name="button" onClick="newQR();">Checkout</button>
</div></form>


<div class="summary" style="flex:25%;width:400px;height:400px;padding-left: 20px;margin-left: 60px;">
	<div class="col50" >
	<h3 id="textdetail">Summary</h3>
	<h3 id="textTicket">Ticket</h3>
	<img id="qrcode" src=''>
	<div class="ticket" style="background-color: white;border-radius: 15px;">
	<ul style="list-style: none;">

	<?php 
	  if(isset($_GET['mid']))
	  {
		  $mid=$_GET['mid'];
		  $result = mysqli_query($connect, "select * from movies where mov_id=$mid ");
		  $row = mysqli_fetch_assoc($result);
		  $bookid=$_SESSION['bookid'];
		  $hallid=$_SESSION['hallid'];
		  $book=mysqli_query($connect, "SELECT * FROM booking JOIN movies on booking.movie_id=movies.mov_id where booking_id='$bookid' ");
		  $hall=mysqli_query($connect, "SELECT * FROM hall JOIN showtime on hall.showtime_id=showtime.showtime_id where hall_id='$hallid' ");
		  $row_hall=mysqli_fetch_assoc($hall);
		  $row_book=mysqli_fetch_assoc($book);
	   ?>
		<li><?php echo $row['mov_name'];?></li>
		<li>Seats:<?php foreach($_SESSION['checkbox'] as $seats){echo $seats;echo" ";}?></li>
		<li>Hall <?php echo $row_hall['hall_no'];?></li>
		<li>Showtime : <?php echo date('h:i A',strtotime($row_hall['show_start']))?></li>
		<?php } ?>
		<li>Total (inc 8%tax) :RM <?php echo $row_book['booking_price'];?></li>
		<li>Booking No:  <?php echo $row_book['booking_id'];?></li>
	</ul>	
	</div>

</div>
</div>
</div>


</body>
</html>

<?php 

if(isset($_POST['button']))
{


?>
	<script>
	        document.getElementById("left").style.display="none";
			document.getElementById("form").style.display="none";
			document.getElementById("textdetail").style.display="none";
			document.getElementById("textTicket").style.display="block";
			document.getElementById("right").setAttribute('style','transform:translateX(450px);transition: 0.3s ease-in-out');
            alert("Please take a screenshot of the ticket");
	function newQR() 
	  {
        var x = <?php echo $row_book['booking_id']?>;
        document.getElementById('qrcode').src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + x
      }
      newQR()
	</script>;
<?php
}
?>




