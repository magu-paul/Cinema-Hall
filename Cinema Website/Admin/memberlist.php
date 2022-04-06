<?php include("connectionn.php");?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
    <link rel="stylesheet" href="animate.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://kit.fontawesome.com/e2277e6a95.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    

function confirmation(){
	
	var answer=confirm("Are you sure you want to delete?");
	return answer;
}

</script>

	
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
    

.table{
    overflow:auto;
    height:540px;
    width:100%;
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
width: 100%;
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

body::-webkit-scrollbar{
    width:0.25rem; 
}

body::-webkit-scrollbar-thumb{
    background:#3b7ddd;
    opacity:0.65;
    border-radius: 1.5px;
}

body::-webkit-scrollbar-track{
    background:white;
    opacity:0;
}

body,html{
    height:100%;
    margin:0;
    background-color:#f5f7fb;
}

.buttonDelete{
    text-decoration:none;
    color:white;
    background-color:red;
    padding:5px 12px;
    display:block;
    text-align:center;
    border-radius:9px;
    border:2px solid red;
}

.buttonDelete:hover{
    border:2px solid red;
    color:red;
    background-color:transparent;
    transition:0.1s ease-in-out;
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

</style>

<body>

<div id="sidenav"></div>

<script>
$(function(){
  $("#sidenav").load("navigation.html");
});
</script>

<div id="main">
<div id="pageHeader">Member List</div>
<?php

$result=mysqli_query($connect,"SELECT * from member");
$count=mysqli_num_rows($result);
?>
<div style="font-size:20px;color:black;display:block;margin:0 auto;width:99%;padding:20px 0px 20px 0px;font-weight:bold">Record Total : <?php echo $count;?></div>
<div class="table">
<table>
<thead>
    <tr>
        <th>Member ID</th>
        <th>Member Name</th>
        <th>Member Email</th>
        <th>PhoneNo</th>
        <th>Password</th>
        <th>Action</th>
    </tr> 
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?php echo $row['member_id']?></td>
    <td><?php echo $row['member_name']?></td>
    <td><?php echo $row['member_email']?></td>
    <td><?php echo $row['member_phone']?></td>
    <td><?php echo $row['member_pass']?></td>
	<td><a class="buttonDelete" href="memberlist.php?sid=<?php echo $row['member_id'];?>"onclick="confirmation();">Delete</a></td>

</tr>

<?php
}
?>
</tbody>
</table>
</div>

</div>
</body>
</html>

<?php

if (isset($_REQUEST["sid"])) 
{
	$sid=$_REQUEST["sid"];
	
	mysqli_query($connect,"delete from member where member_id=$sid");
    echo("<script>location.href='memberlist.php'</script>");
}

?>






