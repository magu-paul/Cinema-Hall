<button id="button1" onclick="print();">Confirm</button> 
<button id="button" onclick="show();">Buy</button>
<script>
function show()
		{
	    var discount=0;
		var total=0;
		var price=<?php echo $row['mov_price']?>;
		var checkbox= document.querySelectorAll('input[type=checkbox]:checked');
		var box=[];
		var type= document.getElementById('tickettype');
		var ticket=type.value;

		
		switch(ticket){
			case "Adult":discount=0;break;
			case "Children":discount=0.1;break;
			case "Senior":discount=0.3;break;
			case "Student":discount=0.15;break;
		}
		
		for(var i=0;i<checkbox.length;i++){
				box.push(checkbox[i].value);
			}
			var total=(price-(price*discount))*checkbox.length;
		    
			document.getElementById("sums").innerHTML= "The seat selected is " + box + "<br><br>" + ticket + " x " + checkbox.length + " = RM " + parseFloat(total) +  "<br><br>";
			document.getElementById("button1").style.opacity="1";
			document.getElementById("button").style.opacity="0";
			document.getElementById("container").style.display="none";
			document.getElementById("purchase").style.display="none";
		


	}

</script>