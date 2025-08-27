<?php
include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us</title>

  <style>
    :root {
      --bg-start: #1a1a1a;
      --bg-end: #2d2d2d;
      --text: #ffffff;
      --muted: #cccccc;
      --accent: #e74c3c;
      --card-bg: rgba(255, 255, 255, .06);
      --card-border: rgba(255, 255, 255, .15);
      --maxw: 1200px;
    }

    * {
      box-sizing: border-box
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      color: var(--text);
      background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
      min-height: 100vh;
    }

    /* Page wrapper */
    .container {
      min-height: 87.1vh;
      width: 100%;
      padding: 10px 10px 60px;
      display: flex;
      align-items: flex-start;
      justify-content: center;
    }

    .contact-wrapper {
      width: 100%;
      max-width: var(--maxw);
    }

    /* Header */
    .contact-header {
      text-align: center;
      padding: 26px 16px 18px;
      margin-bottom: 18px;
    }

    .contact-header h1 {
      font-size: 2.4rem;
      font-weight: 800;
      margin: 0 0 8px;
      text-shadow: 0 2px 12px rgba(0, 0, 0, .35);
    }

    .contact-header p {
      margin: 0;
      color: var(--muted);
      font-size: 1.05rem;
    }

    /* Quick contact cards */
    .contact-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 14px;
      margin: 18px 0 26px;
    }

    .ccard {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 14px;
      padding: 16px 14px;
      display: flex;
      align-items: center;
      gap: 12px;
      box-shadow: 0 10px 24px rgba(0, 0, 0, .35);
      backdrop-filter: blur(8px);
    }

    .ccard i {
      color: var(--accent);
      font-size: 1.25rem;
    }

    .ccard .cc-title {
      font-weight: 800;
      font-size: .95rem;
      margin-bottom: 2px;
    }

    .ccard .cc-sub {
      color: var(--muted);
      font-size: .95rem;
    }

    /* Main split */
    .content {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
      overflow: hidden;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
    }

    .column {
      flex: 1;
      min-width: 300px
    }

    .map-column {
      position: relative;
      min-height: 360px;
    }

    .map-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      filter: saturate(1.05) contrast(1.02);
    }

    .map-badge {
      position: absolute;
      left: 16px;
      top: 16px;
      background: rgba(231, 76, 60, .95);
      color: #fff;
      font-weight: 800;
      letter-spacing: .3px;
      padding: 6px 12px;
      border-radius: 999px;
      box-shadow: 0 6px 18px rgba(231, 76, 60, .45);
    }

    .map-footer {
      position: absolute;
      left: 16px;
      bottom: 16px;
      right: 16px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .chip {
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .18);
      color: #fff;
      padding: 6px 10px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-weight: 700;
      backdrop-filter: blur(8px);
    }

    .chip i {
      color: var(--accent)
    }

    /* Form side */
    .form-column {
      padding: 26px 22px;
    }

    .form-title {
      font-weight: 800;
      font-size: 1.35rem;
      margin: 0 0 4px;
    }

    .form-sub {
      color: var(--muted);
      margin: 0 0 14px;
    }

    label {
      color: #fff;
      font-weight: 800;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: .08em;
      display: block;
      margin: 12px 0 6px;
    }

    input[type=text],
    select,
    textarea {
      width: 100%;
      padding: 14px 14px;
      border: 1px solid var(--card-border);
      border-radius: 12px;
      background: rgba(255, 255, 255, .08);
      color: #fff;
      outline: none;
      font-size: 15.5px;
      transition: border-color .2s ease, box-shadow .2s ease, background .2s ease, transform .1s ease;
    }

    input::placeholder,
    textarea::placeholder {
      color: #9aa0a6
    }

    textarea {
      min-height: 160px;
      resize: vertical;
    }

    input[type=text]:focus,
    select:focus,
    textarea:focus {
      border-color: rgba(231, 76, 60, .9);
      background: rgba(255, 255, 255, .1);
      box-shadow: 0 0 0 4px rgba(231, 76, 60, .15);
      transform: translateY(-1px);
    }

    .actions {
      margin-top: 14px
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 20px;
      border-radius: 999px;
      border: 1px solid rgba(231, 76, 60, .9);
      background: var(--accent);
      color: #fff;
      font-weight: 800;
      cursor: pointer;
      font-size: 16px;
      box-shadow: 0 8px 20px rgba(231, 76, 60, .35);
      transition: background .2s ease, transform .1s ease, box-shadow .2s ease;
    }

    .btn:hover {
      background: #ff5b49;
      transform: translateY(-1px);
      box-shadow: 0 12px 26px rgba(231, 76, 60, .45);
    }

    .btn:active {
      transform: translateY(0)
    }

    /* Toast */
    .toast {
      position: fixed;
      right: 18px;
      bottom: 18px;
      background: rgba(40, 40, 40, .95);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, .18);
      padding: 12px 16px;
      border-radius: 12px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, .45);
      display: none;
      z-index: 2000;
    }

    .toast i {
      color: #4cd964;
      margin-right: 8px;
    }

    /* Responsive */
    @media (max-width:900px) {
      .map-column {
        min-height: 260px;
      }
    }

    @media (max-width:768px) {
      .container {
        padding: 24px 16px 50px;
      }

      .contact-header h1 {
        font-size: 2rem;
      }

      .form-column {
        padding: 20px 18px;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>

<body>
  <div class="container" id="contact">
    <div class="contact-wrapper">
      <header class="contact-header">
        <h1>Get In Touch</h1>
        <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
      </header>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- Map / Image -->
          <div class="column map-column">
            <span class="map-badge">Find Us</span>
            <!-- Keep your image (can be replaced with an embed later) -->
            <img class="map-img" src="images/gymclick.jpg" alt="Map to FitZone Gym">
            <div class="map-footer">
              <span class="chip"><i class="fa-solid fa-train-subway"></i>Near Central Station</span>
              <span class="chip"><i class="fa-solid fa-car"></i>Parking Available</span>
            </div>
          </div>

          <!-- Form -->
          <div class="column form-column">
            <h3 class="form-title">Send a Message</h3>
            <p class="form-sub">Questions, membership inquiries, or feedback? We’re here to help.</p>

            <form action="#" id="contact-form" novalidate>
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="firstname" placeholder="Enter your first name" required>

              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lastname" placeholder="Enter your last name" required>

              <label for="country">Country</label>
              <select id="country" name="country">
                <option value="nepal">Nepal</option>
                <option value="india">India</option>
                <option value="pakistan">Pakistan</option>
              </select>

              <label for="subject">Message</label>
              <textarea id="subject" name="subject" placeholder="Tell us how we can help you..."
                required></textarea>

              <div class="actions">
                <button type="submit" class="btn">
                  <i class="fa-solid fa-paper-plane"></i> Send Message
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- Toast (front-end only) -->
  <div class="toast" id="toast"><i class="fa-solid fa-circle-check"></i> Message sent! We’ll get back soon.</div>

  <script>
    // Tiny client-side UX: fake success + basic required check (no backend change).
    (function() {
      const form = document.getElementById('contact-form');
      const toast = document.getElementById('toast');

      form.addEventListener('submit', function(e) {
        e.preventDefault();

        // basic required check
        const required = ['fname', 'lname', 'subject'];
        for (const id of required) {
          const el = document.getElementById(id);
          if (!el.value.trim()) {
            el.focus();
            // simple visual nudge
            el.style.boxShadow = '0 0 0 4px rgba(231,76,60,.2)';
            setTimeout(() => el.style.boxShadow = '', 800);
            return;
          }
        }

        // show toast
        toast.style.display = 'block';
        setTimeout(() => {
          toast.style.display = 'none';
        }, 2500);

        // keep your original logic (no backend change): just reset fields
        form.reset();
      });
    })();
  </script>
</body>

<?php include "footer.php"; ?>

</html>