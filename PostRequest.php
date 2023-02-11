<?php 
session_start();
if(!isset($_SESSION['ParentEmail'])){
    header("location:[Parent]signin.php");
}


     //Connection
     $servername = "localhost";
     $username = "root";
     $password = "root";
     $dbname = "CareAcademy";

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
     }         

     //saving changes
     if (isset($_POST['SUBMITBUTTON'])){

          $KidName =  $_POST['KidName'];
          $Subject = $_POST['Subject'];
          $KidAge = $_POST['KidAge'];
          $parentEmail = $_POST['parentEmail'];
          $ClassTime = $_POST['ClassTime'];
          $ClassDuration = $_POST['ClassDuration'];
          $ClassType = $_POST['ClassType'];
          $ParentEmail = $_SESSION['ParentEmail'];

          if (empty($KidName))
     {
      echo  "<script>alert('Please fill out all the fields')</script>" ;
      exit;
     }

     else

     if(!preg_match("/^([a-zA-Z' ]+)$/"," $KidName") )
     {
     echo  "<script>alert('Please enter a valid name')</script>" ;
      exit;
     }
    

     if (empty( $KidAge))
    {
         echo "<script>alert('Please fill out all the fields')</script>";
      exit;
    }
    else
    if (!preg_match("/^[0-9]+$/",  $KidAge))
{
    echo "<script>alert('Please enter a valid age')</script>";
      exit;
}

    
     if(  $ClassType == "Choose")
     {
         echo "<script>alert('Please fill out all the fields')</script>";
       exit;
     }
 
     if(  $Subject == "Choose")
     {
         echo "<script>alert('Please fill out all the fields')</script>";
       exit;
     }
 
     if( $ClassDuration == "Choose")
     {
         echo "<script>alert('Please fill out all the fields')</script>";
       exit;
     }
	
		  $sql = "INSERT INTO Request(KidName, KidAge, ClassType, Subjects, ClassDuration, ClassTime, ParentEmail) 
          VALUES ('" .$KidName . "','" . $KidAge . "','" . $ClassType . "','" . $Subject . "','" . $ClassDuration . "','" . $ClassTime . "','" .$_SESSION['ParentEmail']."');";

          $query = mysqli_query($conn,$sql);
          if( $query ){ 
            header("location: Parent.php");
          }
            else
            {
              echo 'fail';
            }

      } 

?>

 <!--Edit request Part-->
 <!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Post Request</title>
  <link rel="stylesheet" href="Container.css"> 
  <link rel="stylesheet" href="button.css">
  <link rel="stylesheet" href="pa&tuStyles.css"/> 
  <style> 
   input{
	background-color: #ffffff;
	border-color: #0076de;
	padding: 12px 15px;
	margin: 1px 0;
	width: 100%;
   }

   .a-btn:hover{
    background-color: #0076de;
  }
  form {
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 10px 50px;
  height: 100%;
  text-align: center;
  border-radius: 10px;
  width: 385px;
  box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;
}
  
   </style>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container" id = "container">
	<div class="form-container sign-in-container">
    <form  method="Post" action="#">
                <h2>Post a Request</h2>
                <input type="text" name="KidName" placeholder="Kid name" />
                <br>
                <input type="text" name="KidAge" Age="Age" placeholder="Age" />
                <br>
                <label for="ClassType">Type Of Class</label>
                <select name="ClassType" id="classType">
                    <option value="Choose" selected>Choose</option>
                    <option value="Online">Online Classes</option>
                    <option value=" In-Person">In-person Classes</option>
                </select>
                <br>
                <label for="Subject1">Choose a subject</label>
                <select name="Subject" id="Subject">
                    <option value="Choose" selected>Choose</option>
                    <option value=" Science">Science</option>
                    <option value=" math">Math</option>
                    <option value="computing">Computing</option>
                    <option value=" ArtANDhumanities">Art & Humanities</option>
                    <option value=" english">English</option>
                    <option value="arabic">Arabic</option>
                    <option value="islamics">Islamics</option>
                </select>
                <br>
                <label for="ClassDuration">Class Duration</label>
                <select name="ClassDuration" id="duration">
                    <option value="Choose" selected>Choose</option>
                    <option value="60">60 minutes</option>
                    <option value="120">120 minutes</option>
                    <option value="180">180 minutes</option>
                </select>
                <br>
                <label for="ClassTime">Class time</label>
                <input name="ClassTime" type="datetime-local" id="classtime"  min="2023-02-09T00:00">
                <button name="SUBMITBUTTON" type="submit">Submit</button>
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