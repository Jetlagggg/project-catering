<?php
// This is a simple script to check if the login.gif file is accessible

$gif_path = '../assets/img/login.gif';
$fallback_path = '../assets/img/cook.gif';

echo "<html><head><title>GIF Check</title></head><body>";

if (file_exists($gif_path)) {
    echo "<p>login.gif exists at expected path: $gif_path</p>";
    echo "<p>File size: " . filesize($gif_path) . " bytes</p>";
    echo "<img src='$gif_path' alt='Testing login.gif' style='max-width: 100%; border: 1px solid #ccc; margin: 10px 0;'>";
} else {
    echo "<p style='color: red;'>Error: login.gif does not exist at path: $gif_path</p>";
}

if (file_exists($fallback_path)) {
    echo "<p>cook.gif exists at fallback path: $fallback_path</p>";
    echo "<p>File size: " . filesize($fallback_path) . " bytes</p>";
    echo "<img src='$fallback_path' alt='Testing cook.gif' style='max-width: 100%; border: 1px solid #ccc; margin: 10px 0;'>";
} else {
    echo "<p style='color: red;'>Error: cook.gif does not exist at fallback path: $fallback_path</p>";
}

echo "</body></html>";
?>
