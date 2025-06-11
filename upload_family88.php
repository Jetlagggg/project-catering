<?php
// File helper untuk upload gambar Family 88
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Gambar Family 88</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1a1a;
            color: #fff;
            padding: 2rem;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #2a2a2a;
            padding: 2rem;
            border-radius: 15px;
            border: 2px solid #ffd700;
        }
        h1 {
            color: #ffd700;
            text-align: center;
            margin-bottom: 2rem;
        }
        .upload-area {
            border: 2px dashed #ffd700;
            padding: 2rem;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            background: rgba(255, 215, 0, 0.1);
        }
        input[type="file"] {
            margin: 1rem 0;
            padding: 0.5rem;
            background: #333;
            color: #fff;
            border: 1px solid #ffd700;
            border-radius: 5px;
            width: 100%;
        }
        button {
            background: #ffd700;
            color: #000;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 1.1rem;
        }
        button:hover {
            background: #e6c200;
            transform: translateY(-2px);
        }
        .preview {
            margin-top: 1rem;
            text-align: center;
        }
        .preview img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ffd700;
        }
        .success {
            background: #28a745;
            color: white;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
            text-align: center;
        }
        .error {
            background: #dc3545;
            color: white;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-upload"></i> Upload Gambar Family 88</h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['family88_image'])) {
            $upload_dir = 'assets/img/';
            $file_name = 'family88-storefront.jpg';
            $upload_path = $upload_dir . $file_name;
            
            // Cek apakah file adalah gambar
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
            $file_type = $_FILES['family88_image']['type'];
            
            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($_FILES['family88_image']['tmp_name'], $upload_path)) {
                    echo '<div class="success">✅ Gambar Family 88 berhasil diupload! Refresh halaman About Us untuk melihat hasilnya.</div>';
                } else {
                    echo '<div class="error">❌ Gagal mengupload gambar. Cek permissions folder.</div>';
                }
            } else {
                echo '<div class="error">❌ File harus berupa gambar (JPG/PNG).</div>';
            }
        }
        ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="upload-area">
                <p><strong>Pilih gambar Family 88 storefront</strong></p>
                <p>Format: JPG atau PNG | Ukuran maksimal: 5MB</p>
                <input type="file" name="family88_image" accept="image/*" required onchange="previewImage(this)">
            </div>
            
            <div class="preview" id="preview" style="display: none;">
                <img id="preview-img" src="" alt="Preview">
            </div>
            
            <button type="submit">📤 Upload Gambar Family 88</button>
        </form>
        
        <div style="margin-top: 2rem; padding: 1rem; background: #333; border-radius: 8px;">
            <h3 style="color: #ffd700;">📋 Instruksi:</h3>
            <ol>
                <li>Klik "Choose File" dan pilih gambar Family 88</li>
                <li>Klik "Upload Gambar Family 88"</li>
                <li>Refresh halaman About Us</li>
                <li>Gambar akan muncul dengan styling yang sudah disiapkan</li>
            </ol>
        </div>
    </div>
    
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
