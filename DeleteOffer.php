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

$id = $_GET['id'];
echo($id);

$query = "DELETE FROM Request WHERE `Request` . `ID` = $id";

mysqli_query($conn , $query);

mysqli_close($conn);
// header("location: Parent.php");
?>