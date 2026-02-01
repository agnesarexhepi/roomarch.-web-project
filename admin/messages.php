<?php
session_start();

// 1. Siguria: Vetëm Admini mund ta shohë këtë faqe
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../Classes/Database.php';
require_once '../models/Contact.php';

$db = (new Database())->connect();
$contactObj = new Contact($db);

// fshirje
if (isset($_GET['delete_id'])) {
    $contactObj->fshijMesazhin($_GET['delete_id']);
    header("Location: messages.php");
    exit();
}

$all_messages = $contactObj->merrMesazhet();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mesazhet - RoomArch Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 0; display: flex; background: #f4f4f4; }
        .sidebar { width: 250px; background: #111; color: white; height: 100vh; position: fixed; padding: 20px; }
        .sidebar h2 { color: #DAD5D1; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .sidebar a { color: #ccc; text-decoration: none; display: block; padding: 15px 0; border-bottom: 1px solid #222; }
        .sidebar a:hover { color: white; }
        
        .content { margin-left: 290px; padding: 40px; width: 100%; }
        .admin-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .admin-table th, .admin-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        .admin-table th { background: #f8f8f8; color: #333; }
        .btn-delete { color: #e74c3c; font-weight: bold; text-decoration: none; }
        .btn-delete:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>RoomArch Admin</h2>
    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="products.php"><i class="fas fa-tasks"></i> Menaxho Projektet</a>
    <a href="messages.php"><i class="fas fa-envelope"></i> Mesazhet</a>
    <a href="../home.php"><i class="fas fa-external-link-alt"></i> Shiko Website</a>
    <a href="../logout.php" style="color: #ff7675;"><i class="fas fa-sign-out-alt"></i> Dil</a>
</div>

<div class="content">
    <h1>Mesazhet nga klientët</h1>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Email</th>
                <th>Mesazhi</th>
                <th>Veprimet</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($all_messages) && count($all_messages) > 0): ?>
                <?php foreach ($all_messages as $m): ?>
                <tr>
                    <td>#<?php echo $m['id']; ?></td>
                    <td><strong><?php echo htmlspecialchars($m['name']); ?></strong></td>
                    <td><?php echo htmlspecialchars($m['email']); ?></td>
                    <td><?php echo htmlspecialchars($m['message']); ?></td>
                    <td>
                        <a href="messages.php?delete_id=<?php echo $m['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('A jeni të sigurt që dëshironi ta fshini këtë mesazh?')">
                           <i class="fas fa-trash"></i> Fshij
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">Nuk ka mesazhe për momentin.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>