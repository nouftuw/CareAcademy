<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>View profile</title>
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
<?php
                    
					$servername = "localhost";
					$username = "root";
					$password = "root";
					$dbname = "CareAcademy";
                    

					if ( !( $database = mysqli_connect($servername,$username,$password,$dbname) ) )
                    die( "<p>Could not connect to database</p>" );

                    if ( !mysqli_select_db( $database, "CareAcademy" ) )
                    die( "<p>Could not open URL database</p>" );
					

					$tutorEmail= $_GET['tutorEmail'];

					
					$query="SELECT * FROM Tutor WHERE email='$tutorEmail'";

					$result=mysqli_query($database, $query);
					$row = mysqli_fetch_array($result);

                
					echo('
                        <div class="container" id = "container">
	                    <div class="container" id = "container">
		                <div class="form-container sign-in-container">
					    <form method="post" enctype="multipart/form-data" action="Rating&Review.php">
						<div class="profilepic" id="manageprofileimg">
							<img src="images/'.$row['TutorImage'].'" id="photo" >
						</div>
						<a href="mailto:'.$row['Email'].'"><span id="mailhover" class="fas fa-envelope"></span></a>
						<input type="text" name="TutorFirstName" value="'.$row['FirstName'].'" />
						<input type="text" name="TutorLastName" value="'.$row['LastName'].'" />
						<input type="text" name="TutorGender"value="'.$row['Gender'].'"/>
						<input type="text" name="TutorAge" value="'.$row['Age'].'"/>
						<input type="text" name="TutorPhone" value="'.$row['TutorPhone'].'"/>
						<input type="text" name="TutorCity" value="'.$row['City'].'"/>
						<input name="TutorBio" value="'.$row['Bio'].'">
						<input type="button" value="Go back" onclick="history.back()" class="back">
					</form>
		</div>
'); ?>
	 <div class="overlay-container">
	  <div class="overlay">
	  <div class="overlay-panel overlay-right">
	  <h1>Ratings and Reviews</h1>
    <a href="RateandReview.php?tutorEmail=<?php echo $tutorEmail; ?>"><button>View Rating & Reviews</button></a>
			</div>
			</div>
		</div>
    		</div>

		

</body>

</html>