<?php
// Halaman 404 Not Found untuk admin panel
?>
<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found - Foody Admin</title>
    <link rel="stylesheet" href="/TubesYos/assets/style.css">
    <link rel="stylesheet" href="/TubesYos/assets/fixes_new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="dark-mode">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <div class="logo">
                <i class="fas fa-utensils logo-icon"></i>
                <h1>Foody Admin</h1>
            </div>
            <div class="header-spacer"></div>
        </header>
        
        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="error-container">
                <div class="error-content">
                    <div class="error-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h1>404</h1>
                    <h2>Page Not Found</h2>
                    <p>The page you are looking for does not exist or you don't have permission to access it.</p>
                    <div class="error-actions">
                        <a href="/TubesYos/admin/" class="btn primary-btn">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <a href="javascript:history.back()" class="btn secondary-btn">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .error-container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 2rem;
            text-align: center;
            background: #2d2d2d;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }
        
        .error-icon {
            font-size: 4rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }
        
        .error-content h1 {
            font-size: 5rem;
            color: #ff6b6b;
            margin: 0;
            line-height: 1;
        }
        
        .error-content h2 {
            font-size: 1.8rem;
            color: #fff;
            margin: 0.5rem 0 1.5rem 0;
        }
        
        .error-content p {
            font-size: 1.1rem;
            color: #aaa;
            margin-bottom: 2rem;
        }
        
        .error-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        
        .btn i {
            margin-right: 0.5rem;
        }
        
        .primary-btn {
            background-color: #ff6b6b;
            color: #fff;
        }
        
        .primary-btn:hover {
            background-color: #ff5252;
        }
        
        .secondary-btn {
            background-color: #444;
            color: #fff;
        }
        
        .secondary-btn:hover {
            background-color: #555;
        }
        
        @media (max-width: 768px) {
            .error-actions {
                flex-direction: column;
                gap: 0.8rem;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</body>
</html>
