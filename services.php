<?php
session_start();
require_once 'Classes/Database.php';
require_once 'models/Service.php';

$database = new Database();
$db = $database->connect();

$serviceModel = new Service($db);
$services = $serviceModel->getAllServices();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="services.css">
    <link rel="icon" type="image/png" href="Photos/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>
      <!-- navbari -->
      <header class="navbar">
        <nav class="nav-left">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
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
    
    <!-- SERVICES -->
    <section class="services-hero">
    <h1>Our Services</h1>
    <p>We combine architectural precision with artistic vision to create spaces that inspire.</p>
</section>
<section class="services-container">
    <?php 
    if (count($services) > 0): 
        $i = 0;
        foreach ($services as $row): 
            $layoutClass = ($i % 2 !== 0) ? 'reverse' : ''; 
    ?>
        <div class="service-row <?php echo $layoutClass; ?>">
            <div class="service-image">
                <img src="<?php echo $row['image_path']; ?>" alt="Service Image">
            </div>
            <div class="service-block <?php echo $row['block_color']; ?>"> 
                <h3><?php echo strtoupper($row['title']); ?></h3>
                <p><?php echo $row['description']; ?></p>
            </div>
        </div>
    <?php 
        $i++;
        endforeach; 
    else: 
    ?>
        <p style="color: white; text-align: center; padding: 50px;">Nuk ka shërbime për të shfaqur.</p>
    <?php endif; ?>
</section>

     <!-- PRICING -->

    <section class="pricing-container">
        <div class="pricing-header">
            <span class="eyebrow">INVESTMENT</span>
            <h2>Pricing Plans</h2>
        </div>
    
        <div class="pricing-grid">
            <div class="price-card">
                <span class="plan-name">Digital Package</span>
                <div class="price">$299<span class="unit">/room</span></div>
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> 3D Moodboard & Palette</li>
                    <li><i class="fas fa-check-circle"></i> 2D Furniture Layout</li>
                    <li><i class="fas fa-check-circle"></i> Digital Shopping List</li>
                    <li><i class="fas fa-check-circle"></i> 1 Design Revision</li>
                </ul>
                <a href="contact.php" class="price-btn">Start Online</a>
            </div>
    
            <div class="price-card featured">
                <span class="plan-name">Full Renovation</span>
                <div class="price">$999<span class="unit">/start</span></div>
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> Photorealistic 3D Renders</li>
                    <li><i class="fas fa-check-circle"></i> Technical Blueprints</li>
                    <li><i class="fas fa-check-circle"></i> On-site Supervision</li>
                    <li><i class="fas fa-check-circle"></i> Custom Furniture Design</li>
                </ul>
                <a href="contact.php" class="price-btn btn-white">Request Quote</a>
            </div>
    
            <div class="price-card">
                <span class="plan-name">Business Pro</span>
                <div class="price">$599<span class="unit">/consult</span></div>
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> Productivity Layout Audit</li>
                    <li><i class="fas fa-check-circle"></i> Acoustic & Light Design</li>
                    <li><i class="fas fa-check-circle"></i> Material Sourcing</li>
                    <li><i class="fas fa-check-circle"></i> Contractor Management</li>
                </ul>
                <a href="contact.php" class="price-btn">Book Business</a>
            </div>
        </div>
    </section>


<!-- footer -->
<section class="footer-bg">
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
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="services.php">Services</a>
            <a href="projects.php">Projects</a>
            <a href="contact.php">Contact</a>
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
</section>
</body>
</html>