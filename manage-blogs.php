<?php
include 'db_connection.php';

// Fetch all blogs from the database
$sql = "SELECT * FROM blogs ORDER BY published_at DESC";
$stmt = $pdo->query($sql);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Blogs</h1>
        <a href="add-blog.php" class="btn btn-primary mb-3">Add New Blog</a>
        <a href="dashboard.php" class="btn btn-primary mb-3">Back to Dashboard</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($blog['title']); ?></td>
                        
                        <td><?php echo htmlspecialchars($blog['published_at']); ?></td>
                        <td>
                            <a href="edit-blog.php?id=<?php echo $blog['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="view-comments.php?id=<?php echo $blog['id']; ?>" class="btn btn-info btn-sm">View Comments</a>
                            <a href="delete-blog.php?id=<?php echo $blog['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
