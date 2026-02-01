<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../Classes/Database.php';
require_once '../models/Project.php';

if (isset($_POST['save_project'])) {
    $db = (new Database())->connect();
    $repo = new ProjectRepository($db);

    $title = htmlspecialchars($_POST['title']);
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);
    
    $created_by = $_SESSION['username'] ?? 'Admin'; 

    $imageName = time() . "_" . $_FILES['image']['name']; // Emër unik për të shmangur mbishkrimin
    $tmpPath = $_FILES['image']['tmp_name'];
    $destination = "../uploads/" . $imageName; // Fotot ruhen te rrënja /uploads/

    if (!is_dir('../uploads')) {
        mkdir('../uploads', 0777, true);
    }

    if (move_uploaded_file($tmpPath, $destination)) {
        if ($repo->addProject($title, $location, $imageName, $description, $created_by)) {
            echo "<script>alert('Projekti u shtua me sukses!'); window.location='products.php';</script>";
        } else {
            echo "<script>alert('Gabim gjatë ruajtjes në databazë.');</script>";
        }
    } else {
        echo "<script>alert('Dështoi ngarkimi i fotos. Kontrolloni folderin uploads.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shto Projekt - RoomArch Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .form-container { background: white; width: 100%; max-width: 500px; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #111; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        label { display: block; margin-top: 15px; font-weight: bold; color: #555; }
        input, textarea { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        button { background: #111; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer; width: 100%; margin-top: 20px; font-size: 16px; transition: 0.3s; }
        button:hover { background: #333; }
        .back-link { display: inline-block; margin-top: 15px; color: #666; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2><i class="fas fa-plus-circle"></i> Shto Projekt të Ri</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Titulli i Projektit</label>
            <input type="text" name="title" placeholder="p.sh. Modern Living Room" required>
            
            <label>Lokacioni</label>
            <input type="text" name="location" placeholder="p.sh. Prishtinë" required>
            
            <label>Përshkrimi</label>
            <textarea name="description" placeholder="Shkruani detajet e projektit..." rows="4" required></textarea>
            
            <label>Fotoja e Projektit (JPG, PNG)</label>
            <input type="file" name="image" accept="image/*" required>
            
            <button type="submit" name="save_project">Ruaj Projektin</button>
        </form>
        <a href="dashboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Kthehu te Dashboard</a>
    </div>
</body>
</html>