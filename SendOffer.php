
<?php 
session_start();
if(!isset($_SESSION['TutorEmail'])){
    header("location:[Tutor]signin.php");
}


if(isset($_GET['submitOffer'])){
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

     if(isset($_GET['price']) && isset($_GET['id']) && isset($_GET['parentEmail']) && isset($_GET['ClassTime']) && isset($_GET['ClassDuration'])){
          $price = $_GET['price'];;
          $id =  $_GET['id'];
          $tutorEmail = $_SESSION['TutorEmail'];
          $parentEmail = $_GET['parentEmail'];
          $ClassTime = $_GET['ClassTime'];
          $ClassDuration =(int)$_GET['ClassDuration'];

    

          $date = substr($ClassTime, 0, 10);
          $time = substr($ClassTime, 11, 5);
          $hour = substr($ClassTime, 11, 2);
          $duration = $ClassDuration / 60;
          $startsOn = (int)($hour);
          $ednsOn = ($hour + $duration);
          
          echo ( " date: " . $date . " time: " . $time . " hour: " . $hour . " duration: " . $duration . " startsOn: " . $startsOn. " ednsOn: " . $ednsOn );


          $conflect = false;

          //Dulayel's code

          $sql = "SELECT * FROM `Offer` WHERE `TutorEmail` = '$tutorEmail' AND NOT `OfferStatus` = 'Rejected'";
          $result = $conn->query($sql);

          if($result->num_rows == 0){
          $sqll = "INSERT INTO `Offer` (`ID`, `RequestID`, `TutorEmail`, `ParentEmail`, `Price`, `OfferStatus`, `ClassTime`, `ClassDuration`) 
          VALUES (NULL, '$id', '$tutorEmail', '$parentEmail', '$price', 'Pending', '$ClassTime', '$ClassDuration')";
          

          $queryy = mysqli_query($conn,$sqll);
          if( $queryy ){ 
                header("location: Tutor.php");
               }
          else{
                echo 'fail1';
           }
          }

          if($result->num_rows > 0){
            while($row = $result->fetch_assoc() ){

              $rowClassTime = $row['ClassTime'];
              $rowDate = substr($rowClassTime, 0, 10);
              $rowClassDuration =(int)$row['ClassDuration'];

              if($rowDate === $date){
              $rowTime = substr($rowClassTime, 11, 5);
              $rowHour = substr($rowClassTime, 11, 2);
              $rowDuration = $rowClassDuration / 60;
              $rowStartsOn = (int)($rowHour);
              $rowEdnsOn = ($rowHour + $rowDuration);
              echo ("  " ."date: " . $rowDate . " time: " . $rowTime . " hour: " . $rowHour . " duration: " . $rowDuration . " startsOn: " . $rowStartsOn. " ednsOn: " . $rowEdnsOn);

               
               if( (($startsOn) >= ($rowStartsOn) && ($startsOn) <= ($rowEdnsOn)) ||
                   (($ednsOn) >= ($rowStartsOn) && ($ednsOn) <= ($rowEdnsOn)) ||
                   (($rowStartsOn) >= ($startsOn) && ($rowStartsOn) <= ($ednsOn)) ||
                   (($rowEdnsOn) >= ($startsOn) && ($rowEdnsOn) <= ($ednsOn))||
                   (($rowEdnsOn) === ($ednsOn) || ($rowStartsOn) === ($startsOn))
                   ){

              

                    $conflect = true; 
                    $_SESSION['ERROR2'] = "it is error";

                    header("location: TimeConflictMsg.html");
                    exit;

                   }
              }

              
          }
          $sqll = "INSERT INTO `Offer` (`ID`, `RequestID`, `TutorEmail`, `ParentEmail`, `Price`, `OfferStatus`, `ClassTime`, `ClassDuration`) 
          VALUES (NULL, '$id', '$tutorEmail', '$parentEmail', '$price', 'Pending', '$ClassTime', '$ClassDuration')";
          

          $queryy = mysqli_query($conn,$sqll);
          if( $queryy ){ 
                header("location: Tutor.php");
               }
          else{
                echo 'fail2';
           }
     } 
       
 }
}
?>
