<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    // Fetch the blog to get the image path
    $sql = "SELECT image_path FROM blogs WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$blogId]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($blog) {
        // Delete the blog
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$blogId]);

        // Delete the image file
        if (file_exists($blog['image_path'])) {
            unlink($blog['image_path']);
        }

        header("Location: manage-blogs.php");
        exit();
    } else {
        echo "Blog not found.";
    }
} else {
    echo "Invalid blog ID.";
}
?>
