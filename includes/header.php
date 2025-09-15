
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hotel Management System</title>
<!--you can add your persnol styling  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { background-color: #f8f9fa; }
.navbar-brand { font-weight: bold; }
.card { border-radius: 12px; }
.table thead { background-color: #0d6efd; color: white; }
.table-hover tbody tr:hover { background-color: #e9ecef; }
.badge { font-size: 0.9em; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Hotel System</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if($_SESSION['role'] == 'admin'){ ?>
      <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="rooms.php">Rooms</a></li>
      <li class="nav-item"><a class="nav-link" href="bookings.php">Bookings</a></li>
      <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
      <?php } else { ?>
      <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="bookings.php">Bookings</a></li>
      <?php } ?>
    </ul>
    <span class="navbar-text text-white me-3"><?php echo $_SESSION['username']; ?></span>
    <a class="btn btn-danger btn-sm" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>
</nav>
<div class="container mt-4">
