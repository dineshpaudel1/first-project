<?php
session_start();
include("nav.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #2691d9, #ffffff);
            height: 100vh;
            width: 100%;
        }

        section {
            margin-left: 500px;
            margin-top: 62.5px;
            height: 78.6vh;
        }

        .bmi-form {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 320px;
            max-width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        .calculate-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .result {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            margin-top: 16px;
            display: none;
        }

        .bmi-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .bmi-category {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <section>
        <div class="myc">
            <div class="bmi-form">
                <h1>BMI Calculator</h1>
                <label for="weight">Weight (kg):</label>
                <input type="number" id="weight" required>
                <label for="height-feet">Height (feet):</label>
                <input type="number" id="height-feet" required>
                <label for="height-inches">Height (inches):</label>
                <input type="number" id="height-inches" required>
                <label for="age">Age:</label>
                <input type="number" id="age" required>
                <button class="calculate-btn" onclick="calculateBMI()">Calculate BMI</button>
                <div class="result" id="result">
                    <p class="bmi-value">Your BMI: <span id="bmiValue"></span></p>
                    <p class="bmi-category">BMI Category: <span id="bmiCategory"></span></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function calculateBMI() {
            const weight = parseFloat(document.getElementById('weight').value);
            const heightFeet = parseFloat(document.getElementById('height-feet').value);
            const heightInches = parseFloat(document.getElementById('height-inches').value);
            const age = parseInt(document.getElementById('age').value);

            if (isNaN(weight) || isNaN(heightFeet) || isNaN(heightInches) || isNaN(age) || weight <= 0 || heightFeet <= 0 || heightInches < 0 || age <= 0) {
                alert('Please enter valid weight, height, and age values.');
                return;
            }

            const heightInMeters = ((heightFeet * 12) + heightInches) * 0.0254;
            const bmi = weight / (heightInMeters * heightInMeters);
            const bmiResult = document.getElementById('bmiValue');
            const bmiCategoryResult = document.getElementById('bmiCategory');
            const resultDiv = document.getElementById('result');

            bmiResult.textContent = bmi.toFixed(2);

            if (age < 18) {
                bmiCategoryResult.textContent = 'BMI calculation is not suitable for individuals under 18.';
            } else if (bmi < 18.5) {
                bmiCategoryResult.textContent = 'Underweight';
            } else if (bmi >= 18.5 && bmi < 24.9) {
                bmiCategoryResult.textContent = 'Normal Weight';
            } else if (bmi >= 25 && bmi < 29.9) {
                bmiCategoryResult.textContent = 'Overweight';
            } else {
                bmiCategoryResult.textContent = 'Obesity';
            }

            resultDiv.style.display = 'block';
        }
    </script>
    <?php include("footer.php"); ?>
</body>

</html>