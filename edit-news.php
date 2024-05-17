<?php
include 'db_connection.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];
    $new_image_path = $news['image_path'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $new_image_path = 'uploads/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $new_image_path);
        // Remove the old image if a new one is uploaded
        if ($news['image_path'] && file_exists($news['image_path'])) {
            unlink($news['image_path']);
        }
    }

    $stmt = $pdo->prepare("UPDATE news SET title = ?, image_path = ?, paragraph1 = ?, paragraph2 = ?, paragraph3 = ? WHERE id = ?");
    $stmt->execute([$title, $new_image_path, $paragraph1, $paragraph2, $paragraph3, $id]);

    header('Location: manage-news.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit News</h2>
        <form action="edit-news.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <?php if ($news['image_path']): ?>
                    <img src="<?php echo $news['image_path']; ?>" alt="News Image" style="max-width: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="paragraph1">Paragraph 1</label>
                <textarea class="form-control" id="paragraph1" name="paragraph1" rows="3" required><?php echo htmlspecialchars($news['paragraph1']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph2">Paragraph 2</label>
                <textarea class="form-control" id="paragraph2" name="paragraph2" rows="3" required><?php echo htmlspecialchars($news['paragraph2']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph3">Paragraph 3 (optional)</label>
                <textarea class="form-control" id="paragraph3" name="paragraph3" rows="3"><?php echo htmlspecialchars($news['paragraph3']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update News</button>
        </form>
    </div>
</body>
</html>
