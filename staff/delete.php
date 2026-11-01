<?php
$dbTable = "student_details";
require_once("settings.php");

$conn=mysqli_connect($host,$user,$pswd,$dbnm);
if(!$conn){
    die("Could not connect to Database: " . mysqli_connect_error());
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_GET['student_id'])&& !empty($_GET['student_id'])){
    $student_id = $_GET['student_id'];

    $stmt = $conn->prepare("DELETE FROM $dbTable WHERE student_id =?");
    $stmt->bind_param("s",$student_id);
    $stmt->execute();
    $stmt->close();

}
header("Location: managment.php");
exit();

?>