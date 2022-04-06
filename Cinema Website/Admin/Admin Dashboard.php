<?php 
include("connectionn.php");
$sum=mysqli_query($connect,"SELECT SUM(booking_price) AS count FROM booking");
$row_sum=mysqli_fetch_assoc($sum);
$screening=mysqli_query($connect,"SELECT * FROM movies");
$count=mysqli_num_rows($screening);
$member=mysqli_query($connect,"SELECT * FROM member");
$count_member=mysqli_num_rows($member);
$max=mysqli_query($connect,"SELECT mov_name,SUM(booking_price) FROM booking,movies WHERE booking.movie_id=movies.mov_id GROUP BY mov_name ORDER BY SUM(booking_price) DESC limit 1");
$max_row=mysqli_fetch_assoc($max);

?>
<!DOCTYPE html>

<head>
  <title>Admin Dashboard</title>
<link rel="stylesheet" href="styleadmin.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://kit.fontawesome.com/e2277e6a95.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<style>
i{font-size:25px;margin-right:10px}
</style>
<body style="background-color:#f5f7fb;">

<div id="sidenav"></div>

<script>
$(function(){
  $("#sidenav").load("navigation.html");
});
</script>

<div style="font-size:30px;color:#3b7ddd;font-weight:bold;display:block;margin:0 auto;width:70%;padding-top:37px">Admin Dashboard</div>
  <div class="cardBox">
    <div class="card">
      <div>
        <div class="cardName"><i class="fa-solid fa-money-bill-trend-up"></i>Earnings</div>
        <div class="numbers">RM<?php echo number_format($row_sum['count'],2)?></div>
      </div>

    </div>
      <div class="card">
      <div>
        <div class="cardName"><i class="fa-solid fa-fire"></i>Popular</div>
        <div class="numbers"><?php echo $max_row['mov_name'] ?></div>
      </div>
    </div>

      <div class="card">
      <div>
        <div class="cardName"><i class="fa-solid fa-film"></i>Screening Now</div>
        <div class="numbers"><?php echo $count?></div>
      </div>
    </div>

      <div class="card">
      <div>
        <div class="cardName"><i class="fa-solid fa-user-check"></i>Members</div>
        <div class="numbers"><?php echo $count_member?></div>
      </div>
    </div>

  </div>

<div class="cardBox_chart">

  <div class="card_chart">
  <div id="piechart" style="width: 500px; height: 300px;"></div>
  </div>

  <div class="card_chart">
  <div id="curve_chart" style="width: 500px; height: 300px"></div>
  </div>

</div>


</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
   
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Movie', 'Sales'],
          <?php 
          $sql=mysqli_query($connect,"SELECT movie_id,SUM(booking_price) FROM booking GROUP BY movie_id");
          while($row=mysqli_fetch_assoc($sql))
          {
            echo "['".$row["movie_id"]."', ".$row["SUM(booking_price)"]."],";
          }?>
        ]);

        var data2 = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          <?php 
          $sql_sales=mysqli_query($connect,"SELECT booking_date,SUM(booking_price) FROM booking GROUP BY booking_date");
          while($row_sales=mysqli_fetch_assoc($sql_sales))
          {
            echo "['".$row_sales["booking_date"]."', ".$row_sales["SUM(booking_price)"]."],";
          }?>
        ]);

        var options = {
          title: 'Total Revenue By Movies'
        };

        var options2 = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart2.draw(data2, options2);
        chart.draw(data, options);
      }

   
</script>

</html>
  