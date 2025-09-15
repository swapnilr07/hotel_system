<?php
session_start();
if($_SESSION['role'] != 'admin'){ header("Location: ../index.php"); exit; }
include '../includes/config.php';
include '../includes/header.php';

// add User
if(isset($_POST['add'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    // check for duplicate username
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if($check->num_rows > 0){
        $error = "Username already exists!";
    } else {
        $conn->query("INSERT INTO users (username,password,role) VALUES ('$username','$password','$role')");
        $success = "User added successfully!";
    }
}

// delete User
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    $success = "User deleted successfully!";
}

// update User
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    if(!empty($_POST['password'])){
        $password = md5($_POST['password']);
        $conn->query("UPDATE users SET username='$username', role='$role', password='$password' WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET username='$username', role='$role' WHERE id=$id");
    }
    $success = "User updated successfully!";
}

// fetch all users
$users = $conn->query("SELECT * FROM users");
?>

<div class="container mt-4">
<h2>Manage Users</h2>

<?php 
if(isset($error)) echo "<div class='alert alert-danger'>$error</div>";
if(isset($success)) echo "<div class='alert alert-success'>$success</div>";
?>

<!-- add User Form -->
<div class="card p-3 mb-4">
<form method="POST" class="row g-3">
    <div class="col-md-3"><input class="form-control" type="text" name="username" placeholder="Username" required></div>
    <div class="col-md-3"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
    
</div> <!-- /container -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<footer class="bg-light text-center text-muted py-2 mt-4 border-top">
    <small>© <?php echo date("Y"); ?> Created by <strong>Swapnil Rathod</strong></small>
</footer>
</body>
</html>
