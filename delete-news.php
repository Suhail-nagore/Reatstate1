<?php
include 'db_connection.php';

$id = $_GET['id'];

// Fetch the news to get the image path
$stmt = $pdo->prepare("SELECT image_path FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();

// Delete the news from the database
$stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
$stmt->execute([$id]);

// Remove the image file
if ($news['image_path'] && file_exists($news['image_path'])) {
    unlink($news['image_path']);
}

header('Location: manage-news.php');
exit;
?>
