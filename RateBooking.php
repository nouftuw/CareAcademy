<?php
session_start();
$parentmail = $_SESSION["ParentEmail"];
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
  <link rel="stylesheet" href="HeaderFooterBar.css" />
  <link rel="stylesheet" href="stars.css" />


  <!--font-->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Nunito&display=swap" rel="stylesheet">
  <!--icons-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

  <title>Rate!</title>
</head>

<body>
  <!--nav bar-->
  <!-- <nav class="navbar" id="navbar">
    <h2 class="navbar-logo"><a href="#">CARE ACADEMY</a></h2>
    <div class="navbar-menu" id="navbar-menu[tutorpage]">
      <div><a href="Parent.html">Requests</a></div>
      <div><a href="CurrentBookings.html">Current Booking</a></div>
      <div><a class="active" href="PreviousBooking.html">Previous Booking</a></div>
      <div><a href="Parent[offers].html">Offers</a></div>
      <div><a href="ManageProfile[Parent].html">Manage Profile</a></div>
      <div><a href="index.html">Sign out</a></div>
    </div>
  </nav> -->
  <!--header-->

  <?php

  // save the rating to the database
  $rating = $_POST['rating'];
  $feedback = $_POST['Feedback'];

  // code to save the rating in the database
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "CareAcademy";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $id = $_GET['id'];
  $tutoremail = $_GET['tutoremail'];
  $ClassTime = $_GET['ClassTime'];


  if (isset($_POST['sumbitRating'])) {

    $sql = "INSERT INTO `Reviews` (`rateid`, `Star`, `Feedback`, `ParentEmail`, `TutorEmail`, `ClassDate`) 
        VALUES ('$id', '$rating', '$feedback', '$parentmail', '$tutoremail', '$ClassTime')";

    $sql2 = "UPDATE Request SET IsRated='1' WHERE ID = $id";

    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if (mysqli_query($conn, $sql2)) {
      echo "update IsRated successfully the id is" . $id;
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }


    mysqli_close($conn);
    header("location: PreviousBooking.php");
  } else {
    // show the form RateBooking.php
  }
  ?>
  <form id="ratingForm" style="padding: 40px; border-radius: 5px; margin: 200px 200px 100px 200px; text-align: center; " method="post">
    <div class="star-rating">

      <input id="star-1" type="radio" name="rating" value="5" />
      <label for="star-1" title="5 star"><i class="active fa fa-star" aria-hidden="true"></i></label>

      <input id="star-2" type="radio" name="rating" value="4" />
      <label for="star-2" title="4 stars"> <i class="active fa fa-star" aria-hidden="true"></i> </label>

      <input id="star-3" type="radio" name="rating" value="3" />
      <label for="star-3" title="3 stars"><i class="active fa fa-star" aria-hidden="true"></i></label>

      <input id="star-4" type="radio" name="rating" value="2" />
      <label for="star-4" title="2 stars"> <i class="active fa fa-star" aria-hidden="true"></i></label>

      <input id="star-5" type="radio" name="rating" value="1" />
      <label for="star-5" title="1 stars"> <i class="active fa fa-star" aria-hidden="true"></i></label>

    </div>
    <textarea name="Feedback" placeholder="Leave your feedback"></textarea><br><br>
    <input name="sumbitRating" style=" background-color: transparent; color: var(--primaryColor); padding: 0.3rem 2rem; border: 1px solid var(--primaryColor); border-radius: 20px; width: 250px;margin: 20px auto;" type="submit" value="Submit">
  </form>


  <?php


  ?>


</body>






</html>