<p align="center">
  <img src="https://ybmbrilian-id.b-cdn.net/wp-content/uploads/2021/12/cropped-LOGO-YBM-BRILIAN-FIX-LAST-01.png" alt="YBM BRILiaN Logo" width="180"/>
</p>

# 🕌 Sistem Informasi Pengelolaan Data Mustahik - YBM BRILiaN

Sistem ini merupakan **website pengelolaan data mustahik** yang dikembangkan untuk **Yayasan Baitul Maal BRILiaN (YBM BRILiaN)**.  
Tujuan utama sistem ini adalah membantu pengelolaan data penerima manfaat (mustahik) dan program sosial secara **efisien, transparan, dan terpusat**.

---

## 🌐 Fitur Utama

### 1. Landing Page Yayasan
Berisi profil singkat YBM BRILiaN, visi dan misi, serta informasi kontak untuk memperkenalkan yayasan kepada publik.

### 2. Dashboard Utama
Menampilkan ringkasan data penerima manfaat, jumlah program aktif, grafik kegiatan, dan statistik per pilar.  
Dashboard ini membantu admin memantau seluruh aktivitas secara menyeluruh dan **real-time**.

### 3. Manajemen Program Sosial dan Pilar Kegiatan
Sistem dibagi berdasarkan **lima pilar utama YBM BRILiaN**, di mana setiap pilar memiliki penanggung jawab masing-masing:

| Pilar | Deskripsi | Penanggung Jawab |
|-------|------------|------------------|
| **Sosial Kemanusiaan – Family Strengthening** | Program bantuan sosial dan pemberdayaan keluarga | Koordinator Pilar Sosial Kemanusiaan |
| **Dakwah – Marbot Masjid** | Dukungan untuk kesejahteraan marbot masjid | Koordinator Pilar Dakwah |
| **Ekonomi – UMKM Binaan** | Pembinaan dan pemberdayaan UMKM | Koordinator Pilar Ekonomi |
| **Pendidikan – Bright Scholarship** | Beasiswa untuk siswa dan mahasiswa berprestasi | Koordinator Pilar Pendidikan |
| **Kesehatan – Stunting** | Program pencegahan stunting dan kesehatan masyarakat | Koordinator Pilar Kesehatan |

### 4. Manajemen User (Admin)
Admin memiliki hak akses penuh untuk:
- Menambah, mengubah, dan menghapus data mustahik.
- Mengelola program dan pilar kegiatan.
- Mengatur hak akses pengguna lainnya.

---

## ⚙️ Teknologi yang Digunakan

- **Framework:** Laravel 11  
- **Frontend:** Blade Template & TailwindCSS  
- **Database:** MySQL / Supabase  
- **Charting:** Chart.js  
- **Deployment:** Render / Railway  
- **Version Control:** Git & GitHub  

---

## 🚀 Instalasi & Menjalankan Proyek

Berikut langkah-langkah untuk menyalin dan menjalankan proyek ini di lokal Anda.

### 1. Clone Repository
```bash
git clone https://github.com/BrwnsAmanda/sisforybm.git
```

### 2. Masuk ke Direktori Proyek
```bash
cd sisforybm
```

### 3. Install Dependencies
```bash
composer install
npm install
```

### 4. Salin File Environment
Buat file .env baru dengan menyalin template yang sudah disediakan:
```bash
cp .env.example .env
```

📦 Selanjutnya, dapat menyesuaikan konfigurasi database dan kunci aplikasi pada file .env sebelum menjalankan perintah berikutnya

## 📂 Struktur Direktori Utama
```bash
sisforybm/
├── app/                  # File utama aplikasi (Models, Controllers, dll)
├── bootstrap/            # Bootstrap framework
├── config/               # Konfigurasi sistem
├── database/             # Migrations dan seeders
├── public/               # Aset publik (CSS, JS, gambar)
├── resources/            # Views Blade dan file frontend
├── routes/               # Definisi route web & API
├── storage/              # File upload dan log
├── tests/                # Pengujian aplikasi
├── .env.example          # Contoh file environment
├── artisan               # CLI utama Laravel
├── composer.json         # Daftar dependensi PHP
└── package.json          # Daftar dependensi frontend
```

## ✨ Kontributor

Developer: Amanda Putri & Meisa Maharti
Instansi: Yayasan Baitul Maal BRILiaN RO Makassar (YBM BRILiaN)
Peran: Web Developer (Magang)
Tahun: 2025
