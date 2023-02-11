<?php
session_start();
if(!isset($_SESSION['TutorEmail'])){
    header("location:[Tutor]signin.php");
}
$tutoremail = $_SESSION["TutorEmail"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="button.css" />
  <link rel="stylesheet" href="HeaderFooterBar.css" />
  <link rel="stylesheet" href="pa&tuStyles.css" />
  <!--font-->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
  <!--icons-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <title>Previous jobs</title>
</head>

<body>
  <!--nav bar-->
  <nav class="navbar" id="navbar">
    <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
    <div class="navbar-menu" id="navbar-menu[tutorpage]">
      <div><a href="Tutor.php">Job Requests</a></div>
      <div><a href="CurrentJobs.php">Current Jobs</a></div>
      <div><a class="active" href="PreviousJobs.php">Previous jobs</a></div>
      <div><a href="Tutor[offers].php">Offers</a></div>
      <div><a href="ManageProfile[Tutor].php">Manage Profile</a></div>
      <div><a href="index.html">Sign out</a></div>
    </div>
  </nav>
  <!--header-->
  <header class="tutor-header">
    <h4 class="TutorHeader-text">Better than a thousand days <br>of diligent study is one day <br>with a great teacher.</h4>
    <h1 class="header-title">
       Hello Tutor!
        </h1>
  </header>

  <!--Previous jobs START-->
  <div class="rev-section">
    <div class="reviews">

      <!--Jobs-->
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

      $sql = "SELECT * FROM Reviews WHERE TutorEmail = '$tutoremail' ";
      $result = $conn->query($sql);
      $sql2 = "SELECT * FROM Request WHERE TutorEmail = '$tutoremail' AND IsCompleted = '1' AND IsRated ='0'";
      $result2 = $conn->query($sql2);


      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo ('<div class="review">  
          <div class="body-review">        
          <div class="order-num">Order# ' . $row['rateid'] . '</div>  
          <div style="font-size: 20px; font-weight: bold; font-style: italic;">' . $row['ClassDate'] . '</div>
          <div class="order-status">Done</div>    
          ');
          switch ($row['Star']) {
            case 1:
              echo '<h1 style="color: rgb(253, 180, 42);"> &#9733;</h1>';
              break;
            case 2:
              echo '<h1 style="color: rgb(253, 180, 42);"> &#9733;&#9733;</h1>';
              break;
            case 3:
              echo '<h1 style="color: rgb(253, 180, 42);"> &#9733;&#9733;&#9733;</h1>';
              break;
            case 4:
              echo '<h1 style="color: rgb(253, 180, 42);"> &#9733;&#9733;&#9733;&#9733;</h1>';
              break;
            case 5:
              echo '<h1 style="color: rgb(253, 180, 42);"> &#9733;&#9733;&#9733;&#9733;&#9733;</h1>';
              break;
            default:
              break;
          }
          echo ('<div style="font-size: 20px; font-weight: bold; color: grey;">' . $row['FeedBack'] . '</div>
          </div></div>');
        }
      } else
        $conn->close();



      if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
          echo ('<div class="review">  
          <div class="body-review">        
          <div class="order-num">Order# ' . $row2['ID'] . '</div>  
          <div style="font-size: 20px; font-weight: bold; font-style: italic;">' . substr($row2['ClassTime'], 0, 10) .  '</div>
          <div class="order-status">Done</div>   
          </div> </div>  
          ');
        }
      } else
        $conn->close();




      ?>
    </div>
  </div>

  </section>

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