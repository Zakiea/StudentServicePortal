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
       <div class="log-out">
            <form action="logout.php">
            <input class= "log-out"type="submit" value="Log Out" >
        </form>
        </div>
    </div>
</header>
<!--Banner-->

<!--Body Content-->
<?php
            $dbTable = "support_enquireis";
            require_once("settings.php");

            $conn = mysqli_connect($host,$user,$pswd,$dbnm);
                if (!$conn){
                    die('Could not connect mysql Server:' .mysql_error());
                }

                
            $result =mysqli_query($conn, "SELECT *
              from $dbTable");
            if (mysqli_num_rows($result) > 0){

            }   
            else{
                $msg ="No Record Found";
            }     ?>
            <h2>Help and Support Enquiries</h2>
            <table class='mange_table'>
            <tr>
                   
                   <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                   <th>Email</th>
                    <th class="tablet_none>Gender</th>
                    <th>Studey type</th>
                    <th class="tablet_none>Campus</th>
                    <th>Title</th>
                   
                    </tr>
            <?php
            $i =0;
            while ($row =mysqli_fetch_assoc($result)){
            ?>
            <tr>
               
                <td><?php echo $row["student_id"] ?></td>
                <td><?php echo $row["firstname"] ?></td>
                <td><?php echo $row["lastname"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td class="tablet_none><?php echo $row["gender"] ?></td>
                
                <td><?php echo $row["study_type"] ?></td>
                <td class="tablet_none><?php echo $row["campus"] ?></td>
                <td><?php echo $row["title"] ?></td>
                
                
            </tr>
            <?php
            $i++;
            }
            echo "</table>";
            ?>



  
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