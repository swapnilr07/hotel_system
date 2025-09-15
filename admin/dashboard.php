<?php
session_start();
if($_SESSION['role'] != 'admin'){ header("Location: ../index.php"); exit; }
include '../includes/config.php';
include '../includes/header.php';
?>
<div class="row g-4">
  <div class="col-md-3 col-sm-6">
    <div class="card text-center shadow-sm p-3">
      <h5>Total Rooms</h5>
      <h3><?php echo $conn->query("SELECT * FROM rooms")->num_rows; ?></h3>
      <a href="rooms.php" class="btn btn-sm btn-primary mt-2">Manage</a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="card text-center shadow-sm p-3">
      <h5>Total Bookings</h5>
      <h3><?php echo $conn->query("SELECT * FROM bookings")->num_rows; ?></h3>
      <a href="bookings.php" class="btn btn-sm btn-success mt-2">View</a>
    </div>
  </div>
  <?php if($_SESSION['role']=='admin'){ ?>
  <div class="col-md-3 col-sm-6">
    <div class="card text-center shadow-sm p-3">
      <h5>Total Users</h5>
      <h3><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h3>
      <a href="users.php" class="btn btn-sm btn-warning mt-2">Manage</a>
    </div>
  </div>
  <?php } ?>
</div>


<div class="container mt-4">
  <div class="row">
    <div class="col-md-3">
      <div class="card text-center bg-primary text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Rooms</h5>
          <p class="card-text"><?php echo $conn->query("SELECT * FROM rooms")->num_rows; ?></p>
          <a href="rooms.php" class="btn btn-light btn-sm">Manage</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center bg-success text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Bookings</h5>
          <p class="card-text"><?php echo $conn->query("SELECT * FROM bookings")->num_rows; ?></p>
          <a href="bookings.php" class="btn btn-light btn-sm">Manage</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center bg-warning text-dark mb-3">
        <div class="card-body">
          <h5 class="card-title">Users</h5>
          <p class="card-text"><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></p>
          <a href="users.php" class="btn btn-dark btn-sm">Manage</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<footer class="bg-light text-center text-muted py-2 mt-4 border-top">
    <small>© <?php echo date("Y"); ?> Created by <strong>Swapnil Rathod</strong></small>
</footer>
</body>
</html>
