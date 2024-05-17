<?php
include 'db_connection.php';

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

// Fetch the next set of blogs (5 blogs)
$sql = "SELECT blogs.*, (SELECT COUNT(*) FROM comments WHERE comments.blog_id = blogs.id) AS comment_count FROM blogs ORDER BY published_at DESC LIMIT 5 OFFSET ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$offset]);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the blogs as JSON
echo json_encode($blogs);
?>
