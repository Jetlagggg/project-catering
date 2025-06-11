<?php
// Halaman About Us untuk website promosi
?>

<div class="about-hero">
    <div class="about-container">        <div class="section-title">
            <h2>Tentang Kami</h2>
        </div>
    </div>
</div>

<div class="about-container">    <div class="about-content">
        <div class="about-image">
            <div class="family88-placeholder">
                <div class="placeholder-content">
                    <i class="fas fa-store"></i>
                    <h3>Family 88</h3>
                    <p>Premium Catering Service</p>
                    <small>Gambar akan ditampilkan setelah upload</small>
                </div>
            </div>
            <div class="image-overlay">
                <div class="overlay-content">
                    <i class="fas fa-utensils"></i>
                    <p>Family 88 Restaurant</p>
                </div>
            </div>
        </div>
        <div class="about-text">
            <h2>Katering Premium Untuk Semua Acara</h2>
            <p>Sejak 2010, Katering Family 88 telah menyediakan makanan dan layanan luar biasa untuk acara dengan berbagai ukuran. Yang dimulai sebagai bisnis keluarga kecil telah tumbuh menjadi salah satu perusahaan katering paling terpercaya di wilayah ini.</p>            <p>Tim koki profesional dan staf kami berdedikasi untuk membuat acara Anda berkesan dengan makanan lezat yang dibuat menggunakan bahan-bahan terbaik. Dari acara perusahaan hingga pernikahan, kami memberikan komitmen dan kualitas yang sama untuk setiap kesempatan.</p>
            <p>Di Family 88, kami percaya bahwa makanan lezat menyatukan orang. Itulah mengapa kami mencurahkan hati dan jiwa ke setiap hidangan yang kami siapkan, memastikan pengalaman bersantap yang tak terlupakan untuk Anda dan tamu Anda.</p>
        </div>
    </div>
    
    <div class="about-values">
        <div class="section-title">
            <h2>Nilai-Nilai Kami</h2>
        </div>
        
        <div class="feature-container">            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Semangat</h3>
                <p>Kami bersemangat tentang makanan dan memberikan layanan luar biasa kepada klien kami.</p>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3>Kualitas</h3>
                <p>Kami hanya menggunakan bahan-bahan terbaik untuk menciptakan hidangan lezat dan berkesan.</p>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3>Keandalan</h3>
                <p>Anda bisa mengandalkan kami untuk memberikan yang terbaik, setiap saat, untuk setiap acara.</p>
            </div>
        </div>
    </div>
      <div class="about-team">
        <div class="section-title">
            <h2>Tim Kami</h2>
        </div>
        
        <div class="feature-container">
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-user-chef"></i>
                </div>
                <h3>Chef Bambang</h3>
                <p>Kepala Chef dengan pengalaman lebih dari 15 tahun di bidang kuliner.</p>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Sari Wijaya</h3>
                <p>Manajer Acara yang berspesialisasi dalam mengoordinasi acara berskala besar.</p>
            </div>
            
            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Dimas Aryo</h3>                <p>Perancang Menu dengan keahlian dalam membuat menu khusus untuk berbagai acara.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Styling khusus untuk gambar Family 88 */
.about-image {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.family88-storefront {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.family88-storefront:hover {
    transform: scale(1.05);
}

/* Placeholder styling untuk Family 88 */
.family88-placeholder {
    width: 100%;
    height: 400px;
    background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 50%, #2c2c2c 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px dashed #ffd700;
    transition: all 0.3s ease;
}

.family88-placeholder:hover {
    transform: scale(1.02);
    border-color: #ffed4e;
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
}

.placeholder-content {
    text-align: center;
    color: #ffd700;
    padding: 2rem;
}

.placeholder-content i {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #ffd700;
    animation: pulse 2s infinite;
}

.placeholder-content h3 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: #ffffff;
    font-weight: 700;
}

.placeholder-content p {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: #ffd700;
    font-weight: 500;
}

.placeholder-content small {
    font-size: 0.9rem;
    color: #cccccc;
    font-style: italic;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.6; }
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    color: white;
    padding: 20px;
    border-radius: 0 0 15px 15px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.about-image:hover .image-overlay {
    opacity: 1;
}

.overlay-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

.overlay-content i {
    font-size: 1.2rem;
    color: #ffd700;
}

.overlay-content p {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

/* Responsif untuk mobile */
@media (max-width: 768px) {
    .family88-storefront {
        height: 250px;
    }
    
    .about-content {
        flex-direction: column;
    }
    
    .about-image {
        margin-bottom: 1.5rem;
    }
}

/* Animasi saat halaman dimuat */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.about-image {
    animation: fadeInUp 0.8s ease-out;
}

.about-text {
    animation: fadeInUp 0.8s ease-out 0.2s both;
}
</style>
