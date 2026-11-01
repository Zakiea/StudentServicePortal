<?php
session_start();
require_once('settings.php');
$conn = mysqli_connect($host, $user, $pswd, $dbnm);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$curr_student_id= $_SESSION['student_id'];

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
        WHERE student_id=?
        ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$curr_student_id);
$stmt-> execute();
$result = $stmt->get_result();

$enrols = [];
while($row =$result->fetch_assoc()){
    $enrols[]= $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width= device-width, initial-scale=1.0">
        <title>Enrolments</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/mobile.css">
        <link rel="stylesheet" href="css/tablet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="js/javascript.js"></script>
    </head>
    <body>
        <header>
            <div class="container">
                <input type="checkbox" id="menu-toggle" class="menu-toggle">
                <div class="icon">
                    <a href="index.php"><i id="home_icon"  class="fa fa-home outline" ></i></a>        
                        <!-- Hidden checkbox for state toggling -->      
                            <!-- Hamburger icon label -->
                            <label for="menu-toggle" class="hamburger" aria-label="Toggle Navigation">
                                <i class="fa-solid fa-bars" ></i>
                            </label>   
                </div>
                <div class="menu">
                    <ul class="menu_links">
                        <li id="courses">
                            <a href="enrolement.php">Enrolments</a>
                        </li> 
                        <li><a href="student_details.php">Student Detalis</a></li>
                        <li><a href="marks_results.php">Results</a></li>
                        <li><a href="help-support.php">Help and Support</a></li>
                    </ul> 
                </div>
                     <div class="log-out">
                        <form action="logout.php">
                        <input class= "log-out" type="submit" value="Log Out" >
                    </form>
                    </div>
            </div><!--<div class="profile_dropdwn">
                        <select name="profil_dropdown" id="profile_dropdwn">
                            <option value="profile"><a href="student_details.html">Profile</a></option>
                            <option value="gredes_overview"><a href="marks_results.html">Grades Overview</a></option>
                            <option value="calender"><a href="https://mychisholm.edu.au/calendar/view.php?view=month">Calender</a></option> --><!--Chisholm's Calender page link-->
                           <!--<option value="logout"><a href="#">Log out</a></option>
                        
                        </select>
                    </div>--> 
            </div>
        </header>
<!--enrolement Body content-->
        <div class="marks_container">
            <div class="top_bar">
                <h1>Dashboard </h1>
                <h2> Hi, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h2>
            </div>
            <div class="starred_course">
                <h4>Starred Courses</h4>
                <div class="starred_course_content">
                    <img src="images/courses.svg" alt="svg_image">
                    <p>No Starred Course</p>
                </div>
            </div>
            <!--Main Content-->
            <div class="main_content">
                <h4>Course Overview</h4>
                <div class="drpdwn_search">
                    <select name="course_list" id="cousrse_list">
                        <option value="all">All</option>
                        <option value="in-progress">In Progress</option>
                        <option value="future">Future</option>
                        <option value="past">Past</option>
                        <option value="starred">Starred</option>
                        <option value="removed">Removed from View</option>  
                    </select>
                    <div class="course_search">
                        <input type="text" placeholder="search..">
                    </div>
                    <select name="sort_course" id="sort_course">
                        <option value="by name">Sort by course name</option>
                        <option value="by name">Sort by last access</option>
                    </select>
                    <select name="card" id="card">
                        <option value="card">Card</option>
                        <option value="card">List</option>
                        <option value="card">Summary</option>
                    </select>
                </div>
                <div class="card_container">
                    <div class="card_col">
                        <div class="card_row">
                            <a href="#"><img id="enrlmnt_img" src="images/mychisholm.png" alt="mychisholm"></a> 
                            <ul>
                                <li><a href="#">Getting Started with my Chisholm</a></li>
                            </ul>
                            <button id="toggle_btn" class="toggle_btn" onclick="togglefunction1()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content1" class="toggle_content">
                                    <a href="#" class="toggle_item">Star this course</a>
                                   <a href="#" class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                        
                        <div class="card_row">
                            <a href="#"><img id="enrlmnt_img" src="images/mychisholm.png" alt="mychisholm"></a> 
                            <ul>
                                <li><a href="#">Getting Started </a></li>
                            </ul>
                            <button id="toggle_btn" class="toggle_btn" onclick="togglefunction2()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content2" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                        <div class="card_row">
                            <a href="#"><img id="enrlmnt_img" src="images/mychisholm.png" alt="mychisholm"></a> 
                            <ul>
                                <li><a href="#"> my Chisholm</a></li>
                            </ul>
                            <button id="toggle_btn" class="toggle_btn" onclick="togglefunction3()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content3" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                    </div>
                    
                 <div class="card_col">
                        <div class="card_row">
                            <a href="#"><img id="enrlmnt_img" src="images/mychisholm.png" alt="mychisholm"></a> 
                            <ul>
                                <li><a href="#">Getting Started with my Chisholm</a></li>
                            </ul>
                            <button id="toggle_btn" onclick="togglefunction4()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content4" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                        <div class="card_row">
                            <a href="#"><img id="enrlmnt_img" src="images/Dashboard Image.png." alt="image"></a> 
                           <?php if(isset($enrols[0])):?>
                            
                            <ul>
                                <li><a href="#"><?php echo htmlspecialchars($enrols[0]['u_code'].'-' . $enrols[0]['u_name'] );?></a></li>

                                <?php  endif;?>
                            </ul>
                            
                        
                            <button id="toggle_btn" onclick="togglefunction5()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content5" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                        <div class="card_row">
                             <?php if(isset($enrols[1])):?>
                            <a href="#"><img id="enrlmnt_img" src="images/Dashboard Image.png" alt="image"></a> 
                            <ul>
                                <li><a href="#"><?php echo htmlspecialchars($enrols[1]['u_code'].'-' . $enrols[1]['u_name'] );?></a></li>

                                <?php  endif;?>
                            </ul>
                            <button id="toggle_btn" onclick="togglefunction6()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content6" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                    </div>
                     <div class="card_col">
                        <div class="card_row">
                            
                            <a href="#"><img id="enrlmnt_img" src="images/mychisholm.png" alt="mychisholm"></a> 
                            <ul>
                               <li><a href="#">Getting Started </a></li>
                            </ul>
                            <button id="toggle_btn" onclick="togglefunction7()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content7" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                        
                        <div class="card_row">
                            <?php if(isset($enrols[2])): ?>
                            <a href="#"><img id="enrlmnt_img" src="images/Dashboard Image.png" alt="image"></a> 
                            <ul>
                                <li><a href="#"><?php echo htmlspecialchars($enrols[2]['u_code'].'-' . $enrols[2]['u_name'] );?></a></li>

                                <?php  endif;?>
                            </ul>
                            <button id="toggle_btn" onclick="togglefunction8()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content8" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                        
                        <div class="card_row">
                            <?php if(isset($enrols[3])): ?>
                            <a href="#"><img id="enrlmnt_img" src="images/Dashboard Image.png" alt="image"></a> 
                            <ul>
                                <li><a href="#"><?php echo htmlspecialchars($enrols[3]['u_code'].'-' . $enrols[3]['u_name'] );?></a></li>

                                <?php  endif;?>
                            </ul>
                            <button id="toggle_btn" onclick="togglefunction9()">
                                <img id="toggle_image" src="images/icons8-menu-vertical-24.png" alt="">
                            </button>
                            <div id="toggle_content8" class="toggle_content">
                                    <a class="toggle_item">Star this course</a>
                                    <a class="toggle_item">Remove this course</a>
                            </div>
                        </div>
                    </div>
            
                </div>    
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