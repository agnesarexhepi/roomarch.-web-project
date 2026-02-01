<?php
require_once '../Classes/Database.php';
require_once '../models/Project.php';

$db = (new Database())->connect();
$repo = new ProjectRepository($db);

// Fshirja
if(isset($_GET['del'])) {
    $repo->deleteProject($_GET['del']);
    header("Location: products.php");
}

$projects = $repo->getAllProjects();
?>
<div class="content">
    <h2>Lista e Projekteve</h2>
    <table border="1" width="100%" style="background: white; border-collapse: collapse;">
        <tr style="background: #eee;">
            <th>Foto</th>
            <th>Titulli</th>
            <th>Lokacioni</th>
            <th>Veprime</th>
        </tr>
        <?php foreach($projects as $p): ?>
        <tr>
            <td><img src="../uploads/<?php echo $p['image']; ?>" width="50"></td>
            <td><?php echo $p['title']; ?></td>
            <td><?php echo $p['location']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $p['id']; ?>">Edit</a> | 
                <a href="products.php?del=<?php echo $p['id']; ?>" onclick="return confirm('Sigurt?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>