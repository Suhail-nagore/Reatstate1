<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment_id'], $_POST['blog_id'])) {
        $commentId = $_POST['comment_id'];
        $blogId = $_POST['blog_id'];

        // Delete the comment
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$commentId]);

        // Redirect back to the view comments page
        header("Location: view-comments.php?id=$blogId");
        exit();
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>
