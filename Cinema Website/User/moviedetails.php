<?php include("connectionn.php");

if(isset($_POST['submit']))
{   
 $showtime=$_POST['showtimeid'];
}

$result=mysqli_query($connect,"SELECT * from movies");

	if(isset($_GET['mid']))
	{
    $mid=$_GET['mid'];
    session_start();
    if(isset($_SESSION["mib"]))
    {
    $mib=$_SESSION["mib"];
    $result2=mysqli_query($connect,"SELECT * from member where member_id='$mib' ");
    $row2=mysqli_fetch_assoc($result2);
    $check=mysqli_query($connect,"SELECT * FROM wishlist WHERE member_id='$mib' AND mov_id='$mid'");
    $rowcheck=mysqli_fetch_assoc($check);
    }

    
		$result = mysqli_query($connect, "select * from movies where mov_id=$mid ");
		$row = mysqli_fetch_assoc($result);
    $score=mysqli_query($connect,"select AVG(rev_score) as avg_score FROM reviews where mov_id=$mid");
    $total=mysqli_fetch_assoc($score);
  
if(isset($_POST['add']))
{

$stat=$_POST['check'];

if(mysqli_num_rows($check)>0)
{mysqli_query($connect,"UPDATE wishlist SET check_stat='$stat' WHERE mov_id='$mid' AND member_id='$mib' ");
header("Refresh:1");}
else
{mysqli_query($connect,"INSERT INTO wishlist(mov_id,member_id,check_stat)VALUES('$mid','$mib','$stat')");
header("Refresh:1");}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="productstyles.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" href="favicon.ico?v=1" type="image/x-icon"/><title>FreshPeeks</title>
</head>
<script src="https://kit.fontawesome.com/e2277e6a95.js" crossorigin="anonymous"></script>
<style>

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
*{font-family:'Inter',sans-serif;}


body{
  background-image:url('<?php echo $row['background']?>');
  background-position:center;
  background-repeat:no-repeat;
  background-size:cover;
  width:100%;
  position:relative;
  box-shadow:inset 600px -200px 1000px rgba(0,0,0,1);
  transition:margin-left .5s;
  padding:20px;
}

i{margin-left:10px;}

.summary{
    text-align:left;
    color:white;
    padding-top:15px;
    padding-left:10px;
}

#logout:hover{
    color:red;
    text-decoration:underline;
  }

</style>


<body>

<div id="sidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-xmark"></i></a>
<a>

<?php 
  if(isset($_SESSION["mib"]))
  {
    echo $row2['member_name'];?>
    <a id="logout" href="logout.php">Logout</a>
    <a id="link" href="wishlist.php">Wishlist</a>
  <?php
  }
  else {
  ?>
    <a href="login.php">Login</a>
<?php
  }
  ?>
</a>
<a href="menumovie.php">Home</a>
<a href="#">About</a>
<a href="#">Contact</a>
</div>




<button class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars-staggered"></i></button>
<div class="row">

<div class="column" data-aos="fade-right">
  <div class="card">
 
   
<h1 id="main-title">
 <?php echo $row['mov_name']?>
</h1>

<h2 id="score_percent">Score : <?php echo number_format($total['avg_score'],2)*20 ?>%</h2>

<p class="summary"><?php echo $row['mov_info'];}?></p>

<div id="select-container">
<form method="post">
<label for="showtimeid">Showtime : </label>
<select name="showtimeid" id="showtimeid" required>
<?php 
$tsql=mysqli_query($connect,"SELECT * FROM showtime where mov_id=$mid");
while($row_time=mysqli_fetch_assoc($tsql)){?>
<option value="<?php echo $row_time['showtime_id']?>"><?php echo date('h:i A',strtotime($row_time['show_start']))?></option>
<?php }?>
<input type="submit" value="Choose" name="submit" id="submit">
</select>
</form>

<?php if(isset($mib)){?>
<form method="post" id="form">
<label for="check">Add to wishlist : </label>
<input type="hidden" name="check" value="0">
<input type="checkbox" id="check" name="check" value="1" <?php if(isset($rowcheck)){if($rowcheck['check_stat'] == 1 ){ echo "checked='checked'"; } }?> >

<input type="submit" value="add" name="add" id="submit">
</form>
<?php }?>

</div>

<div id="button-container">
<button class="btn btn-primary shop-item-button" onclick="location.href='movieseats.php?mid=<?php echo $row['mov_id'];?>&stime=<?php echo $showtime;?>';check()">Buy<i class="fa-solid fa-ticket"></i></button>
<button class="btn btn-primary shop-item-button1" onclick="location.href='moviereview.php?mid=<?php echo $row['mov_id'];?>'">Review<i class="fa-solid fa-star"></i></button>
</div>

</div>
</div>

    <div class="columninfo" data-aos="fade-left">
      <div class="card">
        
    </div>
    </div>


</div>   

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script type="text/javascript">
    var count=0;
    AOS.init({
        offset:300,
        duration:900
    });

    function openNav() {
  document.getElementById("sidenav").style.width = "200px";
  document.querySelector("body").style.marginLeft="200px";
  document.querySelector(".openbtn").style.opacity="0";
}

function closeNav() {
  document.getElementById("sidenav").style.width = "0px";
  document.querySelector("body").style.marginLeft="0px";
  document.querySelector(".openbtn").style.opacity="1";
}

</script>

</body>
</html>




