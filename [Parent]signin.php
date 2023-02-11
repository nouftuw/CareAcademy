<?php
 session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{  

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
	if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
	die( "<p>Could not connect to database</p>" );

	if (!mysqli_select_db( $database, "CareAcademy" ))
	die( "<p>Could not open URL database</p>" );

    $parentemail = $_POST['ParentEmail'];
	$parentpassword = $_POST['ParentPassword'];

	$query = "SELECT * FROM Parent WHERE email='$parentemail'AND ParentPassword='$parentpassword'";
    $result_parent=mysqli_query($database, $query);  

    if($row=mysqli_fetch_row($result_parent)){
			header("location:Parent.php");
			$_SESSION['ParentEmail'] = $parentemail;
	}
	else{
		echo "<script>alert('Invalid email or password!')</script>";
	}

	
	$query2 = mysqli_query($database, "SELECT * FROM Parent WHERE Email = '$parentemail' AND ParentPassword	 = '$parentpassword' ") or die(mysqli_error($database));
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
  <title>Parent Sign in</title>
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
			<h1>Sign in</h1>
			<br>
			<input type="email" name="ParentEmail" placeholder="Email" />
			<input type="password" name="ParentPassword" placeholder="Password" />
			<button type="submit" name="ParentSignInButton">Sign In</button> 
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