<?php include("connectionn.php");
session_start();

if(isset($_SESSION["mib"]))
{
  $mib=$_SESSION["mib"];
  $result=mysqli_query($connect,"SELECT * FROM wishlist LEFT JOIN movies ON wishlist.mov_id=movies.mov_id where member_id='$mib' and check_stat=1 ");
  $member=mysqli_query($connect,"SELECT * FROM member WHERE member_id='$mib' ");
  $row=mysqli_fetch_assoc($member);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylemenu.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" href="favicon.ico?v=1" type="image/x-icon"/><title>FreshPeeks</title>
</head>
<script src="https://kit.fontawesome.com/e2277e6a95.js" crossorigin="anonymous"></script>
<style>

#hide{display:none}

body{ transition:margin-left .5s;
  padding:20px;}

i{margin-left:10px;}

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
    echo $row['member_name'];?>
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
<a href="#">About Us</a>
<a href="#">Contact</a>
</div>

<button class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars-staggered"></i></button>


<h1 style="font-size: 30px;color:white;text-align: center;margin-bottom:15px;">My Wishlist</h1>


<div class="row" data-aos="fade-in">

<?php
while($row=mysqli_fetch_assoc($result)){
?>
    
  <div class="column">
    <div class="card">
     <img src="<?php echo $row['mov_poster'];?>">
     <h1 class="info">
      <span class="shop-item-title"><div id="hide"><?php echo $row['mov_id']?></div></span>
      </h1>
     <button class="buttons" onclick="location.href='moviedetails.php?mid=<?php echo $row['mov_id'];?>'">View</a></button>
    </div>
  </div>

<?php } ?>
</div>  

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script type="text/javascript">
    var count=0;
    AOS.init({
        offset:300,
        duration:900
    });
   function openNav() {
  document.getElementById("sidenav").style.left = "0px";
  document.querySelector("body").style.marginLeft="250px";
  document.querySelector(".openbtn").style.opacity="0";
}

function closeNav() {
  document.getElementById("sidenav").style.left = "-300px";
  document.querySelector("body").style.marginLeft="0px";
  document.querySelector(".openbtn").style.opacity="1";
}
</script>
</body>
</html>