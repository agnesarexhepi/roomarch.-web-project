<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Classes/Database.php';
require_once 'models/Project.php';

$database = new Database();
$dbConnection = $database->connect(); 
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="projects.css">
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
    
    <!-- PROJECTS -->
    <section class="projects-hero">
        <h1>PROJECTS</h1>
    </section>
    <div class="projects-grid"> 
    <?php
    $projectRepo = new ProjectRepository($dbConnection);
    $projects = $projectRepo->getAllProjects();

    if ($projects): 
        foreach ($projects as $project): ?>
            <div class="project-tile" style="background-image: url('uploads/<?php echo $project['image']; ?>');">
                <div class="tile-text">
                    <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($project['location']); ?></span>
                    </div>
            </div>
        <?php endforeach; 
    else: ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
            <p>Nuk u gjet asnjë projekt në databazë.</p>
        </div>
    <?php endif; ?>
</div>
    
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