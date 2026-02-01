<?php
session_start();
// Kontrolli i qasjes (Kerkesa 2 & 4)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../Classes/Database.php';
require_once '../models/Service.php';

$database = new Database();
$db = $database->connect();

$serviceModel = new Service($db);
$services = $serviceModel->getAllServices(); // Merri te gjitha nga DB (Kerkesa 5)
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista e Shërbimeve - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #111; color: white; height: 100vh; position: fixed; padding: 20px; }
        .content { margin-left: 290px; padding: 40px; width: 100%; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th, td { padding: 15px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #111; color: white; }
        .btn-add { background: #b59a6a; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px; }
        .btn-delete { color: #e74c3c; cursor: pointer; text-decoration: none; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>RoomArch Admin</h2>
    <a href="dashboard.php" style="color:white; text-decoration:none; display:block; padding:10px 0;"> Dashboard</a>
    <a href="services_list.php" style="color:#b59a6a; text-decoration:none; display:block; padding:10px 0;"> Menaxho Shërbimet</a>
    <a href="dashboard.php" style="color:white; text-decoration:none; display:block; padding:10px 0;"> Kthehu</a>
</div>

<div class="content">
    <h1>Menaxhimi i Shërbimeve</h1>
    <a href="add_service.php" class="btn-add"><i class="fas fa-plus"></i> Shto Shërbim të Ri</a>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulli</th>
                <th>Stili</th>
                <th>Shtuar nga (Admin ID)</th> <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $s): ?>
            <tr>
                <td><img src="../<?php echo $s['image_path']; ?>" width="60" style="border-radius:4px;"></td>
                <td><?php echo $s['title']; ?></td>
                <td><?php echo $s['color_class']; ?></td>
                <td><?php echo $s['created_by']; ?></td>
                <td>
                    <a href="delete_service.php?id=<?php echo $s['id']; ?>" class="btn-delete" onclick="return confirm('A jeni i sigurt?')">
                        <i class="fas fa-trash"></i> Fshij
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>