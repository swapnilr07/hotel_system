<?php
session_start();
if($_SESSION['role'] != 'admin'){ header("Location: ../index.php"); exit; }
include '../includes/config.php';
include '../includes/header.php';

$success = $error = "";

// add room
if(isset($_POST['add'])){
    $room_number = trim($_POST['room_number']);
    $room_type = trim($_POST['room_type']);
    $price = floatval($_POST['price']);

    if($room_number == "" || $room_type == "" || $price <= 0){
        $error = "Please fill all fields correctly!";
    } else {
        // check duplicate room
        $check = $conn->query("SELECT * FROM rooms WHERE room_number='$room_number'");
        if($check->num_rows > 0){
            $error = "Room number already exists!";
        } else {
            $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_type, price, status) VALUES (?, ?, ?, 'available')");
            $stmt->bind_param("ssd", $room_number, $room_type, $price);
            if($stmt->execute()){
                $success = "Room added successfully!";
            } else {
                $error = "Error adding room!";
            }
            $stmt->close();
        }
    }
}

// delete room
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM rooms WHERE id=$id");
    $success = "Room deleted successfully!";
}

// edit room
if(isset($_POST['update'])){
    $id = intval($_POST['id']);
    $room_number = trim($_POST['room_number']);
    $room_type = trim($_POST['room_type']);
    $price = floatval($_POST['price']);

    if($room_number=="" || $room_type=="" || $price<=0){
        $error = "Please fill all fields correctly!";
    } else {
        $stmt = $conn->prepare("UPDATE rooms SET room_number=?, room_type=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $room_number, $room_type, $price, $id);
        if($stmt->execute()){
            $success = "Room updated successfully!";
        } else {
            $error = "Error updating room!";
        }
        $stmt->close();
    }
}

// fetch all rooms
$rooms = $conn->query("SELECT * FROM rooms ORDER BY id DESC");

// fetch single room for edit
if(isset($_GET['edit'])){
    $edit_id = intval($_GET['edit']);
    $edit_room = $conn->query("SELECT * FROM rooms WHERE id=$edit_id")->fetch_assoc();
}
?>

<div class="row mt-4">

<!-- add room/ edit room from -->
<div class="col-lg-4 col-md-12 mb-4">
    <div class="card shadow-sm p-3">
        <h5><?php echo isset($edit_room)?'Edit Room':'Add New Room'; ?></h5>
        <?php if($success) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST" class="row g-2">
            <input type="hidden" name="id" value="<?php echo isset($edit_room)?$edit_room['id']:''; ?>">
            <div class="col-12"><input class="form-control" type="text" name="room_number" placeholder="Room Number" value="<?php echo isset($edit_room)?$edit_room['room_number']:''; ?>" required></div>
            <div class="col-12"><input class="form-control" type="text" name="room_type" placeholder="Room Type" value="<?php echo isset($edit_room)?$edit_room['room_type']:''; ?>" required></div>
            <div class="col-12"><input class="form-control" type="number" step="0.01" name="price" placeholder="Price" value="<?php echo isset($edit_room)?$edit_room['price']:''; ?>" required></div>
            <div class="col-12">
                <button type="submit" name="<?php echo isset($edit_room)?'update':'add'; ?>" class="btn <?php echo isset($edit_room)?'btn-success':'btn-primary'; ?> w-100 mt-2">
                    <?php echo isset($edit_room)?'Update Room':'Add Room'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- rooms tabs -->
<div class="col-lg-8 col-md-12">
    <div class="card shadow-sm p-3">
        <h5>Room List</h5>
        <div class="table-responsive">
        <table class="table table-hover align-middle table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Number</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $rooms->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo number_format($row['price'],2); ?></td>
                    <td>
                        <span class="badge <?php echo $row['status']=='available'?'bg-success':'bg-danger'; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="rooms.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="rooms.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this room?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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

