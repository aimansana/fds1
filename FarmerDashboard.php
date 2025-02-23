<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: FarmerLogin.php");
    exit();
}

// Include the database connection
include 'connection.php';

// Get the logged-in farmer's ID
$username = $_SESSION['username'];

// Fetch farmer's login details from farmers
$stmt = $conn->prepare("SELECT FarmerID FROM farmers WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($farmerID);
$stmt->fetch();
$stmt->close();

// Fetch farmer's personal details from fdetails
$stmt = $conn->prepare("SELECT name, phone_no, age, sex FROM fdetails WHERE farmerID = ?");
$stmt->bind_param("i", $farmerID);
$stmt->execute();
$stmt->bind_result($name, $phone_no, $age, $sex);
$stmt->fetch();
$stmt->close();

// Fetch farmer's land details from ldetails
$land_details = [];
$stmt = $conn->prepare("SELECT landID, land_location, usages FROM ldetails WHERE farmerID = ?");
$stmt->bind_param("i", $farmerID);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $land_details[] = $row;
}
$stmt->close();

// Fetch farmer's request details from reqdetails
$stmt = $conn->prepare("SELECT requestID, status, delivery FROM reqdetails WHERE farmerID = ?");
$stmt->bind_param("i", $farmerID);
$stmt->execute();
$stmt->bind_result($requestID, $status, $delivery);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="farmer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div id="farmer-dashboard" class="farmer-tab-container">
        <h1>Farmer's Dashboard</h1>
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>

        <div class="card-container">
            <!-- Profile Card -->
            <div class="card">
                <i class="fas fa-user icon"></i>
                <h3>Farmer Profile</h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                <p><strong>Phone No:</strong> <?php echo htmlspecialchars($phone_no); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
                <p><strong>Sex:</strong> <?php echo htmlspecialchars($sex); ?></p>
            </div>

            <!-- Land Details Card -->
            <div class="card">
                <i class="fas fa-tractor icon"></i>
                <h3>Land Details</h3>
                <?php if (empty($land_details)): ?>
                    <p>No land records found.</p>
                <?php else: ?>
                    <?php foreach ($land_details as $land): ?>
                        <p><strong>Land ID:</strong> <?php echo htmlspecialchars($land['landID']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($land['land_location']); ?></p>
                        <p><strong>Usage:</strong> <?php echo htmlspecialchars($land['usages']); ?></p>
                        <hr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Request Status Card -->
            <div class="card">
                <i class="fas fa-check-circle icon"></i>
                <h3>Request Status</h3>
                <?php if (isset($requestID)): ?>
                    <p><strong>Request ID:</strong> <?php echo htmlspecialchars($requestID); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($status); ?></p>
                    <p><strong>Expected Delivery:</strong> <?php echo htmlspecialchars($delivery); ?> days</p>
                <?php else: ?>
                    <p>No active requests.</p>
                <?php endif; ?>
            </div>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a> <!-- Logout Button -->
    </div>

    <script src="farmer.js"></script>
</body>
</html>
