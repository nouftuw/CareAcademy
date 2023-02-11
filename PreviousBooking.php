<?php
session_start();
if (!isset($_SESSION['ParentEmail'])) {
  header("location:[Parent]signin.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="button.css" />
  <link rel="stylesheet" href="HeaderFooterBar.css" />
  <link rel="stylesheet" href="input.css" />
  <link rel="stylesheet" href="pa&tuStyles.css" />
  <link rel="stylesheet" href="stars.css" />

  <!--font-->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
  <!--icons-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

  <title>Previous Bookings</title>

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

    form {
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
    <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
    <div class="navbar-menu" id="navbar-menu[tutorpage]">
      <div><a href="Parent.php">Requests</a></div>
      <div><a href="CurrentBookings.php">Current Booking</a></div>
      <div><a class="active" href="PreviousBooking.php">Previous Booking</a></div>
      <div><a href="Parent[offers].php">Offers</a></div>
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


  <div class="rev-section">
    <div class="reviews">



      <?php
      $parentmail = $_SESSION["ParentEmail"];
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


      $sql = "SELECT * FROM Request WHERE IsCompleted = 1 AND IsRated = 0 AND ParentEmail ='$parentmail'";
      $sql2 = "SELECT * FROM Request WHERE IsCompleted = 1 AND IsRated = 1 AND ParentEmail ='$parentmail'";
     

      $result = $conn->query($sql);
      $result2 = $conn->query($sql2);
   

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo ('<div class="review">  
                <div class="body-review">        
                <div class="order-num">Booking#' . $row['ID'] . '</div>      
                <div class="subject">' . $row['Subjects'] . ' class | ' . $row['ClassType'] . '</div>      
                <div class="order-date">' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
                <div class="tutor-name"><a class ="tutor-mail" href="mailto:' . $row['TutorEmail'] . '"><span class="fas fa-envelope"></span></a> Tutor| ' . $row['TutorName'] . '</div> 
                <div class="price">Price | ' . $row['OfferPrice'] . ' SAR per hour</div>   
                <div class="order-status">Done</div>  
               ');


      ?>

          <?php
          // $_SESSION['id'] = $row['ID'];
          // // $reqid = $row['ID'];
          // $_SESSION['tutoremail'] = $row['TutorEmail'];

          // $_SESSION['date'] = substr($row['ClassTime'], 0, 10);

          // //$tutemail = $row['TutorEmail'];
          $id = $row['ID'];
          $tutoremail = $row['TutorEmail'];
          $ClassTime = $row['ClassTime'];
          ?>

          <a href="RateBooking.php?id=<?php echo $id; ?>&tutoremail=<?php echo $tutoremail; ?>&ClassTime=<?php echo $ClassTime; ?>"><button>Rate</button></a>


      <?php



          echo (' </div></div>');
        }
      } else
        $conn->close();


      if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
          echo ('<div class="review">  
                  <div class="body-review">        
                  <div class="order-num">Booking#' . $row['ID'] . '</div>      
                  <div class="subject">' . $row['Subjects'] . ' class | ' . $row['ClassType'] . '</div>      
                  <div class="order-date">' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
                  <div class="tutor-name"><a class ="tutor-mail" href="mailto:' . $row['TutorEmail'] . '"><span class="fas fa-envelope"></span></a> Tutor| ' . $row['TutorName'] . '</div> 
                  <div class="price">Price | ' . $row['OfferPrice'] . ' SAR per hour</div>   
                  <div class="order-status">Rated</div>  
                  </div></div>
  
        ');
        }
      } else
        $conn->close();

      ?>

    </div>
  </div>


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

    window.onscroll = function() {
      if (window.pageYOffset >= menu.offsetTop) {
        navbar.classList.add("sticky");
      } else {
        navbar.classList.remove("sticky");
      }
    }
  </script>



</body>

</html>