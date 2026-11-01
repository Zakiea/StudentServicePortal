<?php
session_start();
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pswd, $dbnm);

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit;
}
$curr_student_id= $_SESSION['student_id'];

$sql = "SELECT 
            m.marks_id, 
            s.id AS student_internal_id, 
            s.student_id, 
            s.firstname, 
            u.u_code, 
            u.u_name,
            m.marks
        FROM marks m
        JOIN student_details s ON m.id = s.id
        JOIN units u ON m.unit_id = u.unit_id
        WHERE student_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$curr_student_id);
$stmt-> execute();
$result = $stmt->get_result();

$marks = [];
while($row =$result->fetch_assoc()){
    $marks[]= $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width= device-width, initial-scale=1.0">
        <title>Marks and Results</title>
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
                     <<div class="log-out">
                        <form action="logout.php">
                        <input class= "log-out"type="submit" value="Log Out" >
                    </form>
                    </div>
            </div>
    </header>

<div class="units_container">
    <h3 id="current_units">Current Subject marks and Results</h3>
    <!--Table containing which subjects the student has been enroled -->
    <div class="current_subj">
       <?php if(count($marks) > 0): ?>
        <table>
            <tr>
            
            <th>Unit Code</th>
            <th>Unit Name</th>
            <th>Mark</th>
            
        </tr>
        <?php foreach($marks as $mark): ?>
            <tr>
                
                    <td><?= htmlspecialchars($mark['u_code']) ?></td>
                    <td><?= htmlspecialchars($mark['u_name']) ?></td>
                    <td>
                        <?= htmlspecialchars($mark['marks']) ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else:  ?>
            <p>No Marks Found for your account yet</p>
        <?php endif; ?>
    </div>

</div>

<!--footer-->
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