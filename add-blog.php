<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $subheading = $_POST['subheading'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];
    $paragraph4 = $_POST['paragraph4'];
    $conclusion = $_POST['conclusion'];
    $image_path = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $image_path = 'uploads/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $image_path);
    }

    $sql = "INSERT INTO blogs (title, subheading, paragraph1, paragraph2, paragraph3, paragraph4, conclusion, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $subheading, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $conclusion, $image_path]);

    header('Location: manage-blogs.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Blog</h1>
        <form action="add-blog.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subheading">Subheading</label>
                <input type="text" name="subheading" id="subheading" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="paragraph1">Paragraph 1</label>
                <textarea name="paragraph1" id="paragraph1" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph2">Paragraph 2</label>
                <textarea name="paragraph2" id="paragraph2" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph3">Paragraph 3</label>
                <textarea name="paragraph3" id="paragraph3" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph4">Paragraph 4</label>
                <textarea name="paragraph4" id="paragraph4" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="conclusion">Conclusion</label>
                <textarea name="conclusion" id="conclusion" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Add Blog</button>
        </form>
    </div>
</body>
</html>
