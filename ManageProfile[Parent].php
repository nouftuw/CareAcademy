<?php
session_start();
if (isset($_POST['ParentSaveChangesButton']))
{
	$servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
	if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
	die( "<p>Could not connect to database</p>" );

	if (!mysqli_select_db( $database, "CareAcademy" ))
	die( "<p>Could not open URL database</p>" );

	$parentmail = $_SESSION["ParentEmail"];
	
			$parentfirstname = $_POST['ParentFirstName'];
			$parentlastname = $_POST['ParentLastName'];
			$parentemail = $_POST['ParentEmail'];
			$parentcity = $_POST['ParentCity'];
			$parentlocation = $_POST['ParentLocation'];
			$parentpassword = $_POST['ParentPassword'];

			if (!preg_match( "/^[a-zA-Z ]*$/", $parentfirstname)) 
        {     
			       echo "<script>alert('Please enter a valid name')</script>";
                    exit;
        }
    
        if (!preg_match("/^([a-zA-Z' ]+)$/", $parentlastname ))
		 {
            echo "<script>alert('Please enter a valid last name')</script>";        
            exit;      
		  }

    
        if (!preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $parentemail ))   
		      {
            echo "<script>alert('Please enter a valid Email')</script>";    
            exit;      
		 }
    
        if (!preg_match("/^([a-zA-Z' ]+)$/", $parentcity)) 
		{
            echo "<script>alert('Please enter a valid city')</script>";
        
            exit;   
		    }

			$query = "UPDATE Parent SET FirstName = '".$parentfirstname."', LastName = '".$parentlastname."', Email = '".$parentemail."',  City = '".$parentcity."', ParentLocation = '".$parentlocation."'  , ParentPassword = '".$parentpassword."'  WHERE email =  '$parentmail' "; 
  
			if (mysqli_query($database, $query)) {
				header("location:Parent.php");
			} else {
				echo "<script>alert('an error occurred, could not update.')</script>";
				die(mysqli_error($database));
			}
	

	
	$_SESSION['UserName']= $parentfirstname;
}  
if (isset($_POST['ParentDeleteButton'])){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
    if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
    die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "CareAcademy" ))
    die( "<p>Could not open URL database</p>" );

    $parentmail = $_SESSION["ParentEmail"];
    $query="DELETE FROM Parent WHERE email='$parentmail'" ;

    if (mysqli_query($database, $query)){
		header("Location: index.html");
	}
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Manage profile</title>
  <link rel="stylesheet" href="Container.css"> 
  <link rel="stylesheet" href="button.css"> 
  <link rel="stylesheet" href="Input.css"> 
  <link rel="stylesheet" href="Windows.css"/>
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>

					<?php
					$servername = "localhost";
					$username = "root";
					$password = "root";
					$dbname = "CareAcademy";
                    
					if ( !( $database = mysqli_connect($servername,$username,$password,$dbname) ) )
                    die( "<p>Could not connect to database</p>" );

                    if ( !mysqli_select_db( $database, "CareAcademy" ) )
                    die( "<p>Could not open URL database</p>" );

				
					$parentemail = $_SESSION["ParentEmail"];

					$query="SELECT * FROM Parent WHERE email='$parentemail'";

					$result=mysqli_query($database, $query);
					$row = mysqli_fetch_array($result);
					echo('
					<div class="container" id = "container">
	                <div class="container" id = "container">
		            <div class="form-container sign-in-container">
					<form action="#" method="post">
					<h1>Manage Account</h1>
					<input type="text" name="ParentFirstName" value="'.$row['FirstName'].'" />
					<input type="text" name="ParentLastName" value="'.$row['LastName'].'" />
					<input type="text" name="ParentEmail" value="'.$row['Email'].'"/>
					<input type="text" name="ParentCity" value="'.$row['City'].'"/>
					<input name="ParentLocation"value="'.$row['ParentLocation'].'">
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30057666.126941487!2d26.76963591357163!3d23.128239468441947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15e7b33fe7952a41%3A0x5960504bc21ab69b!2sSaudi%20Arabia!5e0!3m2!1sen!2ssa!4v1671543771269!5m2!1sen!2ssa" width="100%" height="auto" style="border:0;" 
						allowfullscreen="" frameborder="0" area-hidden="false" tabindex="0"></iframe>
					</div>
					<input type="password" name="ParentPassword" value="'.$row['ParentPassword'].'" />
					<button name="ParentSaveChangesButton">Save changes</button>
				    </form>
	                </div>
                    <div class="overlay-container">
	                <div class="overlay">
	             	<div class="overlay-panel overlay-right">
			        <h1>Delete Account</h1>
			        <button class="D-btn" id="deletebtn">Delete</button>
		            </div>
		            </div>
	                </div>
                    </div>
                    </div>

                    <div class="DeleteAccount" >
	                <form method="post">
		            <h4>Are you sure you want to delete your account?</h4>
		            <button name="ParentDeleteButton" class="D-btn"  type="submit" >Delete</button>
	                </form>
					')
					?>

					
	<script>var parent = document.querySelector(".DeleteAccount"),
			btn = document.querySelector("#deletebtn"),
			section = document.querySelector("section");
		X = document.querySelector(".closeRequestForm"),

			btn.addEventListener("click", appear, false);

		document.querySelector(".closeRequestForm").addEventListener("click", disappearPostRequest);

		function appear() {
			parent.style.display = "block";
			section.style.filter = "blur(10px)"
		}

		X.addEventListener("click", disappearX);

		function disappearX() {
			parent.style.display = "none";
			section.style.filter = "blur(0px)"
		}

		function disappearPostRequest(e) {
			if (e.target.className == ".PostRequest") {
				parent.style.display = "none";
				section.style.filter = "blur(0px)"
			}
		}</script>
</div>

</body>

</html>