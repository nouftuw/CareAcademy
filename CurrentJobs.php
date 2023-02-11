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

  <title>Current Jobs</title>
</head>

<body>
  <!--nav bar-->
  <nav class="navbar" id="navbar">
    <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
    <div class="navbar-menu" id="navbar-menu[tutorpage]">
      <div><a href="Tutor.php">Job Requests</a></div>
      <div><a href="CurrentJobs.php" class="active">Current Jobs</a></div>
      <div><a href="PreviousJobs.php">Previous jobs</a></div>
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
    </p>
  </header>

  <!--CURRENT JOBS START-->
  <div class="rev-section">
    <div class="reviews">

      <!--JOB1-->
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


      $sql = "SELECT * FROM Request WHERE reStatus = 'Accepted' AND TutorEmail = '$tutoremail' AND IsCompleted ='0'";
      $result = $conn->query($sql);


      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          if (date('Y-m-d H:i:s') < $row['ClassTime']) {
            echo ('<div class="review">  
            <div class="body-review">        
            <div class="order-num">Job#' . $row['ID'] . '</div>      
            <div class="kid-name">' . $row['KidName'] . '</div>     
            <div class="kid-grade">' . $row['KidAge'] . ' years </div>    
            <div class="subject">' . $row['Subjects'] . ' class | ' . $row['ClassType'] . '</div>      
            <div class="order-date">Starts on: ' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
          ');

            //RETRIEVE CITY&LOCATION
            //1-City
            $sql2 = "SELECT Parent.City FROM Parent
          INNER JOIN Request ON Parent.Email = '" . $row['ParentEmail'] . "'";

            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();

            //2-Loction
            $sql3 = "SELECT Parent.ParentLocation FROM Parent
          INNER JOIN Request ON Parent.Email = '" . $row['ParentEmail'] . "'";

            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_assoc();

            echo ('<div class="loc"><span class="fas fa-map-marker-alt"></span> <strong>' . $row2['City'] . ' | ' . $row3['ParentLocation'] . '</strong></div>');




            echo ('</div></div>');
          } else {
            $updateSQL = "UPDATE Request SET IsCompleted='1' WHERE ID='" . $row['ID'] . "'";
            if (mysqli_query($conn, $updateSQL)) {
              
            } else {
              echo "Error updating status: " . mysqli_error($conn);
            }
          }
        }
      } else
        $conn->close();
      ?>


      <!--end-->

    </div><!--reviews-->
  </div><!--rev-section">-->

  <!--CURRENT JOBS END-->












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
        <div><span><a href="#">© CareAcademy</a>, All Right Reserved. Designed The Best Team</a></span></div>
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