<?php 
 session_start();
 if(!isset($_SESSION['ParentEmail'])){
    header("location:[Parent]signin.php");
}
$parentemail = $_SESSION["ParentEmail"];
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="button.css"/>
    <link rel="stylesheet" href="HeaderFooterBar.css"/>
    <link rel="stylesheet" href="pa&tuStyles.css"/>
    <link rel="stylesheet" href="Input.css"/>
    <link rel="stylesheet" href="Windows.css"/>
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <title>ParentPage</title>

    <style>

input {
  background-color: transparent;
color: var(--primaryColor);
padding: 0.3rem 2rem;
border: 1px solid var(--primaryColor);
border-radius: 20px;
cursor: pointer;
margin: 20px auto;
width: 250px;
}

input:hover {
background-color: var(--primaryColor);
color: var(--whiteColor);
}

.EditReqForm {
  background: #fff;
  display: inline;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0;
  height: 100%;
  text-align: center;
  border-radius: 10px;
  width: 350px;
  box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;
}
</style>
</head>
<body>
    <!--nav bar-->
    <nav class="navbar" id="navbar">
        <h2 class="navbar-logo"><a href="index.html">CARE ACADEMY</a></h2>
        <div class="navbar-menu" id="navbar-menu[tutorpage]">
            <div><a class="active" href="Parent.php">Requests</a></div>
            <div><a href="CurrentBookings.php">Current Booking</a></div>
            <div><a href="PreviousBooking.php">Previous Booking</a></div>
            <div><a href="Parent[offers].php">Offers</a></div>
            <div><a href="ManageProfile[Parent].php">Manage Profile</a></div>
            <div><a href="index.html">Sign out</a></div>
        </div>
    </nav>
    <!--header-->
    <header class="parent-header">

        <h1 class="header-title">
        
  
        
     Hello Parent!</h1>
         
    

        
      <p>
            <h4 class="ParentHeader-text">Don't worry. Your child's education is our top priority.</h4>
            <a href="PostRequest.php"><button name="PostRequestButton" id="PostRequestBtn" type="button">Request a tutor</button></a>
            
        </p>
    </header>
   

   

    <!--REQUESTS START-->
    <div class="rev-section">
    <div class="reviews">

    



      <!--REQUEST-->
      <!-- requests -->
      <?php
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

      //time limit
    //   $queryyy = "SELECT * FROM Offer WHERE Offer.timestamp <= DATE_SUB(NOW(), INTERVAL 2 MINUTE)";
    //   $resulttt = mysqli_query($conn, $queryyy);
    //   $roww = $resulttt->fetch_assoc();
    //   $reqID = $roww['RequestID'];
    //   $queryyyy = "DELETE FROM Request WHERE ID=$reqID";


    //   $queryy = "DELETE FROM Offer WHERE Offer.timestamp <= DATE_SUB(NOW(), INTERVAL 2 MINUTE)";
    //   $resultt = mysqli_query($conn, $queryy);

      

      //printing the list of Requests

      $parentemail = $_SESSION["ParentEmail"];
	  $sql= "SELECT * FROM Request WHERE ParentEmail='$parentemail' AND reStatus = 'Sent'";
      
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc() ) {
          
      
          echo ('<div class="review">  
                <div class="body-review">        
                <div class="order-num">Request#' . $row['ID'] . '</div>      
                <div class="kid-name">' . $row['KidName'] . '</div>     
                <div class="kid-grade">' . $row['KidAge'] . ' years </div>    
                <div class="subject">' . $row['Subjects'] . ' class | ' . $row['ClassType'] . '</div>      
                <div class="order-date">Starts on: ' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
                <div class="subject">Duration: ' . $row['ClassDuration'] . ' min</div>');
                
          ?>
          
          <!--beginning of btns-->
      
          <form action="EditReq.php" method="GET" class="EditReqForm">
                      <input  name="id" type="hidden" value="<?php echo($row['ID'])?>"/>
                      <input  name="KidName" type="hidden" value="<?php echo($row['KidName'])?>"/>
                      <input  name="Subjects" type="hidden" value="<?php echo($row['Subjects'])?>"/>
                      <input  name="KidAge" type="hidden" value="<?php echo($row['KidAge'])?>"/>
                      <input  name="ClassType" type="hidden" value="<?php echo($row['ClassType'])?>"/>
                      <input  name="parentEmail" type="hidden" value="<?php echo($row['ParentEmail'])?>"/>
                      <input  name="ClassTime" type="hidden" value="<?php echo($row['ClassTime'])?>"/>
                      <input  name="ClassDuration" type="hidden" value="<?php echo($row['ClassDuration'])?>"/>
                      <input type="submit" class="sendOffer" name="RequestEditBTN" value="Edit or Cancel"/>
          </form>
              <!-- end of btns -->
              
              </div>
                </div>
              <?php
                 }
                }
                mysqli_close($conn);
              ?>  
             
        
        </div><!--reviews-->
  </div><!--rev-section">-->



  

   

    <!--footer-->
    <footer>
        <div class="container">
            <div class="left">
                <h2>Contact Us</h2>
                <div class="content">
                    <div class="place">
                        <span class="fas fa-map-marker-alt"></span>
                        <span class="text">Riyadh 11495 Kingdom of Saudi Arabia</span>
                    </div>
                    <div class="phone">
                        <span class="fas fa-phone-alt"></span>
                        <span class="text">+996-5643892</span>
                    </div>
                    <div class="email">
                        <a href="mailto:info@CareAcademy.com"> <span class="fas fa-envelope"></span></a>
                        <span class="text">info@CareAcademy.com</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <center>
                <div><span><a href="#">© CareAcademy</a>, All Right Reserved. Designed By The Best Team</a></span></div>
            </center>
        </div>
    </footer>

    <script>
        var navbar = document.getElementById("navbar");
        var menu = document.getElementById("navbar-menu[tutorpage]");
        window.onscroll = function () {
            if (window.pageYOffset >= menu.offsetTop) {
                navbar.classList.add("sticky");
            }
            else {
                navbar.classList.remove("sticky");
            }
    }
    </script>
</body>
</html>         