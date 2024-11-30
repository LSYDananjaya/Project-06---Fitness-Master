<?php
// Start the session
session_start();
// Include database connection
include("db.php");
include('sidebar.php'); // Include the sidebar

// READ Feedbacks
$sql = "SELECT f.*, u.name AS user_name, c.name AS coach_name 
        FROM feedbacks f 
        JOIN users u ON f.user_id = u.id 
        JOIN coaches c ON f.coach_id = c.coach_id";
$result = $con->query($sql);
$feedbacks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks - Fitness Master</title>
    <link rel="stylesheet" href="styles/feedbacks.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin-left: 250px; /* Account for sidebar width */
        }
        h1 {
            text-align: center;
            padding: 20px;
            color: #333;
        }
        .container {
            width: 90%;
            margin: auto;
        }
        .feedback-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }
        .feedback-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.2s;
        }
        .feedback-card:hover {
            transform: scale(1.05);
        }
        .card-header {
            background-color: #f8f8f8;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            padding: 15px;
        }
    </style>
</head>
<body>
    <h1>Customer Feedbacks</h1>
    
    <div class="container">
        <div class="feedback-card-container">
            <?php foreach ($feedbacks as $feedback) { ?>
                <div class="feedback-card">
                    <div class="card-header">
                        <h3><?php echo htmlspecialchars($feedback['coach_name']); ?></h3>
                    </div>
                    <div class="card-body">
                        <p><strong>User:</strong> <?php echo htmlspecialchars($feedback['user_name']); ?></p>
                        <p><strong>Rating:</strong> <span class="star-rating"><?php echo str_repeat("★", $feedback['rating']); ?></span></p>
                        <p><strong>System Rating:</strong> <span class="star-rating"><?php echo str_repeat("★", $feedback['system_rating']); ?></span></p>
                        <p><strong>Comments:</strong> <?php echo htmlspecialchars($feedback['comments']); ?></p>
                        <p><strong>Suggestions:</strong> <?php echo htmlspecialchars($feedback['improvement_suggestions']); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
