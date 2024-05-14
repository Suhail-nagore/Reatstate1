<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    // Fetch comments for the blog
    $sql = "SELECT * FROM comments WHERE blog_id = ? ORDER BY created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$blogId]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch blog title
    $sql = "SELECT title FROM blogs WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$blogId]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Invalid blog ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Comments</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Comments for <?php echo htmlspecialchars($blog['title']); ?></h1>
        <a href="manage-blogs.php" class="btn btn-secondary mb-3">Back to Blogs</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comment['name']); ?></td>
                        <td><?php echo htmlspecialchars($comment['email']); ?></td>
                        <td><?php echo htmlspecialchars($comment['comment']); ?></td>
                        <td><?php echo htmlspecialchars($comment['created_at']); ?></td>
                        <td>
                            <form action="delete-comment.php" method="post" style="display:inline;">
                                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                <input type="hidden" name="blog_id" value="<?php echo $blogId; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
