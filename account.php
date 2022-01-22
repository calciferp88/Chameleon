<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "chameleondb");

 
    if (isset($_SESSION['email']))
   {
           echo "     
           <script>        
           window.location = 'Home.php'   
           </script>
           ";
   }

      // ----------------------- User register

  if (isset($_POST ['btnSignUp'])) 
    { 
      $name         = $_POST ['txtName-reg'];
      $email        = $_POST ['txtEmail-reg'];
      $phone        = $_POST ['txtPhone-reg'];
      $country      = $_POST ['txtCountry-reg'];
      $dob          = $_POST ['txtdob-reg'];
      $gender       = $_POST ['txtGender-reg'];
      $bio          = $_POST ['txtBio-reg'];
      $password     = $_POST ['txtpsw-reg']; 
      $password2    = $_POST ['txtpswCon'];  

      if ($password == $password2)
      {


      $select = "SELECT * FROM `user` where Email = '$email' ";

      $runs = mysqli_query($connect, $select);

      $count = mysqli_num_rows($runs);

        if ($count != 0)
        {
          echo "  
             <script>
             alert('The Email already has an account. Please Try Another !'); 
             window.location = 'LoginOrSignup.php'; 
             </script> 
             "; 
        }

      else
      {
        $image1 = $_FILES['txtpp-reg']['name'];
        $folder = "User/";
        if ($image1) 
        {
          $filename1 = $folder."_".$image1;
          $copied = copy($_FILES['txtpp-reg']['tmp_name'], $filename1);

          if (!$copied) 
          {   
          exit("Problem Occured. Cannot upload image");
          }
        }

         $Insert = "INSERT INTO `user`(`ProfilePic`, `Name`, `Email`, `PhoneNo`, `Country`, `Dob`, `Gender`, `Bio`, `Password`) VALUES ('$filename1', '$name','$email','$phone', '$country', '$dob', '$gender', '$bio', '$password')";

               $run = mysqli_query($connect, $Insert); 

               if ($run) 
               {

               echo "  
                    <script>
                    alert('Welcome $name. Your Account Is Created !'); 
                    window.location = 'Home.php';     
                    </script>
                    ";    

                    $_SESSION['email'] = $email;
               } 

               else
               { 
                 echo mysqli_error($connect);
               }

         }

      
      }

      else
      {
        

      echo "  
           <script>
           alert('Password are not match !');
           window.location = 'LoginOrSignup.php'; 
           </script>
           ";
      }

    }     

    // -------------------------- User Login

     if (isset ($_POST ['btnLogin']))

    { 
      $email= $_POST['txtEmail-log'];
      $pass = $_POST['txtpsw-log'];  

      $select =  "SELECT * FROM user WHERE Email ='$email' AND Password = '$pass' ";

      $run = mysqli_query($connect, $select);

      $count = mysqli_num_rows($run);

        if ($count != 0)
      {
      $_SESSION['email'] = $email; 
       echo "     
           <script>        
           alert('Logged In Successfully !');
           window.location = 'Home.php'   
           </script>
           ";
      }    

      else
      {

      echo "  

          <script>
           
          alert('Try Again');

          </script>
 
          ";
      }
    }   

      

 ?>


<!DOCTYPE html>           	   
<html>
<head>  
    <link rel="shortcut icon" href="Media/chameleon3.png">  
	<title>Chameleon | Sign Up</title> 
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
    <link rel="stylesheet" type="text/css" href="make.css">   

</head> 
   
<body>

  <div  id="left-img"> 
      <p>Welcome To <br> <b>Chameleon</b><p>
  </div>         
            
  <div class="form-container">  

    <div style="position: fixed; width: 100%; top: 0;">
      <button class="tablink" onclick="openPage('log', this, '#d0e1e1', 'black', 'none')" id="defaultOpen">Log In</button>
      <button class="tablink" onclick="openPage('sign', this, '#d0e1e1', 'black', 'none')">Sign Up</button>   
    </div>   
      
      <div id="log" class="tabcontent">             
        <form action="Account.php" method="POST" class="log-form" enctype="multipart/form-data">
                
            <div class="container"> 
              <h1 style="font-size: 2vw; padding-top: 15%; ">Log Into Your Account</h1> 
              <hr>

              <input style="font-size: 1.2vw;" type="email" placeholder="Enter Your Email" name="txtEmail-log" required>

              <input style="font-size: 1.2vw;" type="password" placeholder="Enter Password" name="txtpsw-log" required>

             <label>Don't Have An Account ? <a href="Register.php"> Sign Up</a></label>
              
              <div class="clearfix"  style="font-size: 1.2vw;" >
                <button type="submit"  id="button" name="btnLogin" >Log In</button>
              </div>   

            </div>

        </form>   
      </div>    

      <!--------------------- SIGN UP ------------------>   

      <div id="sign" class="tabcontent">
         <form action="account.php" method="POST" class="log-form" enctype="multipart/form-data">
              
            <div class="container"> 
              <h1 style="font-size: 2vw; padding-top: 15%; ">Sign Up An Account</h1>  
              <hr>

              <input style="font-size: 1.2vw;" type="text" placeholder="Enter Your Name" name="txtName-reg" required>   
            
              <input style="font-size: 1.2vw;" type="email" placeholder="Enter Your Email" name="txtEmail-reg" required>

              <input style="font-size: 1.2vw;" type="file" placeholder="Choose your profile" name="txtpp-reg" required multiple>

              <input style="font-size: 1.2vw;" type="text" placeholder="Enter Your Phone Number" name="txtPhone-reg" required>

              <input style="font-size: 1.2vw;" type="text" placeholder="Enter Your Country" name="txtCountry-reg">
             
              <input style="font-size: 1.2vw;" type="DATE" name="txtdob-reg" required>

              <select style="font-size: 1.2vw;" name="txtGender-reg">     
                <option>Male</option>  
                <option>Female</option>     
                <option>Unspecified</option>  
              </select>

              <textarea style="font- : 1.2vw;" placeholder="Enter a Bio" name="txtBio-reg"></textarea>

              <input style="font-size: 1.2vw;" type="password" placeholder="Enter Your Password" name="txtpsw-reg" required>

              <input style="font-size: 1.2vw;" type="password" placeholder="Comfirm Your Password" name="txtpswCon" required>


             <label>By Signing Up, you agree our <a href="#"> Terms & Policy </a></label> 
             
              <div class="clearfix"  style="font-size: 1.2vw;" >
                <button type="submit"  id="button" name="btnSignUp" >Sign Up</button>
              </div> <br><br>

            </div> 

        </form>
      </div>

      <script>
      function openPage(pageName,elmnt,bgcolor, color, out) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";      
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].style.backgroundColor = "";
          tablinks[i].style.color = "";
          tablinks[i].style.outline = out;

        }
        document.getElementById(pageName).style.display = "block";

        elmnt.style.backgroundColor = bgcolor;
        elmnt.style.color = color; 

      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
      </script>

  </div>
 




</body>
</html> 