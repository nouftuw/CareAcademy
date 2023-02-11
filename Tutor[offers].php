<?php
session_start();
if(!isset($_SESSION['TutorEmail'])){
    header("location:[Tutor]signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
    <link rel="stylesheet" href="button.css"/>
    <link rel="stylesheet" href="HeaderFooterBar.css"/>
    <link rel="stylesheet" href="pa&tuStyles.css"/>

    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    
</head>
<body>
        <!--nav bar-->
        <nav class="navbar" id="navbar">
          <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
          <div class="navbar-menu" id="navbar-menu[tutorpage]">
              <div><a href="Tutor.php" >Job Requests</a></div>
              <div><a href="CurrentJobs.php">Current Jobs</a></div>
              <div><a href="PreviousJobs.php">Previous jobs</a></div>
              <div><a href="Tutor[offers].php" class="active" >Offers</a></div>
              <div><a href="ManageProfile[Tutor].php" class="dd">Manage Profile</a></div>
              <div><a href="index.html">Sign out</a></div>
          </div>
      </nav>
        <!--header-->
        <header class="tutor-header">
        <h1 class="header-title">
       Hello Tutor!
        </h1>
        
                <h4 class="TutorHeader-text">Better than a thousand days <br>of diligent study is one day <br>with a great teacher.</h4>
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
      $queryy = "DELETE FROM Offer WHERE Offer.timestamp <= DATE_SUB(NOW(), INTERVAL 60 MINUTE)";
      
      $resultt = mysqli_query($conn, $queryy);
      
      //maybe change the condetion to price = -1
      $email = $_SESSION['TutorEmail'];
      $sql = "SELECT * FROM Offer WHERE TutorEmail = '$email' ";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc() ) {
          echo ('<div class="review">  
                <div class="body-review">        
                <div class="order-num">Offer#' . $row['ID'] . '</div>      
                <div class="kid-name">Request#' . $row['RequestID'] . '</div>     
                <div class="kid-grade">Price Sent ' . $row['Price'] . ' SR </div>          
                <div class="order-date">Starts on: ' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
                ');     
                               
          if(strtolower($row['OfferStatus']) == "pending"){
            echo ('<div class="order-num" id="pending" >' . $row['OfferStatus'] . '</div> ');
          }
          if(strtolower($row['OfferStatus']) == "accepted"){
            echo ('<div class="order-num" id="accepted">' . $row['OfferStatus'] . '</div> ');
          }
          if(strtolower($row['OfferStatus']) == "rejected"){
            echo ('<div class="order-num" id="rejected">' . $row['OfferStatus'] . '</div> ');
          }
          echo('    </div>
          </div>');
                
              }
            }
            else
            $conn->close();
      ?>
        
        </div><!--reviews-->
  </div><!--rev-section">-->


      <!--CURRENT BOOKINGS END-->
        <!--footer-->
    <footer>
        <div class="container">
          <div class="left">
            <h2>Contact Us</h2>
            <div class="content">
              <div class="place">
                <span class="fas fa-map-marker-alt" ></span>
                <span class="text">Riyadh 11495 Kingdom of Saudi Arabia</span>
              </div>
              <div class="phone">
                <span class="fas fa-phone-alt"></span>
                <span class="text">+996-5643892</span>
              </div>
              <div class="email">
                <a href ="mailto:info@CareAcademy.com"> <span class="fas fa-envelope"></span></a>
                <span class="text">info@CareAcademy.com</span>
              </div>
            </div>
          </div>
        </div>
    
        <div class="footer-bottom">
        <center>
        <div><span><a href="our web">© CareAcademy</a>, All Right Reserved. Designed By The Best Team</a></span></div>
        </center>
        </div>
    </footer>
    
        <script>
            var navbar = document.getElementById("navbar");
            var menu = document.getElementById("navbar-menu[tutorpage]");
    
            window.onscroll = function(){
                if(window.pageYOffset >= menu.offsetTop){
                    navbar.classList.add("sticky");
                }
                else{
                    navbar.classList.remove("sticky");
                }
            }
        </script>
</body>
</html>