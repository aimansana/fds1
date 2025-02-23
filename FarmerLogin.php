<?php 
session_start(); // Ensure session is started at the beginning
require_once('connection.php');

$msg = ""; // Initialize message variable

if (isset($_POST['btnLogin'])) {
    $username = $_POST['txtUName'];
    $password = $_POST['txtPsw'];

    // Use prepared statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT Password FROM FARMERS WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($row = $result->fetch_assoc()) {
        // Verify password using password_verify()
        if (password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username;
            header("Location: FarmerDashboard.php"); // Redirect to the farmer dashboard
            exit();
        }
        else {
            $msg = "Invalid Username or Password";
        }
    }else {
        $msg = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FArmer Login</title>
    <link rel="stylesheet" href="farmer.css">
</head>
<body>

    <!-- Login Section -->
    <div id="login-section" class="login-section">
        <h2>Login for Farmers</h2>
    
        <form id="login-form" action="FarmerLogin.php" method="post">
            <br>
            <label for="lblMsg"><b><?php echo $msg; ?></b></label>
            <br>
            <input type="text" name="txtUName" placeholder="Username" required>
            <br>
            <input type="password" name="txtPsw" placeholder="Password" required>
            <br>
            <br>
            <button type="submit" name="btnLogin" class="btn btn-success btn-lg">Log In</button>
        </form>
    </div>
    <script src="farmer.js"></script>

</body>
</html>
