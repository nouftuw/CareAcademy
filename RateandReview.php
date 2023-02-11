<!DOCTYPE html>
<html>
<head>
    <title>Rate & Review</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="pa&tuStyles.css" />

    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
</head>
<body>
<div class="rev-section">
    <div class="reviews">

<?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "CareAcademy";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $tutorEmail= $_GET['tutorEmail'];
    
      $sql = "SELECT * FROM Reviews WHERE TutorEmail = '$tutorEmail'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo ('<div class="review">  
          <div class="body-review">        
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
  
        ?>

 </div></div>
</body>
</html>