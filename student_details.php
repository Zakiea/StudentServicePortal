 <?php
    session_start();
    require_once("settings.php");
    $conn= mysqli_connect($host,$user,$pswd,$dbnm);
    if (!$conn){
    die('Could not connect mysql Server:' .mysql_error());
}
if (!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit;
}
$curr_student_id = $_SESSION['student_id'];

$sql ="SELECT * FROM student_details where student_id =?";
$stmt=$conn ->prepare($sql);
$stmt ->bind_param("s",$curr_student_id);
$stmt -> execute();
$result = $stmt->get_result();
$student =null;
if($result && $result-> num_rows > 0){
    $student =$result->fetch_assoc();
}
else{
    $msg= "No Record Found";
}

$stmt ->close();
$conn ->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student details</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/mobile.css">
<link rel="stylesheet" href="css/tablet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header> 
        <div class="container">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <div class="icon">
                <a href="enrolement.php"><i id="home_icon"  class="fa fa-home outline" ></i></a>        
                <!-- Hidden checkbox for state toggling -->      
                        <!-- Hamburger icon label -->
                        <label for="menu-toggle" class="hamburger" aria-label="Toggle Navigation">
                            <i class="fa-solid fa-bars" ></i>
                        </label>   
            </div>
            <div class="menu">
                <ul class="menu_links">
                    <li id="courses"><a href="enrolement.php">Enrolments</a></li> 
                    <li><a href="student_details.php">Student Detalis</a></li>
                    <li><a href="marks_results.php">Results</a></li>
                    <li><a href="help-support.php">Help and Support</a></li>
                </ul> 
            </div>
            <div class="log-out">
                        <form action="logout.php">
                        <input class= "log-out"type="submit" value="Log Out" >
                    </form>
                    </div>
        </div>
    </header>
<!--student details container-->
    <div class="details_container">
            <div class="column_25">
                <img src="images/profile.png" alt="User Profile Picture here">
                 <h3><?php echo htmlspecialchars($student['firstname'] ?? 'Student'); ?>
                <?php echo htmlspecialchars($student['lastname'] ?? 'Student'); ?>
                </h3> 
                
            </div>
            <div class="column_75">
                <?php if ($student): ?>
               <table class="student_table">
                     <tr>
                        <td >Student ID</td>
                       <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                       
                    </tr>
                    <tr>
                        <td>First Name</td>
                         <td><?php echo htmlspecialchars($student['firstname']); ?></td>   
                    </tr>
                    <tr>
                        <td>Last Name</td>
                         <td><?php echo htmlspecialchars($student['lastname']); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                         <td><?php echo htmlspecialchars($student['email']); ?></td>    
                    </tr>
                    <tr>
                        <td>Gender</td>
                         <td><?php echo htmlspecialchars($student['gender']); ?></td>     
                    </tr>
                    <tr>
                        <td>Date of Birth</td>"
                        <td><?php echo htmlspecialchars($student['date_birth']); ?></td>    
                    </tr>

                    <tr>
                        <td>Address</td>
                         <td><?php echo htmlspecialchars($student['address']); ?></td>     
                    </tr>
                    <tr>
                        <td>Course</td>
                         <td><?php echo htmlspecialchars($student['course']); ?></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td><?php echo htmlspecialchars($student['semester']); ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                         <td><?php echo htmlspecialchars($student['phone_number']); ?></td>     
                    </tr>
                    <tr>
                        <td>Study Location</td>
                         <td><?php echo htmlspecialchars($student['studey_location']); ?></td>
                    </tr>
                    <tr>
                        <td>Student email</td>
                         <td><?php echo htmlspecialchars($student['student_email']); ?></td>      
                    </tr>
                </table>
                <?php endif;?>
            </div>
    </div>

    <!--Footer-->
    <footer class="footer">
        <div class="flex-container">
        <div class="footer_img">
                <img id="childsafe_logo"src="images/childsafe-logo.png" alt="childsafe-logo">
                <img id="logovicgov" src="images/logovicgov.png" alt="logovicgov">
            </div> 
            <div class="social-media">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
        </div>
            
        <div id="footer_text">
            <p>Chisholm acknowledges the Bunurong people of the Kulin Nation as the Traditional Custodians of the Country on which our campuses are located.
                We recognise their continuing connection to land and waters and thank them for protecting the Country and its ecosystems that we enjoy today.
                We pay our respects to Elders, past and present, and extend that respect to all First Nations people.</p>
        </div>
    </footer>

</body>
</html>