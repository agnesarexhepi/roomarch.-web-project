<?php
session_start();

require_once 'models/Contact.php';

$message_status = "";
$status_color = "#28a745";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
    
    // Validimi Backend 
    $emri = trim($_POST['name']);
    $email = trim($_POST['email']);
    $telefoni = trim($_POST['phone']);
    $mesazhi = trim($_POST['message']);

    if (empty($emri) || empty($email) || empty($mesazhi)) {
        $message_status = "Ju lutem plotësoni fushat e obligueshme!";
        $status_color = "#dc3545";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_status = "Emaili nuk është i vlefshëm!";
        $status_color = "#dc3545";
    } else {
        // Perdorimi i OOP 
        $contactObj = new Contact();
        if ($contactObj->ruajMesazhin($emri, $email, $mesazhi)) {
            $message_status = "Mesazhi u dërgua me sukses!";
            $status_color = "#28a745";
        } else {
            $message_status = "Ndodhi një gabim në server.";
            $status_color = "#dc3545";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="contact.css">
    <link rel="icon" type="image/png" href="Photos/logo.png">

</head>
<body>
     <!-- navbari -->
    <header class="navbar">
        <nav class="nav-left">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
            </ul>
        </nav>

        <div class="logo-section">
            <img src="Photos/logo.png" alt="RoomArch Logo" class="logo-img">
            <span class="logo-text">RoomArch.</span>
        </div>

        <nav class="nav-right">
    <ul>
        <li><a href="projects.php">Projects</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        <?php if(isset($_SESSION['role'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin/dashboard.php" style="color: #d4af37; font-weight: bold;">Dashboard</a></li>
            <?php endif; ?>
            
            <li class="user-info">
                <span class="user-name">Hi, <?php echo explode(' ', $_SESSION['name'])[0]; ?>!</span>
                <a href="logout.php" class="nav-btn logout-btn">Logout</a>
            </li>
        <?php else: ?>
            <li><a href="login.php" class="nav-btn">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
    </header>

    <!-- CONTACT SECTION -->
    <section class="contact-section">
        <div class="contact-wrapper">
    
            <div class="contact-left">
                <a href="https://www.google.com/maps/place/Sheshi+N%C3%ABn%C3%AB+Tereza,+Prishtina" target="_blank" class="map-overlay" aria-label="Open Google Maps"></a>
                <span class="map-link">look at google maps →</span>

                <h1>Contact us</h1>
    
                <div class="contact-info">
                    <div>
                        <h4>OUR ADDRESS</h4>
                        <p>
                            Pristina, Kosovo<br>
                            Interior Design Studio<br>
                            Working worldwide
                        </p>
                    </div>
    
                    <div>
                        <h4>OUR CONTACTS</h4>
                        <p>
                            roomarch@gmail.com<br>
                            +383 44 000 000
                        </p>
                    </div>
                </div>
            </div>
    
            <!-- RIGHT SIDE FORM -->
            <div class="contact-form">
                <h3>FEEDBACK FORM</h3>
                
                <?php if($message_status != ""): ?>
                    <p style="color: <?php echo $status_color; ?>; font-size: 13px; margin-bottom: 15px; font-weight: bold;">
                        <?php echo $message_status; ?>
                    </p>
                <?php endif; ?>

                <form action="contact.php" method="POST">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="tel" name="phone" placeholder="Phone">
                    <textarea name="message" placeholder="Message" required></textarea>
    
                    <div class="form-bottom">
                        <label class="upload">
                            <input type="file" name="file" hidden>
                            ⬆ Upload file
                        </label>
                        <button type="submit" name="send_msg">SEND MESSAGE →</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="map-iframe-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d93893.99924286187!2d21.151744!3d42.6573824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1765814419580!5m2!1sen!2s" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>
        </div>


        <div class="social-links-bottom">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </section>

    <section class="faq-section">
        <h2>Frequently asked questions</h2>
    
        <details open>
            <summary>Do you offer online interior design services?</summary>
            <p>
                Yes. We provide online interior design consultations, mood boards,
                layout planning, and design guidance for clients worldwide.
            </p>
        </details>
    
        <details>
            <summary>Do you work on-site for interior projects?</summary>
            <p>
                Yes. We offer on-site interior design services for residential and
                commercial spaces, mainly in Kosovo and nearby regions.
            </p>
        </details>
    
        <details>
            <summary>How does the design process work?</summary>
            <p>
                We start with a consultation, understand your needs, create concepts,
                and then develop detailed design solutions based on your space and style.
            </p>
        </details>
    
        <details>
            <summary>Can I request revisions to the design?</summary>
            <p>
                Yes. We include a revision phase to make sure the final design meets
                your expectations.
            </p>
        </details>
    
        <details>
            <summary>How long does an interior design project take?</summary>
            <p>
                Project duration depends on the size and complexity of the space.
                Online projects usually take less time than full on-site designs.
            </p>
        </details>
    
    </section>
    
    <!-- footer -->
<footer class="site-footer" role="contentinfo" id="contact">
    <div class="footer-container">

        <div class="footer-left">
            <h3>RoomArch™</h3>
            <p>
                Calm, refined interior design studio offering
                both in-person and online services.
            </p>

            <div class="footer-social">
                <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.behance.net" target="_blank" aria-label="Behance">
                    <i class="fab fa-behance"></i>
                </a>
            </div>
        </div>

        <div class="footer-links">
            <h4>Extra links</h4>
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
            <a href="services.html">Services</a>
            <a href="projects.html">Projects</a>
            <a href="contact.html">Contact</a>
        </div>

        <div class="footer-contact">
            <h4>Contact</h4>
            <p>Kosovo</p>
            <p>roomarch@gmail.com</p>
            <p>+383 44 000 000</p>
        </div>

    </div>

    <div class="footer-bottom">
        © 2025 RoomArch – Interior Design Studio
        <a href="#" class="back-top">↑ Back to top</a>
    </div>
</footer>

</body>
</html>
