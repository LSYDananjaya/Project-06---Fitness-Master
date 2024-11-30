<?php
// Include your database connection file
require('db.php'); // Ensure db.php sets up a MySQLi connection

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to login after logout
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar - Fitness Master</title>
    <link rel="stylesheet" href="styles/sidebar.css"> <!-- External CSS for Sidebar -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .sidebar-container {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            transition: transform 0.3s ease;
        }

        .sidebar-logo img {
            width: 120px;
            margin-bottom: 30px;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            width: 100%;
        }

        .sidebar-menu li {
            margin: 15px 0;
            position: relative;
            width: 100%;
        }

        .sidebar-menu li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: #3498db;
            transform: scale(1.05);
        }

        /* Dropdown Styles */
        .dropdown-menu {
            display: none;
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #34495e;
            border-radius: 5px;
            position: absolute;
            left: 100%;
            top: 0;
            width: 200px;
            z-index: 10;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dropdown-menu.show {
            display: block;
            opacity: 1;
        }

        .dropdown-menu li a {
            padding: 10px;
            text-align: left;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu li a:hover {
            background-color: #2980b9;
        }

        /* Logout Button */
        .logout-button {
            background-color: #e76f51;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
            margin-top: auto; /* Align at the bottom */
        }

        .logout-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="sidebar-container">
        <div class="sidebar-logo">
            <img src="images/logo.png" alt="Fitness Master Logo">
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Packages</a>
                <ul class="dropdown-menu">
                    <li><a href="addPackage.php">Add Packages</a></li>
                    <li><a href="viewPackages.php">View Packages</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Coaches</a>
                <ul class="dropdown-menu">
                    <li><a href="addCoach.php">Add Coaches</a></li>
                    <li><a href="viewCoaches.php">View Coaches</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Diets</a>
                <ul class="dropdown-menu">
                    <li><a href="addDiet_plans.php">Add Diets</a></li>
                    <li><a href="manageDiet_plans.php">View Diets</a></li>
                </ul>
            </li>
            <li><a href="feedback.php">Feedbacks</a></li>
            <li>
                <form id="logoutForm" action="" method="POST" style="display: inline;">
                    <button type="submit" name="logout" class="logout-button" onclick="return confirmLogout()">Log Out</button>
                </form>
            </li>
        </ul>
    </div>

    <script>
        // JavaScript for dropdown toggle
        document.querySelectorAll('.dropdown-toggle').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault(); // Prevent default anchor click behavior
                const dropdownMenu = item.nextElementSibling;
                dropdownMenu.classList.toggle('show');
            });
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });

        // Confirmation for logout
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</body>
</html>
