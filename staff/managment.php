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
                <li><a href="#">Management</a></li>
                <li><a href="enrole_student.php">Enrole Students</a></li>
                <li><a href="manage_marks.php">Manage Marks</a></li>
                <li><a href="manage_support.php">Manage Support</a></li> 
                 
            </ul> 
        </div>
         <div class="log-out">
            <form action="logout.php">
            <input class= "log-out"type="submit" value="Log Out" >
        </form>
        </div>
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
<!--Body Content-->
<?php
            $dbTable = "student_details";
            require_once("settings.php");

            $conn = mysqli_connect($host,$user,$pswd,$dbnm);
                if (!$conn){
                    die('Could not connect mysql Server:' .mysql_error());
                }

                
            $result =mysqli_query($conn, "SELECT student_id, firstname, lastname, gender, 
            date_birth, address, course, semester, phone_number, studey_location, student_email
              from $dbTable");
            if (mysqli_num_rows($result) > 0){

            }   
            else{
                $msg ="No Record Found";
            }    ?> 
            <h2>Studnet Details</h2>
             <table class="mange_table" id="details_table">
             <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                   
                    <th class="tablet_none">Gender</th>
                    <th>Date of Birth</th>
                    <th class="tablet_none">Address</th>
                    <th>Course</th>
                    <th class="tablet_none">Semester</th>
                    <th>Phone Number</th>
                    <th class="tablet_none">Study Location</th>
                    <th>Student Email</th>  
                    <th>Actions</th>
                    </tr>

          <?php  $i =0;
            while ($row =mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row["student_id"] ?></td>
                <td><?php echo $row["firstname"] ?></td>
                <td><?php echo $row["lastname"] ?></td>
                
                <td class="tablet_none"><?php echo $row["gender"] ?></td>
                <td><?php echo $row["date_birth"] ?></td>
                <td class="tablet_none"><?php echo $row["address"] ?></td>
                <td><?php echo $row["course"] ?></td>
                <td class="tablet_none"><?php echo $row["semester"] ?></td>
                <td><?php echo $row["phone_number"] ?></td>
                <td class="tablet_none"><?php echo $row["studey_location"] ?></td>
                <td><?php echo $row["student_email"] ?></td>
                <td>
                    <a href="edit.php?student_id=<?= $row['student_id']?>" class="btn-edit">Update</a>
                    <a href="delete.php?student_id=<?=$row['student_id']?>" class="btn-delete" onclick ="return confirm('Are you sure you want to Delete?')">Delete</a>

                </td>
            </tr>
            <?php
            $i++;
            }
            echo "</table>";
            ?>

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
        JOIN units u ON e.unit_id = u.unit_id
        ORDER BY e.id ASC
        ";

$result = mysqli_query($conn, $sql);
$search_result= null;
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['search_btn'])){
    $search = trim($_POST['search']?? '');

$sql_search="SELECT 
            e.enrol_id, 
            s.id AS student_internal_id, 
            s.student_id, 
            s.firstname, 
            u.u_code, 
            u.u_name 
        FROM enrolments e
        JOIN student_details s ON e.id = s.id
        JOIN units u ON e.unit_id = u.unit_id
        WHERE s.student_id =?
        ";

$stmt = mysqli_prepare($conn, $sql_search);
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);
$search_result = mysqli_stmt_get_result($stmt);
    }}
?>


  <h3>Current Student Enrolments</h3>
  <div class="search">
  <form action="managment.php" method="POST">
    <input type="text" name="search" placeholder="Search By ID...">
    <input id="submit_btn" type="submit" name="search_btn" value="search">
</form>
    <table class="mange_table">
        <tr>
           
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Unit Code</th>
            <th>Unit Name</th>
            
        </tr>
        <?php if (mysqli_num_rows($result) > 0): ?>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    
                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                    <td><?= htmlspecialchars($row['firstname']) ?></td>
                    <td><?= htmlspecialchars($row['u_code']) ?></td>
                    <td><?= htmlspecialchars($row['u_name']) ?></td>
                    
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">No enrolments found.</td>
            </tr>
        <?php endif; ?>
    </table>
    <h2>Search Result</h2>
    <table class="mange_table">
        <tr>
           
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Unit Code</th>
            <th>Unit Name</th>
            
        </tr>
        
        <?php if ($search_result && $search_result->num_rows > 0): ?>    
            <?php while ($row = mysqli_fetch_assoc($search_result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                    <td><?= htmlspecialchars($row['firstname']) ?></td>
                    <td><?= htmlspecialchars($row['u_code']) ?></td>
                    <td><?= htmlspecialchars($row['u_name']) ?></td>
                    
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
        
            <tr>
                <td colspan="6" style="text-align: center;">No enrolments found.</td>
            </tr>
        <?php endif; ?>
    </table>

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