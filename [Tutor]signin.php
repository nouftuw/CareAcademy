<?php 
 session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {  

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
	if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
	die( "<p>Could not connect to database</p>" );

	if (!mysqli_select_db( $database, "CareAcademy" ))
	die( "<p>Could not open URL database</p>" );

	$tutoremail = $_POST['TutorEmail'];
	$tutorpassword= $_POST['TutorPassword'];
    $query="SELECT * FROM Tutor WHERE Email='$tutoremail'AND TutorPassword='$tutorpassword'"; 
    $result_tutor=mysqli_query($database, $query);  

    if($row=mysqli_fetch_row($result_tutor)){
			header("location:Tutor.php");
			$_SESSION['TutorEmail'] = $tutoremail;
	}else{
		echo "<script>alert('Invalid email or password!')</script>";
	}

	$query2 = mysqli_query($database, "SELECT * FROM Tutor WHERE Email = '$tutoremail' AND TutorPassword	 = '$tutorpassword' ") or die(mysqli_error($database));
	$fetch = mysqli_fetch_array($query2);
	$row = mysqli_num_rows($query2);

if ($row > 0) {
	$_SESSION['UserName'] = $fetch['FirstName'];
}
  }   
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Tutor Sign in</title>
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
  </style>
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container" id = "container">
	<div class="form-container sign-in-container">
	    <form method="post">
			<h1>Sign in</h1>
			<br>
			<input type="email" name="TutorEmail" placeholder="Email" />
			<input type="password" name="TutorPassword"  placeholder="Password" />
			<button type="submit" name="TutorSignInButton" >Sign In</button>
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