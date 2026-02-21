<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['download'])) {
    $file = basename($_GET['download']);
    $path = __DIR__ . "/uploads/" . $file;

    if (file_exists($path)) {
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$file\"");
        header("Content-Length: " . filesize($path));
        readfile($path);
        exit;
    } else {
        die("File not found ❌");
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {

    if ($_FILES['myfile']['error'] !== 0) {
        header("Location: index.php?success=0");
        exit;
    }

    $tmp  = $_FILES['myfile']['tmp_name'];
    $name = basename($_FILES['myfile']['name']);
    $dest = __DIR__ . "/uploads/" . $name;

    if (move_uploaded_file($tmp, $dest)) {
        header("Location: index.php?success=1&file=" . urlencode($name));
        exit;
    }

    header("Location: index.php?success=0");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload & Download</title>
</head>
<body>

<h2 style="font-family: 'Gill Sans', Calibri, sans-serif; text-align:center; font-size:24px;">
    Welcome!
</h2>

<form method="POST" enctype="multipart/form-data" style="max-width:400px; margin:auto; padding:20px; border:1px solid #ccc; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1); text-align:center;">

    <input type="file" name="myfile" required style="width:90%; padding:10px; margin:5px 0;border:1px solid #ccc; border-radius:5px;"> <br><br>

    <button type="submit" style="background:#4CAF50; color:white; padding:10px 25px;border:none; border-radius:10px; font-size:16px;cursor:pointer; box-shadow:2px 2px 4px #060606;"> Upload</button>
</form>

<?php

if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['file'])) {
    $file = htmlspecialchars($_GET['file']);
    echo "<p style='color:green; text-align:center'>Uploaded successfully ✅</p>";
    echo "<p style='text-align:center'> <a href='?download=$file' style='color:blue; font-size:18px;'>⬇ Download File</a></p>";
}
?>

</body>
</html>
