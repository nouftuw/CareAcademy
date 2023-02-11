
<?php 
session_start();
if(!isset($_SESSION['ParentEmail'])){
    header("location:[Parent]signin.php");
}

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

$idO = $_GET['idO'];
$idR = $_GET['idR'];
$tutorEmail = $_GET['tutorEmail'];

$query1 = "UPDATE Offer SET OfferStatus='Rejected' WHERE ID = $idO";
// $query2 = "UPDATE Request SET TutorEmail='$tutorEmail' WHERE ID = $idR ";



mysqli_query($conn , $query1);
// mysqli_query($conn , $query2);

mysqli_close($conn);
header("location: Parent[offers].php");