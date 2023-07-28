<?php 
$conn=mysqli_connect("localhost","root","","spkbeasiswa2");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
