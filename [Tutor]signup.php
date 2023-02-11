<?php 
 session_start();
if (isset($_POST['TutorSignUpButton']))
{
	$servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
	if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
	die( "<p>Could not connect to database</p>" );

	if (!mysqli_select_db( $database, "CareAcademy" ))
	die( "<p>Could not open URL database</p>" );



		
            $tutorfirstname = $_POST['TutorFirstName']; 
			$tutorlastname = $_POST['TutorLastName'];
			$tutoremail = $_POST['TutorEmail'];
			$tutorphone = $_POST['TutorPhone'];
			$tutorcity = $_POST['TutorCity'];
			$tutorpassword= $_POST['TutorPassword'];
			$tutorgender = $_POST['TutorGender'];
			$tutorid= $_POST['TutorID'];
			$tutorage= $_POST['TutorAge'];
			$tutorbio = $_POST['TutorBio'];

			if (empty($tutorfirstname))
			 {
				echo "<script>alert('Please fill out all the fields')</script>";
				exit;    
			}
				 else

				if (!preg_match("/^[a-zA-Z ]*$/", $tutorfirstname)) 
				{
					echo "<script>alert('Please enter a valid name')</script>";
					exit;     
				   }
		
			if (empty($tutorlastname)) 
			{        echo "<script>alert('Please fill out all the fields')</script>";
				exit;
			} 
			else
				if (!preg_match("/^([a-zA-Z' ]+)$/", $tutorlastname)) 
				{            echo "<script>alert('Please enter a valid last name')</script>";
					exit;
				}
			if (empty($tutoremail)) 
			{
				echo "<script>alert('Please fill out all the fields')</script>";
				exit;    
			} 
			else
				if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $tutoremail)) {
					echo "<script>alert('Please enter a valid Email')</script>";
		
					exit;      
				  }
			if (empty($tutorphone)) 
			{
				echo "<script>alert('Please fill out all the fields')</script>";
				exit;   
			 } 
			 else
				if (!preg_match("/^[0-9]{10}$/", $tutorphone)) 
				{            echo "<script>alert('Please enter a valid phone number')</script>";
		
					exit;     
				   }
		
			if (empty($tutorcity))
			 {
				echo "<script>alert('Please fill out all the fields')</script>";
				exit;    
			}
			
		
			if (empty($tutorpassword))
			 {        echo "<script>alert('Please fill out all the fields')</script>";
				exit;
			}
		
			if (empty($tutorid)) 
			{        echo "<script>alert('Please fill out all the fields')</script>";
		
				exit;
			}
			 else
				if (!preg_match("/^[0-9]{10}$/", $tutorid))
				 {            echo "<script>alert('Please enter a valid Id')</script>";
					exit;
				}
		
			if (empty($tutorage)) 
			{
				echo "<script>alert('Please fill out all the fields')</script>";    
				    exit;
			} 
			else     
			   if (!preg_match("/^[0-9]+$/", $tutorage))
			 {
					echo "<script>alert('Please enter a valid age')</script>";           
					 exit;
				}
			
				if (isset($_FILES['TutorImage'])) {
					$image = $_FILES['TutorImage'];
					$imagename = $_FILES['TutorImage']['name'];
					$imageTmpName = $_FILES['TutorImage']['tmp_name'];
					$imageSize = $_FILES['TutorImage']['size'];
					$imageType = $_FILES['TutorImage']['type'];

					$upload_directory = "images/";
					$targetPath = time().$imagename;
					if ($imagename == "")
						$targetPath = "profile.png";

					if ($uploaded = move_uploaded_file($imageTmpName, $upload_directory . $targetPath));
				}
			
				$query = "INSERT INTO Tutor(FirstName, LastName, Email, ID, Gender, Age ,City, Bio, TutorPassword, TutorPhone, TutorImage) VALUES ('" . $tutorfirstname  . "','" . $tutorlastname . "','" . $tutoremail . "','" .$tutorid . "','" . $tutorgender . "','" . $tutorage . "','" . $tutorcity . "','" . $tutorbio . "','" . $tutorpassword . "','" . $tutorphone . "','" . $targetPath . "');";;
		

			if (mysqli_query($database, $query)) {
				header("location:[Tutor]signin.php");
			} else {
				echo "<script>alert('an error occurred, could not register.')</script>";
				die(mysqli_error($database));
			}
		
	
	$_SESSION['UserName']= $tutorfirstname;
}  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Tutor Sign up</title>
  <link rel="stylesheet" href="Container.css"> 
  <link rel="stylesheet" href="button.css"> 
  <style> 
   input{
	background-color: #ffffff;
	border-color: #0076de;
	padding: 12px 15px;
	margin: 1px 0;
	width: 100%;
   }
   button{
	margin-top: 0px;
   }
  </style>
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container" id = "container">
	<div class="form-container sign-in-container">
	<form method="post" enctype="multipart/form-data">
		    <h1>Create Account</h1>
	        <h6 style="text-align:left;">Upload a photo<input name="TutorImage" type="file" accept="image/*"> </h6>
			<input type="text" name="TutorFirstName" placeholder="Fist name" />
			<input type="text" name="TutorLastName" placeholder="Last name" />
			<input type="text" name="TutorID" placeholder="ID"/>
			<input type="text" name="TutorAge" placeholder="Age"/>
			<input type="text" name="TutorGender" placeholder="Gender"/>
			<input type="text" name="TutorEmail" placeholder="Email"/>
			<input type="text" name="TutorPhone" placeholder="Phone"/>
			<input type="text" name="TutorCity" placeholder="City"/>
			<input name="TutorBio" placeholder="Bio">
			<input type="password" name="TutorPassword"  placeholder="password" />
			<button name="TutorSignUpButton">Sign Up</button>
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