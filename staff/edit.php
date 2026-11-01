<?php
$dbTable = "student_details";
require_once('settings.php');
$conn = mysqli_connect($host,$user,$pswd,$dbnm);
    if (!$conn){
        die('Could not connect mysql Server:' .mysql_error());
    }
    
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    //Handle update submission
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $student_id = $_POST['student_id'] ??'';
        $phone_number = $_POST['phone_number'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';
        
        
        $stmt = $conn->prepare("UPDATE $dbTable SET phone_number = ?, date_birth = ?  WHERE student_id = ?");
        $stmt->bind_param("sss", $phone_number,$date_of_birth,$student_id);
       
        $stmt -> execute();
        $stmt-> close();

        header("Location: managment.php");
        exit();
    }

$student_id = $_GET['student_id'] ?? '';
$stmt = $conn->prepare("SELECT * FROM $dbTable WHERE student_id= ?");
$stmt->bind_param("s", $student_id);
$stmt -> execute();
$result =$stmt->get_result();
$student = $result-> fetch_assoc();
$stmt->close();

if (!$student){
    die("Student Not Found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Student Service Portal</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="#"><i id="home_icon"  class="fa fa-home outline" ></i></a>        
              <!-- Hidden checkbox for state toggling -->      
                    <!-- Hamburger icon label -->
                    <label for="menu-toggle" class="hamburger" aria-label="Toggle Navigation">
                        <i class="fa-solid fa-bars" ></i>
                    </label>   
        </div>
        <div class="menu">
            <ul class="menu_links">     
                <li><a href="managment.php">Management</a></li>
                <li><a href="enrole_student.php">Enrole Students</a></li>
                <li><a href="manage_marks.php">Manage Marks</a></li>
                <li><a href="manage_support.php">Manage Support</a></li> 
                 
            </ul> 
        </div>
        <!--<div class="search">
                <input type="text" placeholder="search...">
         </div>-->
    </div>
</header>
<!--Banner-->
<section class="banner">
    <div class="banner_img">
        <img id="banner_id" src="images/banner_image.jpg" alt="banner_image"> <!--download from chisholm's Official Website-->   
            <div class="banner_content">
                <img class="banner_logo" src="images/logo-chisholm-white.png" alt="chisholm-online-logo-white"><!--Download from Chisholm's Website-->
                <h1>Student Management</h1>  
             </div>     
    </div>
</section>


<h2>Edit Student Information</h2>

    <form method="POST" class="form-container">
        <!-- Student ID is read-only so it cannot be altered -->
        <div class="row">
            <div class="col-25">
                <label for="student_id">Student ID (Immutable):</label>
            </div>
        <div class="col-75">
            
            <input type="text" name="student_id" value="<?= htmlspecialchars($student['student_id']) ?>">
        </div>      
        </div>
        <!-- Student Name can also be kept read-only if you prefer -->
        <div class="row"> 
            <div class="col-25">
                <label for="student_name">Student Name (Immutable):</label>
            </div>
        <div class="col-75"> 
            <input type="text" id="student_name" class="readonly-field" value="<?= htmlspecialchars($student['firstname']) ?>" readonly>
        </div>
        </div>
        <!-- These are the fields staff are allowed to update -->
        <div class ="row">
            <div class="col-25">
                 <label for="phone_number">Phone Number:</label>
            </div>
        <div class="col-75">
            <input type="tel" id="phone_number" name="phone_number" value="<?= htmlspecialchars($student['phone_number']) ?>">
        </div>
        </div>
        <div class ="row">
            <div class="col-25">
                <label for="date_of_birth">Date of Birth:</label>
            </div>
        <div class="col-75">
            
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?= htmlspecialchars($student['date_birth']) ?>">
        </div>
        </div>
        <div class="row">
            <button type="submit" id="submit_btn">Save Changes</button>
        </div>
            <a href="managment.php" id="cancle_btn">Cancel</a>
        <div class="row"></div>
    </form>

    
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