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
            header("Location: FarmerDashboard.php"); // Redirect to the dashboard
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
    <style>
        /* Full-screen background */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: url('images/background2.jpeg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Login Container */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
}

/* Login Box */
.login-box {
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 350px;
}

/* Logo */
.logo {
    width: 80px;
    margin-bottom: 10px;
}

/* Heading */
h2 {
    color: #2E8B57;
    font-size: 24px;
}

/* Labels */
label {
    display: block;
    font-weight: bold;
    margin: 10px 0 5px;
    color: #333;
    text-align: left;
}

/* Input Fields */
input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Login Button */
button {
    width: 100%;
    background: #2E8B57;
    color: white;
    border: none;
    padding: 12px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
}

button:hover {
    background: #1E5E3D;
}

/* Forgot Password */
p a {
    text-decoration: none;
    color: #2E8B57;
    font-size: 14px;
}

p a:hover {
    text-decoration: underline;
}

    </style>
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
