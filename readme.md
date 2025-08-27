# 🏛 SIAPA PEKA
### *Sistem Informasi Digital Pencegahan Perkawinan Anak*

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)
![Leaflet](https://img.shields.io/badge/Leaflet-199900?style=for-the-badge&logo=leaflet&logoColor=white)

*Pencegahan Perkawinan Anak • Monitoring Data • Komunikasi Informasi Edukasi*

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1+-777BB4.svg)](https://php.net)
[![Status](https://img.shields.io/badge/Status-Active%20Development-green.svg)](https://github.com/pemprovinsi-jatim/siapa-peka)

</div>

---

## 📖 Tentang Siapa Peka

*SIAPA PEKA* adalah sistem informasi digital terpadu yang dikembangkan khusus untuk *pencegahan perkawinan anak* di Provinsi Jawa Timur. Aplikasi ini berfungsi sebagai platform monitoring, analisis data, dan media Komunikasi Informasi Edukasi (KIE) yang komprehensif untuk mendukung program pencegahan perkawinan anak secara berkelanjutan.

### 🎯 *Maksud & Tujuan*
Menyediakan sistem aplikasi berbasis digital yang mampu:
- *📊 Memantau* data perkawinan anak secara real-time
- *📈 Menyajikan* visualisasi data yang mudah dipahami
- *🎓 Mengedukasi* masyarakat tentang dampak perkawinan anak
- *🤝 Memfasilitasi* komunikasi antar stakeholder

### 🌟 *Manfaat Strategis*
- ✅ *Data-Driven Decision Making*: Mendukung kebijakan berbasis data akurat
- ✅ *Early Warning System*: Deteksi dini daerah dengan risiko tinggi
- ✅ *Transparansi Publik*: Akses informasi terbuka untuk masyarakat
- ✅ *Koordinasi Terintegrasi*: Platform kolaborasi antar OPD dan stakeholder

---

## ✨ Fitur Utama

<table>
<tr>
<td width="50%">

### 🗺 *Peta Interaktif Jawa Timur*
- Visualisasi data per kabupaten/kota
- Color-coded berdasarkan tingkat kasus
- Hover information detail
- Filter berdasarkan tahun dan kategori
- Zoom dan pan interaktif

### 📊 *Dashboard Analytics*
- *Statistik Pencegahan Perkawinan Anak*
- Tren Dispensasi Kawin multi-tahun
- Progress monitoring berkelanjutan
- Key Performance Indicators (KPI)

</td>
<td width="50%">

### 📈 *Sistem Pelaporan Terpadu*
- *Laporan Ringkasan* (Data Masuk, Diterima, Rerata)
- Klasifikasi berdasarkan pendidikan terakhir
- Export data dalam berbagai format
- Notifikasi otomatis untuk update data

### 👥 *Survey & Forum Anak*
- Polling interaktif untuk anak-anak
- Forum diskusi pencegahan perkawinan anak
- Feedback system dari masyarakat
- Analytics hasil survey real-time

</td>
</tr>
</table>

### 🔧 *Fitur Teknis Advanced*
- 📱 *Responsive Design* - Optimal di semua device
- 🎨 *Material Design UI* - Interface modern dan user-friendly  
- 📊 *Interactive Charts* - Chart.js untuk visualisasi dinamis
- 🗺 *Leaflet Maps* - Peta interaktif dengan OpenStreetMap
- 🔐 *Multi-Role Access* - Admin, Operator Daerah, Public User
- 📧 *Email Notifications* - Alert system otomatis
- 📱 *Mobile First Approach* - Prioritas pengalaman mobile

---

## 🛠 Tech Stack

<div align="center">

| *Backend Framework* | *Frontend* | *Database & Storage* | *Visualization* |
|----------------------|--------------|------------------------|------------------|
| ![Laravel](https://img.shields.io/badge/Laravel_10.x-FF2D20?style=flat-square&logo=laravel&logoColor=white) | ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white) | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) | ![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=flat-square&logo=chartdotjs&logoColor=white) |
| ![PHP](https://img.shields.io/badge/PHP_8.1+-777BB4?style=flat-square&logo=php&logoColor=white) | ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white) | ![Redis](https://img.shields.io/badge/Redis-DC382D?style=flat-square&logo=redis&logoColor=white) | ![Leaflet](https://img.shields.io/badge/Leaflet-199900?style=flat-square&logo=leaflet&logoColor=white) |
| ![Apache](https://img.shields.io/badge/Apache-D22128?style=flat-square&logo=apache&logoColor=white) | ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black) | ![File Storage](https://img.shields.io/badge/File_Storage-4285F4?style=flat-square&logo=googledrive&logoColor=white) | ![Material Design](https://img.shields.io/badge/Material_Design-757575?style=flat-square&logo=material-design&logoColor=white) |

</div>

### *Dependencies Utama*
json
{
  "laravel/framework": "^10.0",
  "laravel/sanctum": "^3.2",
  "laravel/tinker": "^2.8",
  "maatwebsite/excel": "^3.1",
  "barryvdh/laravel-dompdf": "^2.0"
}


---

## 🚀 Instalasi & Setup

### *Prasyarat Sistem*
- PHP >= 8.1 dengan ekstensi: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON
- Composer >= 2.0
- Node.js >= 16.x & NPM >= 8.x
- MySQL >= 8.0 atau MariaDB >= 10.4
- Web Server (Apache 2.4+ / Nginx 1.18+)

### *Langkah Instalasi Lengkap*

bash
# 1. Clone repository
git clone https://github.com/pemprovinsi-jatim/siapa-peka.git
cd siapa-peka

# 2. Install PHP dependencies
composer install --optimize-autoloader --no-dev

# 3. Install Node.js dependencies
npm install

# 4. Setup environment configuration
cp .env.example .env
php artisan key:generate

# 5. Konfigurasi database di file .env
nano .env


### *Konfigurasi Database (.env)*
bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siapa_peka_db
DB_USERNAME=your_db_username
DB_PASSWORD=your_secure_password

# Mail Configuration (untuk notifikasi)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_app_password


### *Database Setup & Seeding*
bash
# 6. Migrasi database dan seed data
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder

# 7. Setup storage dan cache
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Build production assets
npm run production

# 9. Set permissions (Linux/Mac)
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 755 storage bootstrap/cache

# 10. Start application
php artisan serve --host=0.0.0.0 --port=8000


### *Konfigurasi Production (Optional)*
bash
# Setup queue worker untuk background jobs
php artisan queue:work --daemon

# Setup cron job untuk scheduler
echo "* * * * * php /path/to/siapa-peka/artisan schedule:run >> /dev/null 2>&1" | crontab -


---

## 📱 Screenshots & Preview

<div align="center">

### *🗺 Dashboard Peta Interaktif*
Visualisasi data pencegahan perkawinan anak per wilayah dengan color-coded indicators

![Dashboard Peta](https://raw.githubusercontent.com/pemprovinsi-jatim/siapa-peka/main/docs/images/dashboard-map.png)

### *📊 Analytics & Statistics*
Dashboard statistik dengan trend analysis dan comparative data

![Analytics Dashboard](https://raw.githubusercontent.com/pemprovinsi-jatim/siapa-peka/main/docs/images/analytics-stats.png)

### *📋 Laporan Ringkasan*
Modal laporan dengan breakdown data berdasarkan pendidikan dan wilayah

![Laporan Ringkasan](https://raw.githubusercontent.com/pemprovinsi-jatim/siapa-peka/main/docs/images/laporan-ringkasan.png)

### *📈 Analisis Rerata*
Perbandingan kabupaten dengan kasus tertinggi dan terendah

![Analisis Rerata](https://raw.githubusercontent.com/pemprovinsi-jatim/siapa-peka/main/docs/images/analisis-rerata.png)

### *👥 Survey Forum Anak*
Interface survey interaktif dengan hasil polling real-time

![Survey Forum](https://raw.githubusercontent.com/pemprovinsi-jatim/siapa-peka/main/docs/images/survey-forum.png)

### *📊 Grafik Pengantin Berdasarkan Gender*
Visualisasi data statistik perkawinan anak berdasarkan jenis kelamin per kabupaten

![Gender Statistics](https://raw.githubusercontent.com/pemprovinsi-jatim/siapa-peka/main/docs/images/gender-stats.png)

</div>

> 📸 Screenshots menampilkan interface aktual dari aplikasi SIAPA PEKA

---

## 👥 User Roles & Permissions

| *Role* | *Dashboard* | *Data Entry* | *Reports* | *Settings* | *User Management* |
|----------|---------------|---------------|-------------|--------------|-------------------|
| *Super Admin* | ✅ Full Access | ✅ All Data | ✅ All Reports | ✅ System Config | ✅ All Users |
| *Admin Provinsi* | ✅ Province View | ✅ Provincial Data | ✅ Provincial Reports | ❌ | ✅ Operators |
| *Operator Daerah* | ✅ Regional View | ✅ Regional Data | ✅ Regional Reports | ❌ | ❌ |
| *Public User* | ✅ Public View | ❌ | ✅ Public Reports | ❌ | ❌ |

---

## 🔄 Data Flow & Integration

mermaid
graph TD
    A[Data Input] --> B[Validation Layer]
    B --> C[Database MySQL]
    C --> D[Analytics Engine]
    D --> E[Visualization Layer]
    E --> F[Dashboard Display]
    
    G[External APIs] --> H[Data Sync Service]
    H --> C
    
    I[User Interaction] --> J[Survey System]
    J --> C
    
    C --> K[Export Service]
    K --> L[PDF/Excel Reports]


---

## 🤝 Kontribusi & Development

### *Cara Berkontribusi*

1. *Fork* repository ini ke akun GitHub Anda
2. *Clone* fork ke local development
   bash
   git clone https://github.com/YOUR_USERNAME/siapa-peka.git
   
3. Buat *feature branch* untuk pengembangan
   bash
   git checkout -b feature/nama-fitur-baru
   
4. *Commit* perubahan dengan pesan yang descriptive
   bash
   git commit -m "feat: menambahkan fitur analisis prediktif"
   
5. *Push* ke branch dan buat *Pull Request*

### *Development Guidelines*
- ✅ Ikuti *PSR-12* coding standard untuk PHP
- ✅ Gunakan *meaningful commit messages* (conventional commits)
- ✅ Tulis *unit test* untuk fitur baru menggunakan PHPUnit
- ✅ *Update dokumentasi* untuk perubahan API
- ✅ *Test responsive design* di berbagai device
- ✅ *Validasi accessibility* untuk user dengan disabilitas

### *Jenis Kontribusi yang Dibutuhkan*
- 🐛 *Bug Fixes* - Perbaikan error dan issue
- ✨ *New Features* - Fitur pencegahan perkawinan anak
- 📊 *Data Visualization* - Chart dan grafik baru
- 🎨 *UI/UX Improvements* - Enhancement interface
- 🔧 *Performance Optimization* - Optimasi database dan loading
- 📱 *Mobile Enhancement* - Perbaikan pengalaman mobile
- 🌍 *Localization* - Dukungan bahasa daerah
- 📚 *Documentation* - Panduan penggunaan dan API docs

---

## 🧪 Testing

bash
# Run semua unit tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run dengan coverage report
php artisan test --coverage

# Database testing
php artisan test --env=testing


---

## 📋 Roadmap Pengembangan

### *🚀 Phase 1 - Foundation (Q1 2024)* ✅
- [x] Dashboard peta interaktif
- [x] Sistem analytics dasar  
- [x] Survey forum anak
- [x] Export laporan PDF/Excel

### *📱 Phase 2 - Enhancement (Q2 2024)* 🔄
- [ ] Mobile Progressive Web App (PWA)
- [ ] Push notifications
- [ ] Advanced filtering & search
- [ ] API documentation dengan Swagger

### *🤖 Phase 3 - Intelligence (Q3 2024)* 📋
- [ ] Machine Learning untuk prediksi risiko
- [ ] Chatbot untuk edukasi masyarakat  
- [ ] Sistem rekomendasi intervensi
- [ ] Integration dengan Sistem Informasi Desa

### *🌐 Phase 4 - Integration (Q4 2024)* 📋
- [ ] API Gateway untuk integrasi eksternal
- [ ] Real-time data sync dengan SIPKD
- [ ] Blockchain untuk data integrity
- [ ] Mobile app Android/iOS native

---

## 📞 Support & Maintenance

### *🛠 Technical Support*
- 📧 *Email*: dev-siapapeka@jatimprov.go.id
- 🐛 *Issues*: [GitHub Issues](https://github.com/pemprovinsi-jatim/siapa-peka/issues)
- 📖 *Documentation*: [Wiki Pages](https://github.com/pemprovinsi-jatim/siapa-peka/wiki)

### *📋 Maintenance Schedule*
- *Daily*: Automated backups & health monitoring
- *Weekly*: Security updates & performance review  
- *Monthly*: Database optimization & cleanup
- *Quarterly*: Major feature updates & security audit

---

## 📄 Lisensi & Disclaimer

Proyek ini dilisensikan di bawah *MIT License* - lihat file [LICENSE](LICENSE) untuk detail lengkap.

### *⚖ Catatan Penting*
> 🏛 *SIAPA PEKA* dikembangkan sebagai sistem informasi resmi untuk mendukung program *Pencegahan Perkawinan Anak* di Provinsi Jawa Timur. Aplikasi ini dibuat dengan tujuan mulia melindungi anak-anak Indonesia dari dampak negatif perkawinan dini dan mendukung Sustainable Development Goals (SDGs) khususnya Goal 3, 4, dan 5.

### *🔒 Data Privacy*
- Semua data personal dienkripsi sesuai standar keamanan
- Akses data dibatasi sesuai dengan role dan kewenangan
- Sistem audit trail untuk tracking akses data
- Kepatuhan terhadap regulasi perlindungan data

---

## 🏆 Penghargaan & Recognition

<div align="center">

![Award](https://img.shields.io/badge/🏆_Best_Government_App-2024-gold)
![SDGs](https://img.shields.io/badge/🌍_SDGs_Supporter-Goal_3,4,5-blue)
![Innovation](https://img.shields.io/badge/💡_Digital_Innovation-Jawa_Timur-green)

</div>

---

## 📊 Statistik Project

<div align="center">

![GitHub Stars](https://img.shields.io/github/stars/pemprovinsi-jatim/siapa-peka?style=social)
![GitHub Forks](https://img.shields.io/github/forks/pemprovinsi-jatim/siapa-peka?style=social)
![GitHub Issues](https://img.shields.io/github/issues/pemprovinsi-jatim/siapa-peka)
![GitHub Contributors](https://img.shields.io/github/contributors/pemprovinsi-jatim/siapa-peka)
![GitHub Last Commit](https://img.shields.io/github/last-commit/pemprovinsi-jatim/siapa-peka)

</div>

---

<div align="center">

### 💝 *"SIAPA PEKA - Melindungi Masa Depan Anak Indonesia"*

*Dikembangkan dengan ❤ untuk Pencegahan Perkawinan Anak*

[![Made in East Java](https://img.shields.io/badge/Made_with_❤_in-East_Java-red.svg)](https://jatimprov.go.id)
[![Government Project](https://img.shields.io/badge/🏛_Official-Government_Project-blue.svg)](https://siapa-peka.jatimprov.go.id)
[![Child Protection](https://img.shields.io/badge/👶_Child-Protection_Program-pink.svg)](https://www.unicef.org/indonesia/)

---

© 2024 SIAPA PEKA - Pemerintah Provinsi Jawa Timur. Untuk masa depan anak yang lebih baik.

*"Setiap anak berhak mendapatkan masa kecil yang bahagia dan pendidikan yang layak"*

</div>
