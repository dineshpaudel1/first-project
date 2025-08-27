<?php
session_start();
include("nav.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>BMI Calculator - FitZone</title>
    <style>
        /* ===== THEME (scoped) ===== */
        .bmi-page {
            --bg-start: #1a1a1a;
            --bg-end: #2d2d2d;
            --text: #ffffff;
            --muted: #cfcfcf;
            --accent: #e74c3c;
            --card: rgba(255, 255, 255, .06);
            --border: rgba(255, 255, 255, .15);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            min-height: calc(100vh - 0px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 16px;
        }

        .bmi-card {
            width: 100%;
            max-width: 480px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .bmi-head {
            padding: 22px 20px 14px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            background: rgba(255, 255, 255, .04);
        }

        .bmi-title {
            font-weight: 900;
            font-size: clamp(22px, 4vw, 30px);
            text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
            margin: 0 0 6px;
        }

        .bmi-sub {
            color: var(--muted);
            margin: 0;
        }

        .bmi-body {
            padding: 18px;
            display: grid;
            gap: 12px;
        }

        .field label {
            display: block;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin: 0 0 6px;
        }

        .field input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--border);
            outline: none;
            background: rgba(255, 255, 255, .08);
            color: #fff;
            transition: border-color .2s, box-shadow .2s, transform .1s;
        }

        .field input::placeholder {
            color: #9aa0a6;
        }

        .field input:focus {
            border-color: rgba(231, 76, 60, .85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, .15);
            transform: translateY(-1px);
        }

        .split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .actions {
            margin-top: 6px;
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 14px;
            border-radius: 999px;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .08);
            color: #fff;
            font-weight: 800;
            text-decoration: none;
            transition: .2s;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .25);
        }

        .btn:hover {
            background: rgba(255, 255, 255, .15);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--accent);
            border-color: rgba(231, 76, 60, .9);
        }

        .btn-primary:hover {
            background: #ff5b49;
            box-shadow: 0 10px 22px rgba(231, 76, 60, .45);
        }

        .result {
            margin-top: 6px;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, .12);
            background: rgba(255, 255, 255, .05);
            display: none;
        }

        .bmi-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 6px;
        }

        .bmi-value {
            font-size: 28px;
            font-weight: 900;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 12px;
            border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .08);
        }

        .u {
            background: #2d4b87;
        }

        /* under */
        .n {
            background: #2f7045;
        }

        /* normal */
        .o {
            background: #7a5d24;
        }

        /* over */
        .ob {
            background: #7a2b2b;
        }

        /* obese */

        .note {
            color: var(--muted);
            font-size: .95rem;
            margin-top: 6px;
        }
    </style>
</head>

<body>

    <main class="bmi-page">
        <section class="bmi-card">
            <header class="bmi-head">
                <h1 class="bmi-title">BMI Calculator</h1>
                <p class="bmi-sub">Quickly estimate your Body Mass Index</p>
            </header>

            <div class="bmi-body">
                <div class="field">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" placeholder="e.g., 70" min="1" step="0.1" />
                </div>

                <div class="split">
                    <div class="field">
                        <label for="height-feet">Height (feet)</label>
                        <input type="number" id="height-feet" placeholder="e.g., 5" min="1" />
                    </div>
                    <div class="field">
                        <label for="height-inches">Height (inches)</label>
                        <input type="number" id="height-inches" placeholder="e.g., 8" min="0" max="11" />
                    </div>
                </div>

                <div class="field">
                    <label for="age">Age</label>
                    <input type="number" id="age" placeholder="e.g., 25" min="1" />
                </div>

                <div class="actions">
                    <button class="btn btn-primary" id="calcBtn">Calculate</button>
                    <button class="btn" id="resetBtn">Reset</button>
                </div>

                <div class="result" id="result">
                    <div class="bmi-line">
                        <div class="bmi-value">BMI: <span id="bmiValue">0.00</span></div>
                        <span class="badge" id="bmiBadge">—</span>
                    </div>
                    <div class="note" id="bmiNote">Enter your details and press Calculate.</div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const els = {
            weight: document.getElementById('weight'),
            feet: document.getElementById('height-feet'),
            inches: document.getElementById('height-inches'),
            age: document.getElementById('age'),
            calc: document.getElementById('calcBtn'),
            reset: document.getElementById('resetBtn'),
            result: document.getElementById('result'),
            bmiValue: document.getElementById('bmiValue'),
            bmiBadge: document.getElementById('bmiBadge'),
            bmiNote: document.getElementById('bmiNote'),
        };

        function category(bmi, age) {
            if (age < 18) return {
                label: 'Under 18',
                badge: 'u',
                note: 'BMI ranges differ for minors. Consult a pediatric chart.'
            };
            if (bmi < 18.5) return {
                label: 'Underweight',
                badge: 'u',
                note: 'You may be under the recommended range.'
            };
            if (bmi < 24.9) return {
                label: 'Normal',
                badge: 'n',
                note: 'You are within the recommended BMI range.'
            };
            if (bmi < 29.9) return {
                label: 'Overweight',
                badge: 'o',
                note: 'Slightly above the recommended range.'
            };
            return {
                label: 'Obesity',
                badge: 'ob',
                note: 'Above the recommended range. Consider consulting a professional.'
            };
        }

        function calc() {
            const w = parseFloat(els.weight.value);
            const f = parseFloat(els.feet.value);
            const i = parseFloat(els.inches.value);
            const a = parseInt(els.age.value, 10);

            if (!w || !f || isNaN(i) || !a || w <= 0 || f <= 0 || i < 0 || a <= 0) {
                alert('Please enter valid weight, height, and age values.');
                return;
            }

            const meters = ((f * 12) + i) * 0.0254;
            const bmi = w / (meters * meters);
            const info = category(bmi, a);

            els.bmiValue.textContent = bmi.toFixed(2);
            els.bmiBadge.textContent = info.label;

            // reset badge classes
            els.bmiBadge.className = 'badge ' + info.badge;
            els.bmiNote.textContent = info.note;

            els.result.style.display = 'block';
        }

        function resetForm() {
            els.weight.value = '';
            els.feet.value = '';
            els.inches.value = '';
            els.age.value = '';
            els.result.style.display = 'none';
        }

        els.calc.addEventListener('click', calc);
        els.reset.addEventListener('click', resetForm);

        // Enter key support
        document.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                calc();
            }
        });
    </script>

    <?php include("footer.php"); ?>
</body>

</html>