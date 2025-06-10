<?php
// Root index.php - redirect ke website promosi (public)

// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirect ke public site
header('Location: public/index.php');
exit;
