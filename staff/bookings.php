<?php
session_start();
if($_SESSION['role'] != 'staff'){ header("Location: ../index.php"); exit; }
include '../includes/config.php';
include '../includes/header.php';

// Add Booking
if(isset($_POST['add'])){
    $room_id = $_POST['room_id'];
    $guest_name = $_POST['guest_name'];
    $guest_phone = $_POST['guest_phone'];
    $checkin = $_POST['checkin_date'];
    $checkout = $_POST['checkout_date'];
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO bookings (room_id, guest_name, guest_phone, checkin_date, checkout_date, booked_by)
                  VALUES ('$room_id','$guest_name','$guest_phone','$checkin','$checkout','$user_id')");
    $conn->query("UPDATE rooms SET status='booked' WHERE id='$room_id'");
    $success = "Booking added successfully!";
}

// Fetch Bookings of this staff only
$result = $conn->query("SELECT b.*, r.room_number 
                        FROM bookings b
                        JOIN rooms r ON b.room_id = r.id
                        WHERE b.booked_by=".$_SESSION['user_id']);
?>

<div class="container mt-4">
<h2>Your Bookings</h2>

<?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

<!-- Add Booking Form -->
<div class="card p-3 mb-4">
<form method="POST" class="row g-3">
    <div class="col-md-3"><input class="form-control" type="text" name="guest_name" placeholder="Guest Name" required></div>
    <div class="col-md-3"><input class="form-control" type="text" name="guest_phone" placeholder="Phone" required></div>
    <div class="col-md-3">
        <select name="room_id" class="form-select" required>
            <option value="">Select Room</option>
            <?php
            $rooms = $conn->query("SELECT * FROM rooms WHERE status='available'");
            while($room = $rooms->fetch_assoc()){
                echo "<option value='{$room['id']}'>{$room['room_number']} - {$room['room_type']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-2"><input class="form-control" type="date" name="checkin_date" required></div>
    <div class="col-md-2"><input class="form-control" type="date" name="checkout_date" required></div>
    <div class="col-md-12"><button type="submit" name="add" class="btn btn-success mt-2">Book Room</button></div>
</form>
</div>

<!-- Bookings Table -->
<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Guest Name</th>
    <th>Phone</th>
    <th>Room</th>
    <th>Check-in</th>
    <th>Check-out</th>
</tr>
</thead>
<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['guest_name']; ?></td>
    <td><?php echo $row['guest_phone']; ?></td>
    <td><?php echo $row['room_number']; ?></td>
    <td><?php echo $row['checkin_date']; ?></td>
    <td><?php echo $row['checkout_date']; ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
