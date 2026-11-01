<?php 
include_once("settings.php");

$conn = mysqli_connect($host,$user,$pswd,$dbnm);
    if(!$conn)
        {
            die('Could not connect to  MySql Server:' .mysql_error());
        }

if($_SERVER['REQUEST_METHOD']==='POST'){
$dbTable = "support_enquireis";
$fname =trim ($_POST['firstname'] ?? '');
$lname = trim($_POST['lastname'] ?? '');
$student_id= trim($_POST['student_id'] ??'');
$email =trim( $_POST['email'] ?? '');
$campus =trim($_POST["campus"] ?? '');
$gender = trim($_POST["gender"] ?? '');
$study_type = $_POST['checkbox'] ?? '';
$title = trim($_POST["subject"] ?? '');

 

if(empty($fname)){
    echo'<script type="text/javascript">';
    echo'alert("User Name is Required");';
    echo'window.history.back();';
    echo'</script>';
    exit;
}
elseif(!preg_match("/^[a-zA-Z_]*$/", $fname)){
   echo'<script type="text/javascript">';
    echo'alert("Username cannot contain digits or signs");';
    echo'window.history.back();';
    echo'</script>';  
    exit; 
}

elseif(empty($lname)){
    echo'<script type="text/javascript">';
     echo'alert("User lastName is Required");';
    echo'window.history.back();';
    echo'</script>';  
    exit;
}
elseif(!preg_match("/^[a-zA-Z_]*$/", $lname)){
    echo'<script type="text/javascript">';
    echo'alert("Username cannot contain digits or signs");';
    echo'window.history.back();';

    echo'</script>';  
    exit; 
}

elseif (empty($student_id)){
    echo'<script type="text/javascript">';
    echo'alert("User ID is Required");';
    echo'window.history.back();';
    echo'</script>';
    exit;
}
elseif(strlen((string)$student_id) !== 3) {
    echo'<script type="text/javascript">';
    echo'alert("User ID should be 3 digit");';
    echo'window.history.back();';
    echo'</script>';  
    exit;
}


elseif(empty($email)){
    echo'<script type="text/javascript">';
    echo'alert("User Email is Required");';
    echo'window.history.back();';
    echo'</script>';
    exit;
}
elseif(!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)){
    echo'<script type="text/javascript">';
    echo'alert("Enter valid Email. e.g(usernameDigits@gmail.com)");';
    echo'window.history.back();';
    echo'</script>';  
    exit; 
}

elseif(empty($_POST['checkbox'])){
    echo '<script type="text/javascript">';
        echo 'alert("Please only least one");';
        echo 'window.history.back();';
        echo '</script>';
        exit;
}

elseif(empty($_POST['gender'])){
    echo '<script type="text/javascript">';
    echo 'alert("Please select a gender option");';
    echo 'window.history.back();';
    echo '</script>';
    exit;
}

elseif(empty($title)){
    echo '<script type="text/javascript">';
        echo 'alert("This section cannot be Empty");';
        echo 'window.history.back();';
        echo '</script>';
        exit;
}
elseif(!preg_match("~^[a-zA-Z0-9\s.,!?'\"():;/\\-]+$~", $title)){
echo'<script type="text/javascript">';
    echo'alert("Cannot enter invalid characters");';
    echo'window.history.back();';
    echo'</script>';  
    exit; 
}

else{



$sql_support= "CREATE TABLE IF NOT EXISTS support_enquireis(
    id INT(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    student_id varchar(3) NOT NULL UNIQUE,

    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    email varchar(100) NOT NULL,

    study_type varchar(50) NOT NULL,
    campus varchar(50) NOT NULL,
    gender char(50) NOT NULL,
    title varchar(255) NOT NULL

)";
 $conn-> query($sql_support);

 //Check for existing student_id
$stmt = $conn-> prepare("SELECT student_id FROM support_enquireis WHERE student_id=?");
$stmt ->bind_param("s", $student_id);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo'<script type="text/javascript">';
    echo'alert("this student ID is duplicated!");';
    echo'window.history.back();';
    echo'</script>';
    $stmt->close();
    exit;
}
$stmt->close();

$query = "INSERT INTO support_enquireis (student_id,firstname, lastname, email, study_type, campus, gender, title)
VALUES ('$student_id','$fname','$lname','$email',' $study_type','$campus','$gender','$title')";


if($result = mysqli_query($conn, $query)){
    echo'<script type="text/javascript">';
    echo'alert("Submitted Successfully");';
    echo'window.history.back();';
    echo'</script>';
}
 else {
        echo '<script>alert("Database Error: ' . $query->error . '"); window.history.back();</script>';
    }

    }
$conn-> close();
}
?>
<!--Front End-->
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <title>Help and Support</title>
        <link rel="stylesheet" href="<?php echo '/Student_Service_Portal/css/style.css'; ?>">
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
                        <input class= "log-out"type="submit" value="Log Out" >
                    </form>
                    </div>
        </div>
    </header>
        <!--Help $ support form-->
    
        
       <div class="form-container"  id="form" name="forms">
        <div class="row">
             <h2>Share With Us</h2></div>
        
        <form action=""  id="forms" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="fname">First Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="firstname" placeholder="Your firstname..." onmouseover="showtext()" onmouseout="hidetext()">
                    <p id="fname_span"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lname">Last Name</label>
                </div>
                <div class="col-75">
                    <input type="text" name="lastname" id="lname" placeholder="Your Last Name..." onmouseover="lshow()" onmouseout="lhide()">
                    <p id="lname_span"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Email</label>
                </div>
                <div class="col-75">
                    <input type="text" name="email" id="email" placeholder="Your Email" onmouseover="eshow()" onmouseout="ehide()">
                    <p id="email_span"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="student_id">Student ID</label>      
                </div>
                <div class="col-75">
                    <input type="text" name="student_id" id="student_id" placeholder="Your 3 digit Student ID..." onmouseover="idShow()" onmouseout="idHide()">
                    <p id="id_span"></p>
                </div>
            </div>
             <div class="row">
                <div class="col-25">
                    <label for="">Study Method</label>
                </div>
                <div class="col-75">
                    <input type="checkbox" name="checkbox" class="options" id="study_chkbx" value="online">
                    <label for="study_chkbx">online</label>
                    <input type="checkbox" name="checkbox" class="options" id="study_chkbx" value="on-campus">
                    <label for="study_chkbx">On-Campus</label>
                </div>
            </div>
            
            <div class="row">
                <div class="col-25">
                    <label for="campus">Campus</label>
                </div>
                <div class="col-75">
                    <select name="campus" id="campus">
                        <option value="dandenong">Dandenong</option>
                        <option value="frankston">Frankstone</option>
                        <option value="berwick">Berwick</option>
                        <option value="cranbourn">Cranbourn</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="gender">Gender</label>
                </div>
                <div class="col-75">
                    <input type="radio" name="gender" class="options" id="female_radio" value="Female">
                    <label for="female_radio">Female</label>
                    <input type="radio" name="gender" class="options" id="male_radio" value="Male">
                    <label for="male_radio">Male</label>
                    
                </div>
           
            <div class="row">
                <div class="col-25">
                    <label for="subject">How Can We Help</label>
                </div>
                <div class="col-75">
                    <textarea type="text" name="subject" id="form_subject" placeholder="Ask Us / How Can We Help.."></textarea>
                </div>
                
            </div>
            <div class="row">
                <input type="submit" name="submit" id="submit_btn" value="Submit">
            </div>
        </form>
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