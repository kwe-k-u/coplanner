<?php


require_once(__DIR__."/../utils/env_manager.php");
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__."/../utils/google_auth.php");


// init configuration
// $clientID = '';
// $clientSecret = '';
// $redirectUri = 'http://localhost/coplanner/test/test.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads";
    $subdir = "images"; // You can change this to any subdirectory you want
    $file = $_FILES["fileToUpload"];
    $uploadResult = upload_file($target_dir, $subdir, $file["tmp_name"], $file["name"]);

    if ($uploadResult) {
        echo "File uploaded successfully: <a href='$uploadResult'>$uploadResult</a>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Test</title>
</head>
<body>

<h2>Upload File</h2>
<form action="test.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>
</body>
</html>