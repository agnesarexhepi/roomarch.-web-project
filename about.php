<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$pdo = require_once 'Classes/Database.php';
require_once 'Classes/Page.php';

$page = new Page($pdo);
$aboutContent = $page->get('about');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/png" href="Photos/logo.png">


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

     <!-- Manifesto -->
    <section class="about-manifesto">
        <div class="manifesto-inner">
          <h1>
            We don’t decorate space.<br>
            We design how life<br>
            moves through it.
          </h1>
          <p>
          <?= nl2br(htmlspecialchars($aboutContent['content'] ?? '')) ?>
          </p>
        </div>
      </section>
      
      <!-- About break -->
      <section class="about-break">
        <span>Space is not filled.<br>It is composed.</span>
      </section>
      
      
      <!-- About History -->
      <section class="about-history">
        <div class="history-grid">
          <span class="history-year">2019</span>
      
          <div class="history-content">
            <h2>Our Story</h2>
            <p>
                Founded with a passion for spatial clarity, RoomArch emerged to challenge interiors that favored trends over purpose. From day one, our mission was simple yet bold: 
             <b>design spaces that move with life, not against it.</b>
            </p>
            <p>
                What started as a small studio experimenting with residential layouts has grown 
                into a practice known for its thoughtful, human-centered environments. Each project 
                reflects our commitment to restraint, material honesty, and timeless architectural thinking.
            </p>
          </div>
        </div>
      </section>

      <!-- Awards -->
      <section class="about-awards">
        <div class="awards-grid">
      
          <div class="awards-text">
            <h2>Recognition</h2>
      
            <ul class="awards-list">
              <li>
                <span>2023</span>
                Interior Design Excellence Award – for innovative residential spaces
              </li>
              <li>
                <span>2022</span>
                Emerging Studio of the Year – acknowledged for forward-thinking concepts
              </li>
              <li>
                <span>2021</span>
                Architectural Concept Award – for projects that balance form and function
              </li>
            </ul>
          </div>
      
          <div class="awards-image">
            <img src="Photos/award.png" alt="Award winning interior">
          </div>
      
        </div>
      </section>


      <!-- Principles -->
      <section class="about-principles">
        <div class="principles-header">
          <h2>Our Principles</h2>
          <p>Three guiding ideas that shape every RoomArch project, from concept to completion.</p>
        </div>
      
        <div class="principles-cards">
      
          <div class="principle-card">
            <span>01</span>
            <h3>Clarity</h3>
            <p>Every element has a purpose. Spaces are intuitive, effortless, and functional.</p>
          </div>
      
          <div class="principle-card">
            <span>02</span>
            <h3>Honesty</h3>
            <p>Materials are respected and celebrated. Structure is exposed, design is truthful.</p>
          </div>
      
          <div class="principle-card">
            <span>03</span>
            <h3>Intention</h3>
            <p>Spaces are designed around how people move, live, and feel — every choice deliberate.</p>
          </div>
      
        </div>
      </section>      
      
      <!-- CTA -->
    <section class="about-cta">
        <h2>Design starts with a question.</h2>
        <a href="contact.php">Start yours</a>
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
</section>
      
</body>
</html>