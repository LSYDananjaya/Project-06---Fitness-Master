<?php
include("db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete_plan_id'])) {
    $plan_id = $_GET['delete_plan_id'];
    $sql = "DELETE FROM workout_plans WHERE plan_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $plan_id);
    $stmt->execute();
    header("Location: view_schedule.php");
    exit();
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plan_id'])) {
    $plan_id = $_POST['plan_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $session_count = $_POST['session_count'];
    $status = $_POST['status'];

    $sql = "UPDATE workout_plans SET start_date=?, end_date=?, session_count=?, status=? WHERE plan_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssisi', $start_date, $end_date, $session_count, $status, $plan_id);
    $stmt->execute();
    header("Location: view_schedule.php");
    exit();
}

// Fetch all workout plans for the user
$user_id = 1; // Example user_id
$sql = "SELECT wp.plan_id, wp.start_date, wp.end_date, wp.session_count, wp.status, c.name as coach_name, mp.package_name 
        FROM workout_plans wp 
        JOIN coaches c ON wp.coach_id = c.coach_id 
        JOIN membership_packages mp ON wp.package_id = mp.package_id 
        WHERE wp.user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Include navbar after handling header-modifying logic
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Master - Manage Schedule Plans</title>
    <link rel="stylesheet" href="./styles/schedules.css"> <!-- Link to external CSS -->
    <style>
        .edit-button, .delete-button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            transition: background-color 0.3s;
        }

        .edit-button {
            background-color: #4caf50; /* Green */
        }

        .edit-button:hover {
            background-color: #45a049; /* Darker green */
        }

        .delete-button {
            background-color: #f44336; /* Red */
        }

        .delete-button:hover {
            background-color: #da190b; /* Darker red */
        }
    </style>
</head>
<body>

<div class="add-schedule-container">
    <a href="add_schedule_plan.php" class="add-schedule-button">Add a Schedule</a>
</div>

<div class="container">
    <h1>Your Schedule Plans</h1>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="search" placeholder="Search by Coach or Package" onkeyup="searchFunction()">
    </div>

    <table id="scheduleTable">
        <thead>
            <tr>
                <th>Plan ID</th>
                <th>Coach</th>
                <th>Package</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Sessions</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td data-label="Plan ID"><?php echo $row['plan_id']; ?></td>
                    <td data-label="Coach"><?php echo $row['coach_name']; ?></td>
                    <td data-label="Package"><?php echo $row['package_name']; ?></td>
                    <td data-label="Start Date"><?php echo $row['start_date']; ?></td>
                    <td data-label="End Date"><?php echo $row['end_date']; ?></td>
                    <td data-label="Sessions"><?php echo $row['session_count']; ?></td>
                    <td data-label="Status"><?php echo $row['status']; ?></td>
                    <td data-label="Actions">
                        <a href="#editModal<?php echo $row['plan_id']; ?>" class="edit-button" onclick="openModal(<?php echo $row['plan_id']; ?>)">Edit</a>
                        <a href="?delete_plan_id=<?php echo $row['plan_id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
                    </td>
                </tr>

              <!-- Edit Modal -->
<div id="editModal<?php echo $row['plan_id']; ?>" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal(<?php echo $row['plan_id']; ?>)">&times;</span>
        <h2>Edit Schedule Plan</h2>
        <form action="" method="post">
            <input type="hidden" name="plan_id" value="<?php echo $row['plan_id']; ?>">
            
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" required>
            </div>

            <div class="form-group">
                <label for="session_count">Sessions:</label>
                <input type="number" name="session_count" value="<?php echo $row['session_count']; ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="active" <?php if($row['status'] == 'active') echo 'selected'; ?>>Active</option>
                    <option value="inactive" <?php if($row['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="submit-button">Update Plan</button>
        </form>
    </div>
</div>

            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

<script>
    function searchFunction() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('scheduleTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            let tdCoach = tr[i].getElementsByTagName('td')[1];
            let tdPackage = tr[i].getElementsByTagName('td')[2];
            if (tdCoach || tdPackage) {
                const txtValueCoach = tdCoach.textContent || tdCoach.innerText;
                const txtValuePackage = tdPackage.textContent || tdPackage.innerText;
                if (txtValueCoach.toLowerCase().indexOf(filter) > -1 || txtValuePackage.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function openModal(planId) {
        document.getElementById("editModal" + planId).style.display = "block";
    }

    function closeModal(planId) {
        document.getElementById("editModal" + planId).style.display = "none";
    }

    window.onclick = function(event) {
        const modals = document.getElementsByClassName('modal');
        for (let i = 0; i < modals.length; i++) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
        }
    }
</script>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input, 
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .submit-button {
        background-color: #4caf50; /* Green */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .submit-button:hover {
        background-color: #45a049; /* Darker green */
    }
</style>

</body>
</html>
