<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../Classes/Database.php';
require_once '../models/Project.php';
require_once '../models/Contact.php';
require_once '../models/Service.php';

$db = (new Database())->connect();
$projectRepo = new ProjectRepository($db);
$allProjects = $projectRepo->getAllProjects();

$contactObj = new Contact($db); 
$allMessages = $contactObj->merrMesazhet();

$serviceObj = new Service($db);
$allServices = $serviceObj->getAllServices();

// Per perdoruesit (opsionale per momentin)
// $userRepo = new User($db);
// $allUsers = $userRepo->getAllUsers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>RoomArch - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 0; display: flex; background: #f4f4f4; }
        .sidebar { width: 250px; background: #111; color: white; height: 100vh; position: fixed; padding: 20px; }
        .sidebar h2 { color: #DAD5D1; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .sidebar a { color: #ccc; text-decoration: none; display: block; padding: 15px 0; border-bottom: 1px solid #222; }
        .sidebar a:hover { color: white; }
        
        .content { margin-left: 290px; padding: 40px; width: 100%; }
        .stats { display: flex; gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; flex: 1; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .card h3 { margin: 0; color: #555; }
        .card p { font-size: 24px; font-weight: bold; margin: 10px 0 0; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>RoomArch Admin</h2>
    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="products.php"><i class="fas fa-tasks"></i> Menaxho Projektet</a>
    <a href="services_list.php"><i class="fas fa-concierge-bell"></i> Menaxho Shërbimet</a>
    <a href="messages.php"><i class="fas fa-envelope"></i> Mesazhet</a>
    <a href="../home.php"><i class="fas fa-external-link-alt"></i> Shiko Website</a>
    <a href="../logout.php" style="color: #ff7675;"><i class="fas fa-sign-out-alt"></i> Dil</a>
</div>

<div class="content">
    <h1>Përmbledhja e Website-it</h1>
    
    <div class="stats">
           <div class="card">
             <h3>Projekte</h3>
             <p><?php echo count($allProjects); ?></p>
         </div>

         <div class="card">
            <h3>Shërbime</h3> <p><?php echo $allServices->num_rows; ?></p> 
        </div>
    
         <div class="card">
             <h3>Mesazhe</h3>
             <p><?php echo count($allMessages); ?></p> 
          </div>

        <div class="card">
             <h3>Përdorues</h3>
              <p>1</p> 
         </div>
        </div>
    <h3>Veprimet e Shpejta</h3>
    <a href="products.php" style="background: #111; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Shko te Menaxhimi i Projekteve</a>
</div>

</body>
</html>