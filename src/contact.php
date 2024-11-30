

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Master - Contact Us</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- External CSS -->
    <script src="js/scripts.js" defer></script> <!-- External JavaScript -->
</head>
<header style="background-color: #1c3d3f; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="logo">
        <a href="#" style="font-family: 'Russo One', sans-serif; font-size: 32px; color: white; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#4ecdcc'" onmouseout="this.style.color='white'">Fitness Master</a>
    </div>
    <nav style="display: flex;">
        <ul style="list-style: none; display: flex; gap: 20px; margin: 0;">
            <li><a href="register.php" style="color: white; text-decoration: none; font-size: 18px; padding: 10px 15px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#4ecdcc'; this.style.borderRadius='5px'" onmouseout="this.style.backgroundColor=''; this.style.borderRadius=''">Sign Up</a></li>
            <li><a href="login.php" style="color: white; text-decoration: none; font-size: 18px; padding: 10px 15px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#4ecdcc'; this.style.borderRadius='5px'" onmouseout="this.style.backgroundColor=''; this.style.borderRadius=''">Sign In</a></li>
            <li><a href="bmi.php" class="active" style="color: white; text-decoration: none; font-size: 18px; padding: 10px 15px; transition: background-color 0.3s ease; background-color: #4ecdcc; border-radius: 5px;" onmouseover="this.style.backgroundColor='#4ecdcc'; this.style.borderRadius='5px'" onmouseout="this.style.backgroundColor='#4ecdcc'; this.style.borderRadius='5px'" >Calculate BMI</a></li>
            <li><a href="contact.php" style="color: white; text-decoration: none; font-size: 18px; padding: 10px 15px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#4ecdcc'; this.style.borderRadius='5px'" onmouseout="this.style.backgroundColor=''; this.style.borderRadius=''">Contact</a></li>
        </ul>
    </nav>
</header>

<body>
    <div class="contact-container">
        <div class="contact-header">
            <h1>Where to find us</h1>
            <div class="contact-info">
                <p><strong>Address:</strong> EH Cooray Building, No:24, 5th Floor, Matara</p>
                <p><strong>Email:</strong> support@fitnessmaster.com</p>
                <p><strong>Hotline:</strong> +94 041 222 1048</p>
            </div>
        </div>

        <div class="contact-content">
            <div class="contact-form">
                <h2>We care about you</h2>
                <form>
                    <input type="text" name="full_name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="text" name="phone" placeholder="Mobile Number" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Inquiry</button>
                </form>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> <!-- Embedded Google Map -->
            </div>
        </div>
    </div>

<?php
// Include footer
include("footer.php");
?>
</body>
</html>
