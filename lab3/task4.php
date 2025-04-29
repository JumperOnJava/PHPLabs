<?php
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];

        $upload_dir = 'images/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        $timestamp_ms = round(microtime(true) * 1000);
        $new_file_name = $timestamp_ms . '-' . $file_name;

        $upload_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $upload_path)) {
            echo "<div>Upload success: $new_file_name</div>";
            echo "<div><img src='$upload_path' width='300'></div>";
            echo "<div><a href='$upload_path'>Open</a></div>";
        } else {
            echo "<div>Upload error!</div>";
        }
}
?>

<!DOCTYPE html>
<html lang="uk">
<body>
<div>
    <h2>Завантаження зображення</h2>

    <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image" accept="image/*" required>
            <button type="submit">Завантажити</button>
    </form>

</div>
</body>
</html>