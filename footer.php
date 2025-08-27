<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Gym Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        /* Complete footer redesign with modern styling */
        .myfooter {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ffffff;
            padding: 40px 0 20px;
            margin-top: auto;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-section {
            flex: 1;
            min-width: 250px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .footer-logo i {
            font-size: 2rem;
            color: #e74c3c;
            text-shadow: 0 0 10px rgba(231, 76, 60, 0.3);
        }

        .footer-logo h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
        }

        .footer-description {
            color: #cccccc;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .social-links a:hover {
            background: #e74c3c;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }

        .footer-links {
            text-align: center;
        }

        .footer-links h4 {
            color: #ffffff;
            font-size: 1.2rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 8px;
        }

        .footer-links ul li a {
            color: #cccccc;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-links ul li a:hover {
            color: #e74c3c;
            padding-left: 5px;
        }

        .footer-contact {
            text-align: right;
        }

        .footer-contact h4 {
            color: #ffffff;
            font-size: 1.2rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 10px;
            color: #cccccc;
            font-size: 0.95rem;
        }

        .contact-item i {
            color: #e74c3c;
            width: 20px;
            text-align: center;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .copyright {
            color: #cccccc;
            font-size: 0.9rem;
        }

        .copyright a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .copyright a:hover {
            color: #ffffff;
            text-shadow: 0 0 5px rgba(231, 76, 60, 0.5);
        }

        .footer-year {
            color: #e74c3c;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-contact {
                text-align: center;
            }

            .contact-item {
                justify-content: center;
            }

            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-section {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .myfooter {
                padding: 30px 0 15px;
            }

            .footer-container {
                padding: 0 15px;
            }

            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="myfooter">
        <div class="footer-container">
            <div class="footer-content">
                <!-- Added gym branding section -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-dumbbell"></i>
                        <h3>FitZone Gym</h3>
                    </div>
                    <p class="footer-description">
                        Transform your body, elevate your mind. Join our community of fitness enthusiasts and achieve
                        your goals with professional guidance and state-of-the-art equipment.
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Added quick links section -->
                <div class="footer-section footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#membership">Membership</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <!-- Added contact information section -->
                <div class="footer-section footer-contact">
                    <h4>Contact Info</h4>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Fitness Street, Gym City</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@fitzonegym.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Mon-Sun: 5AM - 11PM</span>
                    </div>
                </div>
            </div>

            <!-- Redesigned footer bottom with better styling -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <span class="footer-year">© 2025</span> Created By
                        <a href="https://www.dineshpaudel1.com.np">John doe</a>
                        | All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>