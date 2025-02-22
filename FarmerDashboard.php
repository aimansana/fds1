<!--FarmerDashboard.php -->
<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: FarmerLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="farmer.css">
</head>
<body>

    <div class="farmer-tab-container">
        <h1>Welcome, <?php echo $_SESSION['userID']; ?>!</h1>
        
        <div class="card-container">
            <!-- Profile Card -->
            <div class="card">
                <h3>Farmer Profile</h3>
                <p><strong>Username:</strong> <?php echo $_SESSION['userID']; ?></p>
            </div>
    
            <!-- Request Status Card -->
            <div class="card">
                <h3>Request Status</h3>
                <p><strong>Status:</strong> Approved</p>
                <p><strong>Expected Delivery:</strong> 5-7 days</p>
            </div>
        </div>
    
        <a href="logout.php">Logout</a>
    </div>
    <script src="farmer.js"></script>

</body>
</html>
