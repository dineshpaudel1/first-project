<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FitZone Gym</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/about.css">
</head>

<body>
    <main class="main-content">
        <!-- Our Story Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Our Story</h2>
                <p class="section-subtitle">From humble beginnings to becoming the premier fitness destination in the
                    community</p>
            </div>

            <div class="story-grid">
                <div class="story-content">
                    <h3>Building Dreams Since 2014</h3>
                    <p>What started as a small neighborhood gym has grown into a thriving fitness community. We believe
                        that fitness is not just about physical transformation—it's about building confidence, creating
                        lasting friendships, and developing a lifestyle that promotes overall well-being.</p>

                    <p>Our journey began with a simple mission: to create a welcoming space where people of all fitness
                        levels could pursue their health goals without intimidation. Today, we're proud to be home to
                        thousands of members who have transformed their lives through our programs.</p>
                </div>

                <div class="story-image">
                    <img src="images/gymclick.jpg" alt="FitZone Gym Interior" loading="lazy">
                </div>
            </div>
        </section>

        <!-- Our Values Section -->
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Our Core Values</h2>
                <p class="section-subtitle">The principles that guide everything we do</p>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Community First</h4>
                    <p>We foster an inclusive environment where everyone feels welcome, supported, and motivated to
                        achieve their personal best.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h4>Excellence</h4>
                    <p>We maintain the highest standards in equipment, facilities, and training programs to ensure
                        optimal results for our members.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Holistic Wellness</h4>
                    <p>We believe in nurturing both physical and mental health through comprehensive fitness programs
                        and supportive coaching.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>