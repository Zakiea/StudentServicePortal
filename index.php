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
                 <li id="courses">
                            <a href="login.php">Enrolments</a>
                        </li> 
                        <li><a href="login.php">Student Detalis</a></li>
                        <li><a href="login.php">Results</a></li>
                        <li><a href="login.php">Help and Support</a></li>
                        <li><a href="staff/staff_login.php">Management</a></li>
                 
            </ul> 
        </div>
         <div class="log-out">
            <form action="login.php">
                <input class= "log-out"type="submit" value="Login" >
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
                <h1>HIGHER EDUCATION COLLAGE</h1>  
             </div>     
    </div>
</section>
<!--Body Content-->
<section  class="content medium-4 columns" >
    <aside class="tow-columns layout-container" role="complementary" >    
        <a href="login.php">
                <div class="content-items"><span>Student Details</span>
                    <p class="content-meta">Find Out more about your details here</p>
                </div>
            </a>
            <a href="login.php">
                <div class="content-items"><span>Enrolments</span>
                    <p class="content-meta">Your Enrolement Status including current, previous Enrolements</p>
                </div>
            </a>    
            <a href="login.php">
                <div class="content-items"><span>Marks and Result</span>
                    <p class="content-meta">Find Out when and how to access your results, and understand your grades</p>
                </div>
            </a>    
            <a href="login.php">
                <div class="content-items"><span>Help and Support</span>
                    <p class="content-meta">How Can We Help you</p>
                </div>
            </a>    
    </aside>
</section>
<!--info day-->

    <div class="info_container">
        <div class="info_image">
            <img src="images/info-day-tile.jpg" alt="info_day_image">
        </div>
        <div class="info_description">
            <h2>Join Us at Info Day - register now</h2>
            <p>Experience Chisholm up close with campus tours, <br>
            information sessions and direct access to teachers <br>
            who can help you plan your future study and career journey.</p>
            <a href="https://www.chisholm.edu.au/news-and-events/events/info-days"> Find out more about Info Day</a> <!--Chisholm's info day page Link-->
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