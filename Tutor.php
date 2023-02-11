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
    <link rel="stylesheet" href="button.css" />
    <link rel="stylesheet" href="HeaderFooterBar.css" />
    <link rel="stylesheet" href="pa&tuStyles.css" />
    <link rel="stylesheet" href="Windows.css" />
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
    <!--icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>TutorPage</title>

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
  background: transparent;
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

.offer {
    display:block;
    border-radius: 40px;
    width: 300px;
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;
    margin-left: 125px;
    align-content: center;
}


    </style>
</head>
<body>
    <!--nav bar-->
    <nav class="navbar" id="navbar">
        <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
        <div class="navbar-menu" id="navbar-menu[tutorpage]">
            <div><a href="Tutor.php" class="active">Job Requests</a></div>
            <div><a href="CurrentJobs.php">Current Jobs</a></div>
            <div><a href="PreviousJobs.php">Previous jobs</a></div>
            <div><a href="Tutor[offers].php" >Offers</a></div>
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
  <div class="rev-section" >
    <div class="reviews" >

    

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
      
      
      

      //printing the list of offers
      
      $sql = "SELECT * FROM Request WHERE reStatus = 'Sent'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc() ) {
          
          $tutorEmail = $_SESSION['TutorEmail'];
          $sqll = "SELECT * FROM Offer WHERE TutorEmail = '$tutorEmail'";
          $result2 = $conn->query($sqll);

          $cond = false;
          if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc() ) {
              if($row2['RequestID'] == $row['ID']){
                $cond = true;
                break;
              }
            }
            if($cond){
              continue;
            }
          }
          
      
          echo ('<div class="review">  
                <div class="body-review">        
                <div class="order-num">Request#' . $row['ID'] . '</div>      
                <div class="kid-name">' . $row['KidName'] . '</div>     
                <div class="kid-grade">' . $row['KidAge'] . ' years </div>    
                <div class="subject">' . $row['Subjects'] . ' class | ' . $row['ClassType'] . '</div>      
                <div class="order-date">Starts on: ' . substr($row['ClassTime'], 0, 10) . ' At ' . substr($row['ClassTime'], 11, 5)  . '</div>
                <div class="subject">Duration: ' . $row['ClassDuration'] . ' min</div>
                ');
                
          ?>
          
          <!--send offer button-->
          <div class="offer">
                  <form action = "SendOffer.php" method="GET">
                      <h2 style="color: #0076de;">Send Offer</h2>
                      <br />
                      <label for="price" > Session's price</label>
                      <select name="price" id="price">
                          <option value="Choose" selected>Choose</option>
                          <option value="100"> 100 SAR/hr</option>
                          <option value=" 150">150 SAR/hr</option>
                          <option value=" 200">200 SAR/hr</option>
                          <option value=" 250">250 SAR/hr</option>
                          <option value=" 300">300 SAR/hr</option>
  
                      </select>

                      <input  name="id" type="hidden" value="<?php echo($row['ID'])?>"/>
                      <input  name="parentEmail" type="hidden" value="<?php echo($row['ParentEmail'])?>"/>
                      <input  name="ClassTime" type="hidden" value="<?php echo($row['ClassTime'])?>"/>
                      <input  name="ClassDuration" type="hidden" value="<?php echo($row['ClassDuration'])?>"/>
                      <input type="submit" class="sendOffer" name="submitOffer" value="Submit"/>
  
                      <?php
                      
                      ?>
                             
                  </form>
  
              </div>
          
              </div>
                </div>


            
              <?php
                 }
                }
                
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
    
    <script>
        function submit(){
            <?php
                
                ?>
        }
    </script>


    

</body>
</html>