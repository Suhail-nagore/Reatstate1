<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    // Fetch blog details
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$blogId]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$blog) {
        echo "Blog not found.";
        exit();
    }
} else {
    echo "Invalid blog ID.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $subheading = $_POST['subheading'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];
    $paragraph4 = $_POST['paragraph4'];
    $conclusion = $_POST['conclusion'];

    $imagePath = $blog['image_path'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Delete the old image if a new one is uploaded
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Handle file upload
        $imageDir = 'uploads/';
        $imagePath = $imageDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    // Update blog in the database
    $sql = "UPDATE blogs SET title = ?, subheading = ?, paragraph1 = ?, paragraph2 = ?, paragraph3 = ?, paragraph4 = ?, conclusion = ?, image_path = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $subheading, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $conclusion, $imagePath, $blogId]);

    header("Location: manage-blogs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Blog</h1>
    <form action="edit-blog.php?id=<?php echo $blogId; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="subheading">Subheading</label>
            <input type="text" name="subheading" class="form-control" value="<?php echo htmlspecialchars($blog['subheading']); ?>" required>
        </div>
        <div class="form-group">
            <label for="paragraph1">Paragraph 1</label>
            <textarea name="paragraph1" class="form-control" rows="4" required><?php echo htmlspecialchars($blog['paragraph1']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="paragraph2">Paragraph 2</label>
            <textarea name="paragraph2" class="form-control" rows="4" required><?php echo htmlspecialchars($blog['paragraph2']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="paragraph3">Paragraph 3</label>
            <textarea name="paragraph3" class="form-control" rows="4" required><?php echo htmlspecialchars($blog['paragraph3']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="paragraph4">Paragraph 4</label>
            <textarea name="paragraph4" class="form-control" rows="4" required><?php echo htmlspecialchars($blog['paragraph4']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="conclusion">Conclusion</label>
            <textarea name="conclusion" class="form-control" rows="4" required><?php echo htmlspecialchars($blog['conclusion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            <small>Leave blank to keep the current image.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>
</body>
</html>
