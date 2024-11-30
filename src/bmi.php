<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bmi.css">
    <title>BMI Calculator</title>
</head>
<body>
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



<div class="bmi-container">
    <div class="bmi-calculator">
        <h2>BMI Calculator</h2>
        <form>
            <label for="height">Height (cm)</label>
            <input type="number" id="height" name="height" placeholder="Enter height" required>
            
            <label for="weight">Weight (kg)</label>
            <input type="number" id="weight" name="weight" placeholder="Enter weight" required>

            <button type="button" onclick="calculateBMI()">Calculate BMI</button>
        </form>
    </div>
    
    <div class="bmi-result">
        <h2>Your BMI is</h2>
        <p id="bmiValue">--</p>
        <p id="bmiCategory"></p>
        <div class="cta-section">
            <p>Take the first step to unlocking a new you!</p>
            <p>Our members trust Fitness Master for their fitness & nutrition needs</p>
            <button onclick="window.location.href='register.php'">Start your journey with Fitness Master</button>
        </div>
    </div>
</div>

<script>
    function calculateBMI() {
        const height = parseFloat(document.getElementById('height').value);
        const weight = parseFloat(document.getElementById('weight').value);
        if (height > 0 && weight > 0) {
            const bmi = weight / ((height / 100) * (height / 100));
            document.getElementById('bmiValue').textContent = bmi.toFixed(2);
            
            let category = "";
            if (bmi < 18.5) {
                category = "Underweight";
            } else if (bmi >= 18.5 && bmi < 24.9) {
                category = "Normal weight";
            } else if (bmi >= 25 && bmi < 29.9) {
                category = "Overweight";
            } else {
                category = "Obesity";
            }
            document.getElementById('bmiCategory').textContent = category;
        }
    }
</script>

<?php include 'footer.php'; ?>
</body>
</html>
