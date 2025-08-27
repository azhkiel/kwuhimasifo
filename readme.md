# 🏛 SIAPA PEKA
### *Sistem Informasi Aplikasi Partisipasi Publik dan Edukasi Kebijakan Anggaran*

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

*Transparansi APBD • Partisipasi Publik • Edukasi Anggaran*

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1+-777BB4.svg)](https://php.net)

</div>

---

## 📖 Tentang Siapa Peka

*Siapa Peka* adalah platform digital inovatif yang dikembangkan untuk meningkatkan transparansi dan akuntabilitas pengelolaan Anggaran Pendapatan dan Belanja Daerah (APBD) Provinsi Jawa Timur. Melalui sistem informasi yang user-friendly, aplikasi ini memfasilitasi partisipasi aktif masyarakat dalam pengawasan anggaran daerah sekaligus memberikan edukasi komprehensif tentang kebijakan anggaran.

### 🎯 *Visi & Misi*
- *Visi*: Mewujudkan tata kelola anggaran daerah yang transparan, akuntabel, dan partisipatif
- *Misi*: Memberikan akses informasi APBD yang mudah dipahami dan mendorong keterlibatan aktif masyarakat dalam proses pengawasan anggaran

### 🌟 *Nilai Manfaat*
- ✅ *Transparansi*: Akses terbuka terhadap informasi APBD Jawa Timur
- ✅ *Partisipasi*: Platform interaksi antara pemerintah dan masyarakat
- ✅ *Edukasi*: Peningkatan literasi anggaran publik
- ✅ *Akuntabilitas*: Pengawasan partisipatif terhadap penggunaan anggaran

---

## ✨ Fitur Utama

<table>
<tr>
<td width="50%">

### 📊 *Dashboard Interaktif*
- Visualisasi data APBD real-time
- Grafik dan chart dinamis
- Filter berdasarkan tahun/OPD
- Perbandingan anggaran multi-periode

### 📝 *Laporan Publik*
- Upload laporan penggunaan anggaran
- Sistem tracking realisasi
- Notifikasi update terbaru
- Export data dalam berbagai format

</td>
<td width="50%">

### 👥 *Partisipasi Masyarakat*
- Forum diskusi kebijakan anggaran
- Sistem voting/polling publik
- Pengaduan dan saran masyarakat
- Live chat dengan tim pemerintah

### 📚 *Edukasi & Literasi*
- Modul pembelajaran APBD
- Infografis kebijakan anggaran
- Video tutorial dan webinar
- Quiz interaktif untuk masyarakat

</td>
</tr>
</table>

### 🔧 *Fitur Tambahan*
- 🔐 *Multi-level Authentication* (Admin, Operator, Public)
- 📱 *Responsive Design* untuk semua device
- 🔍 *Advanced Search & Filter*
- 📈 *Analytics & Reporting Tools*
- 🌐 *Multi-language Support* (Indonesia, Jawa)
- 📧 *Email Notification System*

---

## 🛠 Tech Stack

<div align="center">

| *Backend* | *Frontend* | *Database* | *Tools* |
|-------------|--------------|--------------|-----------|
| ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white) | ![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=flat-square&logo=bootstrap&logoColor=white) | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) | ![Composer](https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white) |
| ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white) | ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black) | ![Redis](https://img.shields.io/badge/Redis-DC382D?style=flat-square&logo=redis&logoColor=white) | ![NPM](https://img.shields.io/badge/NPM-CB3837?style=flat-square&logo=npm&logoColor=white) |
| ![Apache](https://img.shields.io/badge/Apache-D22128?style=flat-square&logo=apache&logoColor=white) | ![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=flat-square&logo=chartdotjs&logoColor=white) | | ![Git](https://img.shields.io/badge/Git-F05032?style=flat-square&logo=git&logoColor=white) |

</div>

---

## 🚀 Instalasi & Setup

### *Prasyarat Sistem*
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Web Server (Apache/Nginx)

### *Langkah Instalasi*

bash
# 1. Clone repository
git clone https://github.com/pemprovinsi-jatim/siapa-peka.git
cd siapa-peka

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siapa_peka
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 5. Migrasi database & seeder
php artisan migrate
php artisan db:seed

# 6. Build assets
npm run build

# 7. Jalankan aplikasi
php artisan serve


### *Konfigurasi Tambahan*

bash
# Setup storage link
php artisan storage:link

# Setup queue worker (untuk notifikasi)
php artisan queue:work

# Setup scheduler (untuk laporan otomatis)
php artisan schedule:work


---

## 📱 Screenshots & Preview

<div align="center">

### *🏠 Dashboard Utama*
Screenshot dashboard akan ditampilkan di sini
![Dashboard Preview](placeholder-dashboard.png)

### *📊 Visualisasi Data APBD*
Screenshot grafik dan chart APBD
![APBD Visualization](placeholder-chart.png)

### *👥 Forum Partisipasi*
Screenshot halaman forum diskusi publik
![Forum Preview](placeholder-forum.png)

### *📱 Mobile Responsive*
Screenshot tampilan mobile
![Mobile Preview](placeholder-mobile.png)

</div>

> 📸 Screenshots akan diupdate setelah deployment final aplikasi

---

## 🤝 Kontribusi

Kami sangat menghargai kontribusi dari developer untuk meningkatkan kualitas *Siapa Peka*. Berikut panduan kontribusi:

### *Cara Berkontribusi*

1. *Fork* repository ini
2. Buat *feature branch* (git checkout -b feature/AmazingFeature)
3. *Commit* perubahan (git commit -m 'Add: Amazing Feature')
4. *Push* ke branch (git push origin feature/AmazingFeature)
5. Buka *Pull Request*

### *Aturan Kontribusi*
- ✅ Ikuti PSR-12 coding standard
- ✅ Tulis unit test untuk fitur baru
- ✅ Update dokumentasi jika diperlukan
- ✅ Gunakan commit message yang descriptive

### *Jenis Kontribusi yang Dibutuhkan*
- 🐛 Bug fixes
- ✨ New features
- 📚 Documentation improvements
- 🎨 UI/UX enhancements
- 🔧 Performance optimizations

---

## 📋 Roadmap

- [ ] *v2.0* - Mobile App (Android/iOS)
- [ ] *v2.1* - API Public untuk Developer
- [ ] *v2.2* - Integrasi dengan Sistem SIPKD
- [ ] *v2.3* - AI-powered Budget Analysis
- [ ] *v2.4* - Blockchain untuk Transparansi

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah *MIT License* - lihat file [LICENSE](LICENSE) untuk detail lengkap.

### *Catatan Khusus*
> 🏛 *Siapa Peka* dikembangkan sebagai proyek riset dan simulasi untuk mendukung transparansi anggaran publik. Aplikasi ini bukan merupakan sistem resmi Pemerintah Provinsi Jawa Timur, namun dibuat dengan tujuan mulia untuk mendorong tata kelola anggaran yang lebih baik.

---

## 📞 Kontak & Dukungan

<div align="center">

*Tim Pengembang Siapa Peka*

📧 *Email*: dev@siapa-peka.jatimprov.go.id  
🌐 *Website*: https://siapa-peka.jatimprov.go.id  
📱 *WhatsApp*: +62-xxx-xxxx-xxxx  
🐛 *Issues*: [GitHub Issues](https://github.com/pemprovinsi-jatim/siapa-peka/issues)

</div>

---

<div align="center">

### 🏛 *"Siapa Peka – Transparansi Anggaran untuk Masyarakat Jawa Timur"*

*Developed with ❤ for Public Transparency*

[![Made in East Java](https://img.shields.io/badge/Made%20in-East%20Java-red.svg)](https://jatimprov.go.id)
[![Government Project](https://img.shields.io/badge/Project-Government-blue.svg)](https://siapa-peka.jatimprov.go.id)

---

© 2024 Siapa Peka. Built for the people, by the people.

</div>
