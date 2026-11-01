<?php
require_once('settings.php');
$conn = mysqli_connect($host, $user, $pswd, $dbnm);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// SQL Query using INNER JOINs to fetch data from all 3 tables
$sql = "SELECT 
            e.enrol_id, 
            s.id AS student_internal_id, 
            s.student_id, 
            s.firstname, 
            u.u_code, 
            u.u_name 
        FROM enrolments e
        JOIN student_details s ON e.id = s.id
        JOIN units u ON e.unit_id = u.unit_id";

$result = mysqli_query($conn, $sql);
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
                <li><a href="enrole_student.html">Enrole Students</a></li>
                <li><a href="manage_marks.html">Mange Marks</a></li>
                <li><a href="manage_support.html">Manage Support</a></li> 
                 
            </ul> 
        </div>
        <!--<div class="search">
                <input type="text" placeholder="search...">
         </div>-->
    </div>
</header>


    <h2>Current Student Enrolments</h2>

    <table>
        <tr>
            <th>Enrolment ID</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Unit Code</th>
            <th>Unit Name</th>
            
        </tr>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['enrol_id']) ?></td>
                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                    <td><?= htmlspecialchars($row['firstname']) ?></td>
                    <td><?= htmlspecialchars($row['u_code']) ?></td>
                    <td><?= htmlspecialchars($row['u_name']) ?></td>
                    <td>
                        
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">No enrolments found.</td>
            </tr>
        <?php endif; ?>
    </table>
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