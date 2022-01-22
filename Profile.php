<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "chameleondb");


   if (!isset($_SESSION['email']))
   {
   	       echo "     
           <script>        
           alert('Please Login First!');
           window.location = 'LoginOrSignup.php'   
           </script>
           ";
   }

     if (isset($_POST ['btn-post'])) 
    { 
	    $status      = $_POST ['txtstatus'];
	    $date        = $_POST ['txtqdate'];
      	$email       = $_SESSION['email'];


		$select      = "SELECT * FROM `user` WHERE Email = '$email' ";
		$run = mysqli_query($connect,$select);
        $row = mysqli_fetch_array($run);      
        $uid     = $row[0]; 

        $image1 = $_FILES['txtphoto']['name'];
        $folder = "Photo/";
        if ($image1) 
        {
          $filename1 = $folder."_".$image1;
          $copied = copy($_FILES['txtphoto']['tmp_name'], $filename1);

          if (!$copied) 
          { 
          exit("Problem Occured. Cannot upload image");
          }
        }

        $Insert = "INSERT INTO `post`(`Date`, `Status`, `Image`, `UserID`) VALUES ('$date','$status', '$filename1', '$uid')";

               $run = mysqli_query($connect, $Insert); 

               if ($run) 
               {

               echo "  
                    <script>  	
                    alert('Posted Successfully'); 
                    window.location = 'Home.php'; 
                    </script>
                    ";

               } 

               else
               { 
                 echo mysqli_error($connect);
               }

        }

 ?>

<!DOCTYPE html>           	
<html>    
<head>  
    <link rel="shortcut icon" href="Media/chameleon3.png">  
	<title>Chameleon | Feed</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <style type="text/css">


    	.info 
    	{
    		padding: 5%;
    	}


    </style>

</head> 
   
<body>

	<!------------------------ Navigation Bar ------------------>

	<div class="sidenav">
	  <a href="#about"><img src="Media/chameleon2.png" width="30%;"></a>

	  <a href="Home.php"><i class="fa fa-home">&nbsp;Feed</i></a>
	  <a href="#" id="this"	><i class="fa fa-user">&nbsp;Profile</i></a>
	  <a href="#services"><i class="fa fa-bell">&nbsp;Notification</i></a>
	  <a href="#clients"><i class="fa fa-users">&nbsp;Friends</i></a>
	  <a href="#contact"><i class="fa fa-bookmark">&nbsp;Saved</i></a> 
	  <a href="#contact"><i class="fa fa-cog">&nbsp;Setting</i></a>
	  <a href="Logout.php"><i class="fa fa-sign-out">&nbsp;Log Out</i></a>
	  <button class="btn-nav">Post Something</button> 	
	</div>

	<div class="topnav">  
	  <a href="#about"    title="Profile"> <i class="fa fa-user">&nbsp;</i></a>
	  <a href="#services" title="Notification"><i class="fa fa-bell">&nbsp;</i></a>
	  <a href="#clients"  title="Friends"> <i class="fa fa-users">&nbsp;</i></a>
	  <a href="#contact"  title="Saved">   <i class="fa fa-bookmark">&nbsp;</i></a>
	  <a href="#contact"  title="Setting"> <i class="fa fa-cog">&nbsp;</i></a>
	  

	</div> 

	<!------------------------------------ Middle Section  ---------------->

 	<div class="midsec">

        
		<div class="feed-nav">
			<h2>Profile</h2> 
		</div>

		<?php 

		$email  = $_SESSION['email'];
	    $select = "SELECT * FROM `user` WHERE Email = '$email' ";
        $run = mysqli_query($connect, $select);
        $row = mysqli_fetch_array($run); 

        $propic	   = $row[1];  
        $name  	   = $row[2];        
        $email 	   = $row[3];
        $phonee    = $row[4]; 
        $country   = $row[5]; 
        $dob       = $row[6];
        $Gender    = $row[7];  	
        $bio       = $row[8]; 

		 ?>  	

		<img src="<?php echo($propic) ?>" width="15%;" style="border-radius: 50%; margin-left: auto; margin-right: auto; margin-top:10%; display: block;">

		<h1><b></b></h1> 
 
		<p  style="text-align:center; margin-left: auto; margin-right: auto; margin-top:5%; display: block; font-size: 2vw;"> <?php echo ($name); ?> </p>
		<p  style="text-align:center; margin-left: auto; margin-right: auto; display: block; color: grey; font-size: 1vw;"><?php echo ($email); ?> </p>

		<div class="info">
		  <p><i class="fa fa-phone">          &nbsp;&nbsp;&nbsp;    <?php echo ($phonee);?>  </i></p> 
		  <p><i class="fa fa-globe">          &nbsp;&nbsp;&nbsp;    <?php echo ($country);?> </i></p>
		  <p><i class="fa fa-birthday-cake">  &nbsp;&nbsp;&nbsp;    <?php echo ($dob); ?>    </i></p> 
		  <p><i class="fa fa-globe">          &nbsp;&nbsp;&nbsp;    <?php echo ($Gender);?>  </i></p>
        
		</div>
        

		<?php 

		$email  = $_SESSION['email'];
	    $select = "SELECT * FROM `user` WHERE Email = '$email' ";
        $run = mysqli_query($connect, $select);
        $row = mysqli_fetch_array($run);  

        $usid = $row[0];

        $select = "SELECT * FROM `post` WHERE UserID = '$usid' ";
        $run = mysqli_query($connect, $select);
        $count = mysqli_num_rows($run);  

        for ($i=0; $i < $count; $i++)
          {	

          $row      = mysqli_fetch_array($run);
          $Date     = $row[1];
          $status   = $row[2];
          $img      = $row[3];
          $uid      = $row[4];
          $likeid   = $row[5];

        $select1 = "SELECT * FROM `user` WHERE UserID = '$uid' ";
        $run1 = mysqli_query($connect, $select1);
        $row1 = mysqli_fetch_array($run1); 
        $uname = $row1[2];  
        
      
        if ($row1[1] != '') 
        {
        	$pp = $row1[1];
        }

        else
        {
        	$pp = "https://www.eguardtech.com/wp-content/uploads/2018/08/Network-Profile.png";
        }  

          ?>

		<div class="post">

			<p class="poster" style="color: #c1d7d7;"><img src="<?php echo($pp) ?>" width="30px;" style="border-radius: 50px;">&nbsp;<?php echo "$uname"; ?></p>
			<p class="post-date"><?php echo "$Date"; ?><p>

			<div class="status">
			<?php echo "$status"; ?>
			</div>

			<?php 

			if ($img != '')	
			{
				echo " <img src='$img' width='100%' style='border-radius: 50px; padding:5%'   display: block; margin-left: auto; margin-right: auto;>";
			}


			?>


			<div class="action">
				  <a href="#"    title="Profile"> <i onclick="myFunction(this)" class="fa fa-thumbs-up">&nbsp;</i></a>
				  <a href="#" title="Notification"><i class="fa fa-comment">&nbsp;</i></a> 
				  <a href=""  title="Friends"> <i class="fa fa-bullhorn">&nbsp;</i></a>
			</div>

		</div>   

	    <?php } ?>
  
		 



			<script>
			function myFunction(x) {
			  x.classList.toggle("fa-thumbs-down");
			} 
			</script>
	</div> -->



	<!-- ----------------------------------Last Section -------------------->

	<div class="lastsec">

			<?php 
			if (isset($_SESSION['email']))

			{
				$email  = $_SESSION['email'];
				$select = "SELECT * FROM `user` WHERE Email = '$email' ";
				$run = mysqli_query($connect,$select);
		        $row = mysqli_fetch_array($run);      

		        $pp      = $row[1]; 

		     	

			 ?>

				<form class="post-sec" method="POST" action="Home.php" enctype="multipart/form-data"> 	

					<img src="<?php echo($pp) ?>" width="15%;" style="margin: 20px; border-radius: 50%;">
					<input type="text" name="txtstatus" placeholder="What's on your mind ?">	

					<div class="post-more">	
						    

						<a href="#about" title="Photo">

							<label for="file-upload" class="custom-file-upload">
							  <i class="fa fa-photo"></i>
							</label>
							<input type="file" id="file-upload" name="txtphoto" hidden>

					    </a>

						  <a href="#services" title="Link"><i class="fa fa-link">&nbsp;</i></a> 
						  <a href="#clients"  title="Sticker"> <i class="fa fa-smile-o">&nbsp;</i></a>
						   <input type="hidden" id="fname" class="qdate" name="txtqdate" value="<?php echo date('Y-M-D');?>">

						  <button name="btn-post"><i class="fa fa-paper-plane">&nbsp;</i>Post</button>
					</div> 

				</form>  

			<?php } ?>

				<hr>

	</div>
 
</body> 	
</html>	