<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];

    // Handle file upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $image_path = 'uploads/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $image_path);
    }

    $stmt = $pdo->prepare("INSERT INTO news (title, image_path, paragraph1, paragraph2, paragraph3) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $image_path, $paragraph1, $paragraph2, $paragraph3]);

    header('Location: manage-news.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add News</h2>
        <form action="add-news.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="paragraph1">Paragraph 1</label>
                <textarea class="form-control" id="paragraph1" name="paragraph1" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph2">Paragraph 2</label>
                <textarea class="form-control" id="paragraph2" name="paragraph2" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph3">Paragraph 3 (optional)</label>
                <textarea class="form-control" id="paragraph3" name="paragraph3" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add News</button>
        </form>
    </div>
</body>
</html>
