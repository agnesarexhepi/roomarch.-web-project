<?php
session_start();
// Kontrolli i qasjes - vetem adminet (Kerkesa 2 & 4)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../models/Service.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
    // 1. Validimi Backend (Kerkesa 6)
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $desc = htmlspecialchars(strip_tags($_POST['description']));
    $color = $_POST['color_class'];
    $reverse = isset($_POST['is_reverse']) ? 1 : 0;
    $admin_id = $_SESSION['user_id']; // Marrim ID-ne e adminit qe po e shton (Kerkesa 3.1)

    // 2. Procesimi i Fotos (Kerkesa 3.2)
    $target_dir = "../uploads/";
    $file_name = time() . "_" . basename($_FILES["image"]["name"]); // Emer unik
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kontrolli nese eshte foto e vertete
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            
            // 3. Ruajtja ne Databaze permes Objektit (Kerkesa 6)
            $serviceModel = new Service();
            if ($serviceModel->addService($title, $desc, "uploads/" . $file_name, $color, $reverse, $admin_id)) {
                $message = "<p style='color: green;'>Sherbimi u shtua me sukses!</p>";
            } else {
                $message = "<p style='color: red;'>Gabim gjate ruajtjes ne DB.</p>";
            }
        } else {
            $message = "<p style='color: red;'>Gabim gjate upload-it te fotos.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Skedari nuk eshte imazh.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service - Admin Dashboard</title>
    <link rel="stylesheet" href="../services.css"> <style>
        .admin-form-container { max-width: 600px; margin: 50px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-submit { background: #b59a6a; color: white; border: none; cursor: pointer; padding: 12px; font-size: 16px; }
        .btn-submit:hover { background: #111; }
    </style>
</head>
<body>

<div class="admin-form-container">
    <h2>Add New Service</h2>
    <?php echo $message; ?>
    
    <form action="add_service.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Service Title</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label>Background Style</label>
            <select name="color_class">
                <option value="brown">Brown (Gold)</option>
                <option value="dark">Dark (Black)</option>
            </select>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_reverse" style="width: auto;"> Reverse Layout (Image on Right)
            </label>
        </div>

        <button type="submit" name="submit" class="btn-submit">Save Service</button>
        <a href="dashboard.php" style="display:block; text-align:center; margin-top:10px; color:#111;">Back to Dashboard</a>
    </form>
</div>

</body>
</html>