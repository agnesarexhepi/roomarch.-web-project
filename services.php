<?php
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
                <li><a href="login.php" class="nav-btn">Login</a></li>


            </ul>
        </nav>
    </header>
    
    <!-- SERVICES -->
    <section class="services-hero">
    <h1>Our Specialized Services</h1>
    <p>We combine architectural precision with artistic vision to create spaces that inspire.</p>
</section>
<section class="services-container">
        <?php if (count($services) > 0): ?>
            <?php foreach ($services as $row): ?>
                <div class="service-row <?php echo ($row['is_reverse']) ? 'reverse' : ''; ?>">
                    <div class="service-image">
                        <img src="<?php echo $row['image_path']; ?>" alt="Service Image">
                    </div>
                    <div class="service-block <?php echo $row['color_class']; ?>">
                        <h3><?php echo strtoupper($row['title']); ?></h3>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
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
</body>
</html>