<?php
session_start();
if(!isset($_SESSION['ParentEmail'])){
    header("location:[Parent]signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="button.css"/>
    <link rel="stylesheet" href="HeaderFooterBar.css"/>
    <link rel="stylesheet" href="pa&tuStyles.css"/>


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


</style>

</head>
<body>
    <!--nav bar-->
    <nav class="navbar" id="navbar">
        <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
        <div class="navbar-menu" id="navbar-menu[tutorpage]">
          <div><a href="Parent.php">Requests</a></div>
          <div><a href="CurrentBookings.php">Current Booking</a></div>
          <div><a href="PreviousBooking.php">Previous Booking</a></div>
          <div><a class="active" href="Parent[offers].php">Offers</a></div>
          <div><a href="ManageProfile[Parent].php">Manage Profile</a></div>
          <div><a href="index.html">Sign out</a></div>
        </div>
    </nav>
    <!--header-->
    <header class="parent-header">
    <h1 class="header-title">
        
  
        
        Hello Parent!</h1>
        <h4 class="ParentHeader-text">Don't worry. Your child's education is our top priority.</h4>  
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
      $email = $_SESSION['ParentEmail'];

      $sql = "SELECT * FROM Offer WHERE ParentEmail = '$email' AND OfferStatus = 'Pending' ";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc() ) {
          
          echo ('<div class="review">  
                <div class="body-review"> '
        );
        $TutorEmail = $row['TutorEmail'];
        ?>
        <a href="ViewTutorProfile.php?tutorEmail=<?php echo $TutorEmail ?>"><div class="order-num">View Tutor Profile </div></a>
                
                
                <?php
                echo('<div class="order-num">Offer#' . $row['ID'] . '</div>      
                <div class="kid-name">Request#' . $row['RequestID'] . '</div>     
                <div class="kid-grade">Price ' . $row['Price'] . ' years </div>       
                <div class="order-date">Starts on: ' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
               ');
                ?>       
                
                <?php 
                  $idO = $row['ID'];
                  $idR = $row['RequestID'];
                  $tutorEmail = $row['TutorEmail'];             
                  $OfferPrice = $row['Price'];   
                  $sqlTutor = "SELECT * FROM Tutor INNER JOIN Offer ON Tutor.Email = '".$row['TutorEmail']."'";
                  $resultTutor = $conn->query($sqlTutor);
                  $tutorRow = $resultTutor->fetch_assoc();
                  $tutorFirst = $tutorRow['FirstName'];
                  $tutorLast = $tutorRow['LastName'];
                  $tutorName = $tutorFirst . " " . $tutorLast;

                 ?>


                <a href="Accept.php?idO=<?php echo $idO; ?>&idR=<?php echo $idR; ?>&tutorEmail=<?php echo $tutorEmail; ?>&tutorName=<?php echo $tutorName;?>&OfferPrice=<?php echo $OfferPrice?>" onclick="return alert('Offer accepted, Tutor is booked!');">
                <button class ="a-btn" name ="a-btn">Accept</button> 
                </a>
                <a href="Reject.php?idO=<?php echo $idO;?>&idR=<?php echo $idR;?>&tutorEmail=<?php echo $tutorEmail;?>" onclick="return confirm('Are you sure you want to reject this offer?');">
                <button class ="r-btn" name ="a-btn">Reject</button> 
                </a>

                

           <?php
           echo('    </div>
           </div>');
                 
               }
             }
             else
            

             //maybe change the condetion to price = -1
      $ParentEmail = $_SESSION['ParentEmail'];
      $sql = "SELECT * FROM Offer WHERE ParentEmail = '$ParentEmail' AND NOT OfferStatus = 'Pending' ";
      $result1 = $conn->query($sql);
      if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc() ) {
          echo ('<div class="review">  
                <div class="body-review">        
                <div class="order-num">Offer#' . $row['ID'] . '</div>      
                <div class="kid-name">Request#' . $row['RequestID'] . '</div>     
                <div class="kid-grade">Price Sent ' . $row['Price'] . ' SR </div>          
                <div class="order-date">Starts on: ' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
                ');     
                
                
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

            if(($result1->num_rows == 0 && $result->num_rows == 0)){
              echo ('<div class="order-num">' . 'you don\'t have any offers' . '</div>');
            }
             $conn->close();
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
    <div><span><a href="#">© CareAcademy</a>, All Right Reserved. Designed By The Best Team</a></span></div>
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