<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogId = (int)$_POST['blog_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (blog_id, name, email, comment, created_at) VALUES (:blog_id, :name, :email, :comment, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'blog_id' => $blogId,
        'name' => $name,
        'email' => $email,
        'comment' => $comment,
    ]);

    // Redirect back to the blog details page
    header("Location: blog-details.php?id=$blogId");
    exit;
}
?>
