<?php
// Halaman Contact untuk website promosi
?>

<div class="about-hero">
    <div class="about-container">        <div class="section-title">
            <h2>Hubungi Kami</h2>
        </div>
    </div>
</div>

<div class="contact-section">
    <div class="contact-container">
        <div class="contact-info">
            <h2>Hubungi Kami</h2>
            <p>Punya pertanyaan atau ingin memesan layanan katering kami? Hubungi kami melalui salah satu saluran berikut:</p>
              <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h4>Alamat</h4>
                    <p>Jl. Katering 123, Kota Makanan, Indonesia 12345</p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <h4>Telepon</h4>
                    <p>+62 123-456-7890</p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h4>Email</h4>
                    <p>info@foodycatering.com</p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-clock"></i>
                </div>                <div>
                    <h4>Jam Kerja</h4>
                    <p>Senin - Jumat: 9:00 - 18:00</p>
                    <p>Sabtu: 10:00 - 16:00</p>
                    <p>Minggu: Tutup</p>
                </div>
            </div>
              <div class="social-media">
                <h4>Ikuti Kami</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
          <div class="contact-form">
            <h2>Kirim Pesan kepada Kami</h2>
            <form action="/TubesYos/public/?page=home&action=contactSubmit" method="POST">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Telepon</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subjek</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Pesan</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
