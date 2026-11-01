<?php


session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if (!$conn) {
    die('Could not connect to MySQL Server: ' . mysqli_connect_error());
}

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
    $email = trim($_POST['email'] ?? '');
    $student_id = trim($_POST['student_id'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    // Form Validation
    if (empty($email)) {
        $error_message = "User Email is Required.";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
        $error_message = "Enter a valid Email. e.g. (usernameDigits@gmail.com)";
    }
    
    elseif (empty($student_id)) {
        $error_message = "User ID is Required.";
    } elseif (strlen((string)$student_id) !== 3) {
        $error_message = "User ID should be 3 digits.";
    }
    
    elseif (empty($password)) {
        $error_message = "Password is Required.";
    } elseif (!preg_match($pattern, $password)) {
        $error_message = "Password does not match pattern.";
    } else {
        
        $query = $conn->prepare("SELECT student_id, email, firstname, student_password FROM student_details WHERE student_id = ? AND email = ?");
        $query->bind_param("ss", $student_id, $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 1) {
            $student = $result->fetch_assoc();
            
    
            if ($student['student_password'] === $password) {
                $_SESSION['student_id'] = $student['student_id'];
                $_SESSION['firstname'] = $student['firstname'];
                $_SESSION['email'] = $student['email'];

                header("Location: enrolement.php");
                exit();
            } else {
                $error_message = "Incorrect Password entered.";
            }
        } else {
            $error_message = "Incorrect Email, Password or ID";
        }
        $query->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo '/Student_Service_Portal/css/style.css'; ?>">
        <link rel="stylesheet" href="css/mobile.css">
        <link rel="stylesheet" href="css/tablet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
   <body> 
    <div class="for-login-logo">
        <img class="login-logo" src="images/Logo.Demo.png" alt="chisholm-online-logo-white">
        <h2>HIGHER EDUCATION COLLEGE</h2> 
    </div>   
       <div class="form-container" id="form" name="forms">
        <div class="row">
            <h2>Login</h2>
        </div>

        <!-- Error Message Display -->
        <?php if (!empty($error_message)): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 4px; text-align: center; font-weight: bold;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="row">
                <div class="col-25">
                    <label for="email">Email</label>
                </div>
                <div class="col-75">
                    <input type="text" name="email" id="email" placeholder="Your Student Email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="student_id">Student ID</label>     
                </div>
                <div class="col-75">
                    <input type="text" name="student_id" id="student_id" placeholder="Your 3 digit Student ID..." value="<?php echo htmlspecialchars($_POST['student_id'] ?? ''); ?>" required>
                </div>
            </div>
            
             <div class="row">
                <div class="col-25">
                    <label for="password">Password</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Your password..." required>
                </div>
            </div>
           
            <div class="row">
                <input type="submit" name="submit" id="submit_btn" value="Login">
            </div>
        </form>
       </div>
    </div>
</body>
</html>