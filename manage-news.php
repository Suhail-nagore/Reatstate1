<?php
include 'db_connection.php';

// Fetch all news from the database
$stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
$news = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-3">
            <h2>Manage News</h2>
            <br>
            <a href="add-news.php" class="btn btn-primary">Add News</a>
            <a href="dashboard.php" class="btn btn-primary">Back Dashboard</a>
        </div>
        <?php if (count($news) > 0): ?>
            <ul class="list-group">
                <?php foreach ($news as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo htmlspecialchars($item['title']); ?>
                        <div>
                            <a href="edit-news.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete-news.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No news found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
