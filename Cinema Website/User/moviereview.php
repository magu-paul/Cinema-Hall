<?php include("connectionn.php");

session_start();
if(isset($_SESSION["mib"]))
{
  $mib=$_SESSION["mib"];
  $result2=mysqli_query($connect,"SELECT * from member where member_id='$mib' ");
  $row2=mysqli_fetch_assoc($result2);
}

if(isset($_GET['mid']))
{
    $mid=$_GET['mid'];
    $moviename=mysqli_query($connect,"select * from movies where mov_id=$mid");
    $result=mysqli_query($connect,"select * from reviews where mov_id=$mid");
    $count=mysqli_num_rows($result);
    $score=mysqli_query($connect,"select AVG(rev_score) as avg_score FROM reviews where mov_id=$mid");
    $total=mysqli_fetch_assoc($score);
}
while($row=mysqli_fetch_assoc($moviename)){

?>

<!DOCTYPE html>

<head>
    <link rel="icon" href="favicon.ico?v=1" type="image/x-icon"/><title>FreshPeeks</title>
    <link rel="stylesheet" href="stylereview.css">
</head>
<script src="https://kit.fontawesome.com/e2277e6a95.js" crossorigin="anonymous"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
*{font-family:'Inter',sans-serif;padding:0;margin:0;box-sizing: border-box;} 

.row::-webkit-scrollbar{
    width:0.25rem; 
}

.row::-webkit-scrollbar-thumb{
    background:#F50057;
    opacity:0.65;
    border-radius: 1.5px;
}

.row::-webkit-scrollbar-track{
    opacity:0;
}

  .box{
      text-align: justify;
      padding:15px 10px;
      float:left;
      margin:10px;
      display:flex;
	    flex-wrap:wrap;
      border-radius:15px;
      background-color:white;
  }
  
  .info{
      font-size: 20px;color:black;font-weight:500;
  }

  body,html{
    min-height:100vh;
    background-color: white;
    background-size: cover;
    overflow-x:hidden;
}

  .row{width:500px;height:600px;margin:20px 40px auto;float:left;overflow-x: hidden;overflow-y: scroll;padding:20px;background:black}

  .row:after{
      content:"";
      display: table;
      clear: both;
  }

#right{
    float:right;
    margin:100px auto;
    width:50%;
    color:black;
    position:relative;
}

h1{
text-align:center;
}

label{
    font-size:20px;
}

input[type=submit]
{
    padding:10px 30px;
      border-radius: 20px;
      background-color: #F50057;
      border:3px solid #F50057;
      font-weight: bolder;
      color:white;
      margin-top: 10px;
      cursor: pointer;
	  text-decoration:none;
      transition: 0.1s ease-in-out;
}

input[type=submit]:hover{
    background-color: transparent;
    border:3px solid #F50057;
    color:#F50057;
}

#rev_det,#rev_score{
    margin:30px;
    padding:10px;
}

#rating{
    padding:20px 0px 20px 0px;
}

.sidenav{
    height:100%;
    width:0;
    position:fixed;
    z-index:1;
    top:0;
    left:0;
    background-color:#1b1b1b;
    overflow-x: hidden;
    padding-top: 60px;
    transition: 0.5s;
}

.sidenav a{
    padding:8px 8px 8px 32px;
    text-decoration: none;
    color:white;
    font-size: 25px;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover{
    color:#fc007a;
}

.sidenav .closebtn{
    position: absolute;
    top:0;
    right:25px;
    font-size: 36px;
    margin-left: 50px;
}

.openbtn{
    font-size: 35px;
    cursor: pointer;
    background-color: transparent;
    padding:15px;
    border:none;
    transition: 0.2s ease-in-out;
}

  body{
    transition:margin-left .5s;
  }

  #logout:hover{
    color:red;
    text-decoration:underline;
  }

  i{margin-left:10px;}


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

<h1 style="color:black;text-align:center;margin-top:-20px;margin-bottom:10px"><?php echo $row['mov_name'];?></h1>

<?php } ?>



<div class="row"><h1 id="notify" style="color:white;text-align:center;position:relative;">Reviews</h1>
<?php
if($count==0)
echo "<script>document.getElementById('notify').innerHTML='Its empty here :('</script>";
else{
while($row=mysqli_fetch_assoc($result)){
?>

<div class="box">
<p class="info">
      <span style="font-weight:bold;">Review :</span> 
      <?php 
      echo $row['rev_detail'];echo " ";?><br> <span style="font-weight:bold;">Score : <?php echo $row['rev_score']
      ?>
      </span>
</p>
</div>
<?php }}?>
</div>

<div id="right">
<h1 style="text-align:justify;font-size:25px;">Movie Rating : <?php echo number_format($total['avg_score'],2);echo"/5"?></h1>
<form name="review" method="post">
<label for="rev_det">Review</label>
<textarea rows="2" cols="30" name="rev_det" id="rev_det" style="margin-bottom:-30px" placeholder="Share your thoughts"></textarea><br><br>

<div id="rating">
<label for="rev_score">Rating </label>
<input type="radio" id="radio1" name="rev_score" value=1>
<label for ="radio1">1</label>
<input type="radio" id="radio2" name="rev_score" value=2>
<label for ="radio2">2</label>
<input type="radio" id="radio3" name="rev_score" value=3>
<label for ="radio3">3</label>
<input type="radio" id="radio4" name="rev_score" value=4>
<label for ="radio4">4</label>
<input type="radio" id="radio5" name="rev_score" value=5>
<label for ="radio5">5</label>
</div>

<input type="submit" id="button" name="upload" value="Post Review" style="margin-top:-100px">
</form>
</div>

<script type="text/javascript">

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

<?php 
if(isset($_POST['upload']))
{   

  if(isset($_POST['rev_score']) && isset($_POST['rev_det']))
  {
    $mid = $_GET['mid'];
    $revdet = mysqli_real_escape_string($connect,$_POST["rev_det"]);  
    $revscore=$_POST["rev_score"];
  }
  else
  {
    echo('<script>alert("You cannot leave it as blank")</script>');
    return;
  }
  
  mysqli_query($connect,"INSERT INTO reviews(rev_detail,rev_score,mov_id)VALUES('$revdet','$revscore','$mid')");
  echo("<script>location.href='moviereview.php?mid=$mid'</script>");
}
?>
