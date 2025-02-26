<?php 
session_start(); // Start the session
require_once('connection.php'); // Database connection
$msg="";

if (isset($_POST['btnLogin'])) {
    $username = trim($_POST['txtUName']);
    $password = trim($_POST['txtPsw']);

    // Use prepared statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT Password FROM FARMER_login WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
            // Verify password using password_verify()
        if (password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username;
            header("Location: FarmerDashboard1.php"); // Redirect to the dashboard
            exit();
            }
            else {
                $msg = "Invalid Password";
            }
        }else {
            $msg = "Invalid Username";
        
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Login</title>
    <link rel="stylesheet" href="FarmerLogin.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <img src="images/background2.jpeg" alt="Farmer Logo" class="logo">
            <h2>Farmer Login</h2>
            <form id="loginForm" method="post">
                <label for="lblMsg"><b><?php echo $msg; ?></b></label>
                
                <label for="username">Username</label>
                <input type="text" id="username" name="txtUName" placeholder="Enter your username" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="txtPsw" placeholder="Enter your password" required>

                <button type="submit" name="btnLogin">Login</button>
                <p><a href="#">Forgot Password?</a></p>
            </form>
        </div>
    </div>
 
  <!-- <script src="farmer_tab.js"></script> -->
</body>
</html>
