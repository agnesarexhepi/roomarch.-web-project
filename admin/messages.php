<?php
require_once '../models/Contact.php';
$contactObj = new Contact();
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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_messages as $m): ?>
            <tr>
                <td><?php echo $m['id']; ?></td>
                <td><?php echo htmlspecialchars($m['emri']); ?></td>
                <td><?php echo htmlspecialchars($m['email']); ?></td>
                <td><?php echo htmlspecialchars($m['mesazhi']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>