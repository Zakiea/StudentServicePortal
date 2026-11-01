<?php 

echo "<pre>";
print_r($_POST);
echo "</pre>";
$dbTable = "support_enquireis";
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];

$study_type= $_POST["checkbox"];
$campus = $_POST["campus"];
$gender = $_POST["gender"];
$title = $_POST["subject"];

include_once("settings.php");

$sql_support= "CREATE TABLE IF NOT EXISTS support_enquireis(
    
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    id INT(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    study_type varchar(50) NOT NULL,
    campus varchar(50) NOT NULL,
    gender char(50) NOT NULL,
    title varchar(255) NOT NULL
)";

$conn = mysqli_connect($host,$user,$pswd,$dbnm);
    if(!$conn)
        {
            die('Could not connect to  MySql Server:' .mysql_error());
        }
if($conn -> query($sql_support) === TRUE){
    echo "Table Created!";

}
else{
    echo "Error:". $sql_support . "<br>" . $conn->error;
}

$query = "INSERT INTO support_enquireis (firstname, lastname, email, study_type, campus, gender, title)
VALUES ('$fname','$lname','$email','$study_type','$campus','$gender','$title')";



$result = mysqli_query($conn, $query);
?>
