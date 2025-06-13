$files = Get-ChildItem -Recurse -File -Filter *.php | Where-Object { $_ | Get-Content -Raw | Select-String -Quiet '<<<<<<< HEAD' }

foreach ($file in $files) {
    Write-Host "Processing $($file.FullName)..."
    
    # Read the file content
    $content = Get-Content -Path $file.FullName -Raw
    
    # Use regex to replace conflict markers with HEAD content only
    $modifiedContent = $content -replace '<<<<<<< HEAD\r?\n((?:.*\r?\n)*?)=======\r?\n(?:.*\r?\n)*?>>>>>>> 297394eaf5ca214fe5c7a2219f155a5643ece288\r?\n', '$1'
    
    # Write the modified content back to the file
    Set-Content -Path $file.FullName -Value $modifiedContent -NoNewline
    
    Write-Host "Resolved conflicts in $($file.FullName)"
}

Write-Host "All conflicts resolved!"
