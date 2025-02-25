<?php 
session_start(); // Ensure session is started at the beginning
require_once('connection.php');

$msg = ""; // Initialize message variable

if (isset($_POST['btnLogin'])) {
    $username = $_POST['txtUName'];
    $password = $_POST['txtPsw'];

    // Use prepared statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT passw FROM Offlogin WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        
        // Verify password using password_verify()
        if (password_verify($password, $row['passw'])) {
            $_SESSION['username'] = $username;

            $stmt = $conn->prepare("SELECT offID FROM offlogin WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($offID);
            $stmt->fetch();
            $stmt->close();

            $stmt = $conn->prepare("SELECT depID FROM offdetails WHERE offID = ?");
            $stmt->bind_param("i", $offID);
            $stmt->execute();
            $stmt->bind_result($depID);
            $stmt->fetch();
            $stmt->close();
            echo $depID;

            switch ($depID) {
                case '1': header("Location: Officer1.php"); exit();
                case '2': header("Location: Officer2.php"); exit();
                case '3': header("Location: Officer3.php"); exit();
                case '4': header("Location: Officer4.php"); exit();
                case '5': header("Location: Officer5.php"); exit();
                default: $msg = "Invalid depat id";
            }
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
    <title>officer Login</title>
    <link rel="stylesheet" href="farmer.css">
</head>
<body>

    <!-- Login Section -->
    <div id="login-section" class="login-section">
        <h2>Login for officers</h2>
    
        <form id="login-form" action="OfficerLogin.php" method="post">
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

    <!-- js files need to be checked -->
    <script src="farmer.js"></script>
</body>
</html>