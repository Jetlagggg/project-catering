<?php
// Halaman sukses kontak untuk website promosi
?>

<div class="about-hero">
    <div class="about-container">        <div class="section-title">
            <h2>Pesan Terkirim!</h2>
        </div>
    </div>
</div>

<div class="success-section">
    <div class="success-container">
        <div class="success-message">
            <div class="success-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h3>Terima Kasih telah Menghubungi Kami</h3>
            <p>Pesan Anda telah berhasil dikirim ke tim kami.</p>
            <p>Kami menghargai minat Anda pada layanan Katering Foody. Tim kami akan menghubungi Anda sesegera mungkin, biasanya dalam waktu 24 jam.</p>
              <div class="next-steps">
                <h4>Apa Selanjutnya?</h4>
                <ul>
                    <li>Tim kami akan meninjau pesan Anda</li>
                    <li>Kami akan menghubungi Anda melalui email atau nomor telepon yang diberikan</li>
                    <li>Kami menantikan untuk mendiskusikan bagaimana kami dapat memenuhi kebutuhan katering Anda</li>
                </ul>
            </div>
            
            <div class="order-actions">
                <a href="/TubesYos/public/" class="hero-cta">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
                <a href="/TubesYos/public/?page=menu" class="secondary-btn">
                    <i class="fas fa-utensils"></i> Lihat Menu Kami
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .success-section {
        padding: 5rem 0;
    }
    
    .success-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .success-message {
        background-color: #fff;
        border-radius: 10px;
        padding: 3rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
    }
    
    .success-icon {
        font-size: 5rem;
        color: #3498db;
        margin-bottom: 2rem;
    }
    
    .success-message h3 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #333;
    }
    
    .success-message p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 0.5rem;
    }
    
    .next-steps {
        margin: 3rem 0;
        text-align: left;
    }
    
    .next-steps h4 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
        color: #333;
    }
    
    .next-steps ul {
        list-style-type: none;
    }
    
    .next-steps li {
        padding: 0.5rem 0;
        position: relative;
        padding-left: 1.5rem;
    }
    
    .next-steps li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #3498db;
    }
    
    .order-actions {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .secondary-btn {
        display: inline-block;
        background-color: #f5f5f5;
        color: #666;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .secondary-btn:hover {
        background-color: #eee;
        color: #333;
    }
    
    .secondary-btn i {
        margin-right: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .success-message {
            padding: 2rem;
        }
        
        .order-actions {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
