<?php
// This is a verification file to test the new dark login page with enhanced GIF contrast

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Verify Login Page Changes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .check-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .warning {
            color: orange;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Login Page Enhancement Verification</h1>
        
        <div class='check-item'>
            <h3>Dark Theme Implementation</h3>";

// Check if login.php contains the key dark theme elements
$login_content = file_get_contents('login.php');
$dark_theme_checks = [
    'Black background' => strpos($login_content, 'background-color: #000000') !== false,
    'Gold accent color' => strpos($login_content, '#ffd700') !== false,
    'Enhanced contrast' => strpos($login_content, 'filter: contrast') !== false,
    'Black form container' => strpos($login_content, 'background-color: #000000') !== false,
];

foreach ($dark_theme_checks as $check => $result) {
    echo "<p>" . ($result ? "<span class='success'>✓</span>" : "<span class='error'>✗</span>") . " {$check}</p>";
}

echo "</div>
        
        <div class='check-item'>
            <h3>GIF Background Enhancement</h3>";

// Check if the GIF file exists and login.php includes proper GIF implementations
$gif_checks = [
    'login.gif exists' => file_exists('../assets/img/login.gif'),
    'GIF as background' => strpos($login_content, "background-image: url('../assets/img/login.gif')") !== false,
    'Enhanced contrast' => strpos($login_content, 'contrast') !== false && strpos($login_content, 'brightness') !== false,
    'Animation effects' => strpos($login_content, '@keyframes') !== false,
];

foreach ($gif_checks as $check => $result) {
    echo "<p>" . ($result ? "<span class='success'>✓</span>" : "<span class='error'>✗</span>") . " {$check}</p>";
}

if (file_exists('../assets/img/login.gif')) {
    $gif_size = round(filesize('../assets/img/login.gif') / (1024 * 1024), 2);
    echo "<p><span class='warning'>ℹ</span> login.gif size: {$gif_size} MB</p>";
}

echo "</div>

        <div class='check-item'>
            <h3>Responsive Design</h3>";

// Check if responsive styles are in place
$responsive_checks = [
    'Mobile styles' => strpos($login_content, '@media (max-width: 768px)') !== false,
    'Small screen styles' => strpos($login_content, '@media (max-width: 480px)') !== false,
];

foreach ($responsive_checks as $check => $result) {
    echo "<p>" . ($result ? "<span class='success'>✓</span>" : "<span class='error'>✗</span>") . " {$check}</p>";
}

echo "</div>

        <p>To view the enhanced login page with dark theme and GIF background:</p>
        <a href='login.php' class='btn' target='_blank'>Open Login Page</a>
        <a href='test_login_gif.html' class='btn' target='_blank'>Open Side-by-Side Test</a>
    </div>
</body>
</html>";
?>
