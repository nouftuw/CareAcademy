<?php 
 session_start();
 if (isset($_POST['TutorSaveChangesButton']))
 {
	 $servername = "localhost";
	 $username = "root";
	 $password = "root";
	 $dbname = "CareAcademy";
	 if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
	 die( "<p>Could not connect to database</p>" );
 
	 if (!mysqli_select_db( $database, "CareAcademy" ))
	 die( "<p>Could not open URL database</p>" );

	 $tutormail = $_SESSION["TutorEmail"];
	 $query="SELECT * FROM Tutor WHERE email='$tutormail'";
	 $result=mysqli_query($database, $query);
	 $row = mysqli_fetch_array($result);
	 $imagess = $row['TutorImage'];


	 
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
			 $_SESSION["TutorEmail"] = $_POST['TutorEmail'];

			 if (!preg_match("/^[a-zA-Z ]*$/", $tutorfirstname))
			  {
                echo "<script>alert('Please enter a valid name')</script>";
                exit;
    }

    if (!preg_match("/^([a-zA-Z' ]+)$/", $tutorlastname)) 
	{
        echo "<script>alert('Please enter a valid last name')</script>";    
        exit;
    }

    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $tutoremail)) 
	{
        echo "<script>alert('Please enter a valid Email')</script>";    
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $tutorphone)) 
	{
        echo "<script>alert('Please enter a valid phone number')</script>";        
        exit;
    }

    if (!preg_match("/^([a-zA-Z' ]+)$/", $tutorcity))
	 {
        echo "<script>alert('Please enter a valid last name')</script>";        
        exit;
    }


    if (!preg_match("/^[0-9]{10}$/", $tutorid)) 
	{       
		 echo "<script>alert('Please enter a valid id')</script>";
        

        exit;    
	}

    if (!preg_match("/^[0-9]+$/", $tutorage))
	 {
        echo "<script>alert('Please enter a valid age')</script>";        
        exit;  
	  }


          
				 if (isset($_FILES['TutorProfileImage'])) 
				 {
					
					 $image = $_FILES['TutorProfileImage'];
					 $imagename = $_FILES['TutorProfileImage']['name'];
					 $imageTmpName = $_FILES['TutorProfileImage']['tmp_name'];
					 $imageSize = $_FILES['TutorProfileImage']['size'];
					 $imageType = $_FILES['TutorProfileImage']['type'];
 
					 $upload_directory = "images/";
					 $targetPath = time().$imagename;
					 if ($imagename == "")
						 $targetPath = $imagess;
 
					 if ($uploaded = move_uploaded_file($imageTmpName, $upload_directory . $targetPath));

					 $query = "UPDATE Tutor SET FirstName = '".$tutorfirstname."', LastName = '".$tutorlastname."', Email = '".$tutoremail."',  TutorPhone = '".$tutorphone."', City = '".$tutorcity."', Gender = '".$tutorgender."' , ID = '".$tutorid."' , Age = '".$tutorage."' , Bio = '".$tutorbio."' , TutorPassword = '".$tutorpassword."', TutorImage='".$targetPath."'  WHERE Email =  '$tutormail' "; 
					
				 }
				 else
				 {
					$query = "UPDATE Tutor SET FirstName = '".$tutorfirstname."', LastName = '".$tutorlastname."', Email = '".$tutoremail."',  TutorPhone = '".$tutorphone."', City = '".$tutorcity."', Gender = '".$tutorgender."' , ID = '".$tutorid."' , Age = '".$tutorage."' , Bio = '".$tutorbio."' , TutorPassword = '".$tutorpassword."'  WHERE Email =  '$tutormail' "; 
				 }
				 

 
			 if (mysqli_query($database, $query))
			  {
				 header("location:Tutor.php");
			 } else {
				 echo "<script>alert('an error occurred, could not update.')</script>";
				 die(mysqli_error($database));
			 }
		
	 
	
 
	
			 $_SESSION['UserName']= $tutorfirstname;
	}  
if (isset($_POST['TutorDeleteButton'])){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "CareAcademy";
    if (!($database = mysqli_connect($servername,$username,$password,$dbname)))
    die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "CareAcademy" ))
    die( "<p>Could not open URL database</p>" );

    $tutormail = $_SESSION["TutorEmail"];
    $query="DELETE FROM Tutor WHERE email='$tutormail'" ;

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
                     
					$tutormail= $_SESSION['TutorEmail'];

					$query="SELECT * FROM Tutor WHERE email='$tutormail'";

					$result=mysqli_query($database, $query);
					$row = mysqli_fetch_array($result);


					echo('
                        <div class="container" id = "container">
	                    <div class="container" id = "container">
		                <div class="form-container sign-in-container">
					    <form method="post" enctype="multipart/form-data">
						<div class="profilepic" id="manageprofileimg">
							<img src="images/'.$row['TutorImage'].'" id="photo" >
						</div><br><br><br><br><br><br>
						<input name="TutorProfileImage" type="file" accept="image/*">
						<input type="text" name="TutorFirstName" value="'.$row['FirstName'].'" />
						<input type="text" name="TutorLastName" value="'.$row['LastName'].'" />
						<input type="text" name="TutorID" value="'.$row['ID'].'"/>
						<input type="text" name="TutorGender"value="'.$row['Gender'].'"/>
						<input type="text" name="TutorAge" value="'.$row['Age'].'"/>
						<input type="text" name="TutorEmail" value="'.$row['Email'].'"/>
						<input type="text" name="TutorPhone" value="'.$row['TutorPhone'].'"/>
						<input type="text" name="TutorCity" value="'.$row['City'].'"/>
						<input name="TutorBio" value="'.$row['Bio'].'">
						<input type="password" name="TutorPassword" value="'.$row['TutorPassword'].'" />
						<button name="TutorSaveChangesButton">Save changes</button>
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
	<div class="DeleteAccount" >
		<form method="post">
			<h4>Are you sure you want to delete your account?</h4>
			<button name="TutorDeleteButton" class="D-btn"  type="submit" >Delete</button>
		</form>
		');
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
</div>

</body>

</html>