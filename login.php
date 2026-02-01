<?php
ob_start();
session_start();
require_once 'Classes/Database.php';
require_once 'models/User.php';

$db = (new Database())->connect();
$userModel = new User($db);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $userModel->login($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // Pastrojmë çdo output të mundshëm që mund të ketë mbetur
        ob_end_clean(); 

        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
            exit();
        } else {
            header("Location: home.php");
            exit();
        }
    } else {
        $error = "Email ose fjalëkalim i gabuar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="Photos/logo.png">

</head>
<body>

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

<main class="login-wrapper">
    <div class="container" id="container">
        <!-- SIGN UP -->
        <div class="form-container sign-up-container">
    <form method="POST" action="register.php">
        <h1>Create Account</h1>
        
        <div class="social-container">
            <a href="#" class="social"><i class="fab fa-google"></i></a>
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social"><i class="fab fa-instagram"></i></a>
        </div>

        <span>Or continue with</span>

        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Sign Up</button>
    </form>
</div>

        <!-- SIGN IN -->
        <div class="form-container sign-in-container">
    <form method="POST" action="login.php">
        <h1>Sign In</h1>
        
        <input type="email" name="email" placeholder="Email" required>
        
        <input type="password" name="password" placeholder="Password" required>

        <?php if(!empty($error)): ?>
            <span class="error" style="color: red;"><?php echo $error; ?></span>
        <?php endif; ?>

        <button type="submit">Sign In</button>
    </form>
</div>

        <!-- OVERLAY -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back</h1>
                    <p>Please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1>Welcome to RoomArch</h1>
                    <p>Create an account to access our design services</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</main>

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
