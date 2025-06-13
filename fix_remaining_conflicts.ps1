$filesToFix = @(
    "C:\xampp\htdocs\TubesYos\admin\menu_management.php",
    "C:\xampp\htdocs\TubesYos\admin\register.php"
)

foreach ($file in $filesToFix) {
    Write-Host "Fixing file: $file"
    
    # Read the content
    $content = Get-Content -Path $file -Raw
    
    # Remove any remaining merge conflict markers
    $content = $content -replace '=======\r?\n(?:.*\r?\n)*?>>>>>>> 297394eaf5ca214fe5c7a2219f155a5643ece288\r?\n', ''
    
    # Write back to the file
    Set-Content -Path $file -Value $content -NoNewline
    
    Write-Host "Fixed file: $file"
}

Write-Host "All files fixed!"
