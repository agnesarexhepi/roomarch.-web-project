<?php
require_once '../models/Contact.php';
$contactObj = new Contact();

// fshirje
if (isset($_GET['delete_id'])) {
    $contactObj->fshijMesazhin($_GET['delete_id']);
    header("Location: messages.php"); // Refresh
    exit();
}

$all_messages = $contactObj->merrMesazhet();
?>

<h2>Mesazhet nga klientët</h2>
<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Email</th>
            <th>Mesazhi</th>
            <th>Veprimet</th> </tr>
    </thead>
    <tbody>
    <?php foreach ($all_messages as $m): ?>
    <tr>
        <td><?php echo $m['id']; ?></td>
        <td><?php echo htmlspecialchars($m['name']); ?></td> <td><?php echo htmlspecialchars($m['email']); ?></td>
        <td><?php echo htmlspecialchars($m['message']); ?></td> <td>
            <a href="messages.php?delete_id=<?php echo $m['id']; ?>" 
               onclick="return confirm('A jeni të sigurt?')" 
               style="color: red; text-decoration: none;">Fshij</a>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>