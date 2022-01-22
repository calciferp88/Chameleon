<?php 
	

    $connect = mysqli_connect("localhost", "root","", "chameleondb");
	session_start();
	session_destroy();


	echo " 
	
	<script>

	alert('Logout');
	window.location = ('Home.php');
	</script>

	"; 
 

 ?>