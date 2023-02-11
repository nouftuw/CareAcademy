<?php 
 session_start();
if (isset($_POST['ParentSignUpButton']))
{
	$servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
	if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
	die( "<p>Could not connect to database</p>" );

	if (!mysqli_select_db( $database, "CareAcademy" ))
	die( "<p>Could not open URL database</p>" );


			
				$parentfirstname = $_POST['ParentFirstName'];
				$parentlastname = $_POST['ParentLastName'];
				$parentemail = $_POST['ParentEmail'];
				$parentcity = $_POST['ParentCity'];
				$parentlocation = $_POST['ParentLocation'];
				$parentpassword = $_POST['ParentPassword'];

	 if (empty($parentfirstname)) 
    {       
		 echo "<script>alert('Please fill out all the fields')</script>";
                exit;
    }    
	 else

        if (!preg_match( "/^[a-zA-Z ]*$/", $parentfirstname)) 
        {           
			 echo "<script>alert('Please enter a valid name')</script>";
                    exit;
        }

    if (empty($parentlastname)) 
	{
        echo "<script>alert('Please fill out all the fields')</script>";        
        exit;   
	 } 
	 else
        if (!preg_match("/^([a-zA-Z' ]+)$/", $parentlastname )) 
		{
            echo "<script>alert('Please enter a valid last name')</script>";        
            exit;    
		    }

    if (empty($parentemail)) 
	{        echo "<script>alert('Please fill out all the fields')</script>";
                exit;
    } 
	else
        if (!preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $parentemail ))         {
            echo "<script>alert('Please enter a valid Email')</script>";    
            exit;
        }
    if (empty($parentcity))    
	 {
        echo "<script>alert('Please fill out all the fields')</script>";    
        exit;  
	  } 
	  else
        if (!preg_match("/^([a-zA-Z' ]+)$/", $parentcity)) 
		{
            echo "<script>alert('Please enter a valid city')</script>";        
            exit;     
		   }

    if (empty($parentlocation))
	{
        echo "<script>alert('Please fill out all the fields')</script>";        
        exit; 
	   }

    if (empty($parentpassword)) 
	{
        echo "<script>alert('Please fill out all the fields')</script>";        
        exit;   
	 }
	
				$query = "INSERT INTO Parent(FirstName, LastName, Email, City, ParentLocation, ParentPassword ) VALUES ('" . $parentfirstname . "','" . $parentlastname . "','" . $parentemail . "','" . $parentcity . "','" . $parentlocation . "','" . $parentpassword . "');";

			

			
			if (mysqli_query($database, $query)) {
				header("location:[Parent]signin.php");
			} else {
				echo "<script>alert('an error occurred, could not register.')</script>";
				die(mysqli_error($database));
			}
		
	

	 $_SESSION['UserName']= $parentfirstname;
}  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Parent Sign up</title>
  <link rel="stylesheet" href="Container.css"> 
  <link rel="stylesheet" href="button.css"> 
  <link rel="stylesheet" href="Input.css"> 
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container" id = "container">
	<div class="form-container sign-in-container">
		<form method="post">
			<h1>Create Account</h1>
			<input type="text" name="ParentFirstName" placeholder="Fist Name" />
			<input type="text" name="ParentLastName" placeholder="Last Name" />
			<input type="text" name="ParentEmail" placeholder="Email"/>
			<input type="text" name="ParentCity" placeholder="City"/>
			<textarea name="ParentLocation" placeholder="Location"></textarea>
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30057666.126941487!2d26.76963591357163!3d23.128239468441947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15e7b33fe7952a41%3A0x5960504bc21ab69b!2sSaudi%20Arabia!5e0!3m2!1sen!2ssa!4v1671543771269!5m2!1sen!2ssa" width="100%" height="auto" style="border:0;" 
				allowfullscreen="" frameborder="0" area-hidden="false" tabindex="0"></iframe>
			</div>
			<input type="password" name="ParentPassword"  placeholder="Password" />
			<button name="ParentSignUpButton" >Sign Up</button>
		</form>
			<input name="BackButton" type="button" value="Go Back" onclick="history.back()" class="back">
		</form>
	</div>

	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<input name="BackButton" type="button" value="Go Back" onclick="history.back()" class="back">
			</div>
		</div>
	</div>
</div>
</body>
</html>