<?php
require '../includes/connect.php';

try {
    $stmt = $conn->query("SELECT * FROM users");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data 1</th>
                <th>Data 2</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= htmlspecialchars($item['column1']) ?></td>
                <td><?= htmlspecialchars($item['column2']) ?></td>
                <!-- More table data -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
