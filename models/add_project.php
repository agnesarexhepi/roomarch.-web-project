<?php
require_once 'classes/Database.php';
require_once 'project.php';

if (isset($_POST['save_project'])) {
    $db = (new Database())->connect();
    $repo = new ProjectRepository($db);

    $title = $_POST['title'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $created_by = "Admin";

    $imageName = $_FILES['image']['name'];
    $tmpPath = $_FILES['image']['tmp_name'];
    $destination = "uploads/" . $imageName;

    if (move_uploaded_file($tmpPath, $destination)) {
        // Thirrja e metodes
        if ($repo->addProject($title, $location, $imageName, $description, $created_by)) {
            echo "<script>alert('Projekti u shtua!'); window.location='projects.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shto Projekt - RoomArch</title>
    <style>
        .form-container { max-width: 500px; margin: 50px auto; font-family: Arial; padding: 20px; border: 1px solid #ddd; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; }
        button { background: #111; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Shto Projekt të Ri</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Titulli i Projektit" required>
            <input type="text" name="location" placeholder="Lokacioni (p.sh. Prishtinë)" required>
            <textarea name="description" placeholder="Përshkrimi i Projektit" rows="4"></textarea>
            <label>Ngarko foton:</label>
            <input type="file" name="image" required>
            <button type="submit" name="save_project">Ruaj Projektin</button>
        </form>
    </div>
</body>
</html>