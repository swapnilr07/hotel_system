<?php
session_start();
if($_SESSION['role'] != 'staff'){
    header("Location: ../index.php");
    exit;
}
include '../includes/config.php';
?>
<?php include '../includes/header.php'; ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Optional: Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<h1>Staff Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['username']; ?> | <a href="../logout.php">Logout</a></p>
<ul>
    <li><a href="bookings.php">Manage Bookings</a></li>
</ul>
