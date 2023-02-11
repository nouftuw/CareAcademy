<?php 
session_start();
if(!isset($_SESSION['ParentEmail'])){
    header("location:[Parent]signin.php");
}


if(isset($_GET['RequestEditBTN'])){
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

     if(isset($_GET['id']) && isset($_GET['KidName']) && isset($_GET['Subjects']) && isset($_GET['KidAge']) && isset($_GET['parentEmail']) && isset($_GET['ClassTime']) && isset($_GET['ClassDuration']) && isset($_GET['ClassType'])){
          $id = $_GET['id'];
          $KidName =  $_GET['KidName'];
          $Subject = $_GET['Subjects'];
          $KidAge = $_GET['KidAge'];
          $parentEmail = $_GET['parentEmail'];
          $ClassTime = $_GET['ClassTime'];
          $ClassDuration = $_GET['ClassDuration'];
          $ClassType = $_GET['ClassType'];
     }         

     //saving changes
     if (isset($_POST['SaveChanges'])){

          $KidName =  $_POST['KidName'];
          $Subject = $_POST['Subjects'];
          $KidAge = $_POST['KidAge'];
          $parentEmail = $_POST['parentEmail'];
          $ClassTime = $_POST['ClassTime'];
          $ClassDuration = $_POST['ClassDuration'];
          $ClassType = $_POST['ClassType'];

     
          if(!preg_match("/^([a-zA-Z' ]+)$/"," $KidName") )
          {
          echo  "<script>alert('Please enter a valid name')</script>" ;
           exit;
          }
         
     
     
        
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
          
	
		       $sql = "UPDATE `Request` SET `KidName` = '$KidName', `KidAge` = '$KidAge', `ClassType` = '$ClassType', `Subjects` = '$Subject', 
          `ClassDuration` = '$ClassDuration', `ClassTime` = '$ClassTime' WHERE `Request`.`ID` = $id";

          $query = mysqli_query($conn,$sql);
          if( $query ){ 
            header("location: Parent.php");
          }
          else{
            echo "<script>alert('Request failed,please fill out all blanks')</script>";
          }

      } 

      //deleting a request
     if (isset($_POST['DeleteRequest'])){
  
        $sql="DELETE FROM Request WHERE ID='$id'" ;

        $query = mysqli_query($conn,$sql);
        if( $query ){ 
     header("location: Parent.php");
        }
          else{
            echo 'fail';
          }

    }
}

?>

 <!--Edit request Part-->
 <!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Edit Request</title>
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

.delete {
  background: transparent;
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

    <form  method="POST" action="#">
                <h1>Edit a Request</h1>
                <input type="text" name="KidName" value=<?php echo $KidName;?> />
                <br>
                <input type="text" name="KidAge" Age="Age" value=<?php echo $KidAge;?> />
                <br>
                <label for="ClassType">Type Of Class</label>
                <select name="ClassType" id="classType">
                    <option value="<?php echo $ClassType;?>" selected><?php echo $ClassType;?></option>
                    <option value="Online">Online Classes</option>
                    <option value=" In-Person">In-person Classes</option>
                </select>
                <br>
                <label for="Subject">Choose a subject</label>
                <select name="Subjects" id="Subject">
                    <option value="<?php echo $Subject;?>" selected><?php echo $Subject;?></option>
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
                    <option value="<?php echo $ClassDuration;?>" selected><?php echo $ClassDuration;?></option>
                    <option value="60">60 minutes</option>
                    <option value="120">120 minutes</option>
                    <option value="180">180 minutes</option>
                </select>
                <br>
                <label for="ClassTime">Class time</label>
                <input name="ClassTime" type="datetime-local" id="classtime"  value="<?php echo $ClassTime;?>">
                <a href="DeleteOffer.php?id=" onclick="return alert('Changes Saved!');">
                 <button class ="a-btn" name ="SaveChanges">Save Changes</button> 
            </form>
	</div>

	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
			</a>
                <!-- <a href="DeleteOffer.php?id=" onclick="return confirm('Are you sure you want to delete this request?');"> -->
                 <form method="POST" class="delete">
                 <button class ="r-btn" name ="DeleteRequest" onclick="return confirm('Are you sure you want to delete this request?');">Delete Request</button>
                 </form>
                 
                <!-- </a> -->
			</div>
		</div>
	</div>
</div>



</body>

</html>


