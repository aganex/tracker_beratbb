<p align="center">
  <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExcjI2eXoyZ3ptaXJmNWY5YjFmNW5ud2QyaTIyYmtpeWtuNDR1ZWNiOSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3oKIPnAiaMCws8nOsE/giphy.gif" width="450">
</p>

# ⚖️ Tracker BB

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-red?style=for-the-badge&logo=laravel">
  <img src="https://img.shields.io/badge/PHP-8-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/MySQL-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge&logo=bootstrap">
</p>

<p align="center">
  Sistem pencatatan dan pemantauan berat badan berbasis web yang membantu pengguna memonitor perkembangan berat badan, BMI, target berat badan, serta kebutuhan kalori harian.
</p>

---

## ✨ Fitur Utama

### 👤 User

* Registrasi dan Login
* Input berat badan harian
* Riwayat berat badan
* Grafik perkembangan berat badan
* Perhitungan BMI otomatis
* Status BMI
* Perhitungan BMR
* Perhitungan kebutuhan kalori harian
* Target berat badan
* Manajemen profil

### 🛠️ Admin

* Dashboard Admin
* Statistik pengguna
* Total pengguna
* Total pengguna pria
* Total pengguna wanita
* Pencarian akun
* Edit akun pengguna
* Hapus akun pengguna

---

## 📸 Tampilan Aplikasi

### Dashboard User

> Tambahkan screenshot dashboard user di sini

```txt
assets/dashboard-user.png
```

### Dashboard Admin

> Tambahkan screenshot dashboard admin di sini

```txt
assets/dashboard-admin.png
```

---

## 📊 Fitur Perhitungan

Tracker BB secara otomatis menghitung:

### BMI (Body Mass Index)

```text
BMI = Berat Badan / (Tinggi Badan x Tinggi Badan)
```

Kategori:

* Kurus
* Normal
* Overweight
* Obesitas

### BMR (Basal Metabolic Rate)

Menggunakan rumus Mifflin-St Jeor:

* Pria
* Wanita

### Kalori Harian

Menyesuaikan tingkat aktivitas pengguna:

* Tidak Aktif
* Ringan
* Sedang
* Aktif
* Sangat Aktif

---

## 🧱 Struktur Database

### users

* id
* name
* email
* password
* role
* tinggi_badan
* jenis_kelamin
* tanggal_lahir
* target_berat
* aktivitas

### berat_badan

* id
* user_id
* berat
* tanggal

---

## 🚀 Instalasi

Clone repository:

```bash
git clone https://github.com/USERNAME/tracker-bb.git
```

Masuk ke folder project:

```bash
cd tracker-bb
```

Install dependency:

```bash
composer install
```

Copy file environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Migrasi database:

```bash
php artisan migrate
```

Jalankan server:

```bash
php artisan serve
```

---

## 🛠️ Tech Stack

* Laravel
* PHP
* MySQL
* Bootstrap 5
* Chart.js

---

## 👨‍💻 Author

**Marsyha Adinata**

Universitas Bina Sarana Informatika (UBSI)

Project dibuat sebagai aplikasi monitoring berat badan dan pengelolaan data pengguna berbasis Laravel.
