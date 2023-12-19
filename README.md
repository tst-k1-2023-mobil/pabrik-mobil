# Sistem Pabrik Mobil

## Deskripsi sistem

Sistem Pabrik Mobil adalah platform yang didesain untuk mengelola proses produksi, stok mobil, dan pengelolaan pesanan dari dealer. Pabrik bertanggung jawab atas produksi mobil berdasarkan permintaan pasar dan memastikan ketersediaan stok yang cukup. Sistem ini memantau status produksi setiap model mobil, menyediakan informasi terkini tentang spesifikasi teknis, harga jual, dan stok yang tersedia. Melalui integrasi dengan dealer, pabrik dapat menerima pemesanan, memulai proses produksi, dan memberikan pembaruan stok secara real-time.

Sistem dibuat menggunakan bahasa pemrograman PHP dan *framework* CodeIgniter 4. Sistem menyimpan data pada basis data MySQL sampel data dapat dilihat di [sini](src/init.sql).

## Instalasi

- Lakukan `git clone` terhadap projek ini atau ekstrak arsip zip dari projek ini
- Ubah `env` menjadi `.env` dan sesuaikan konfigurasi aplikasi
- Jalankan perintah `composer install` untuk melakukan instalasi langsung (lewati langkah ini jika akan menggunakan Docker)

## Jalankan secara langsung

Jalankan server development dengan perintah `php spark serve`. Aplikasi akan berjalan pada port 8080.

## Jalankan menggunakan Docker

Mulai aplikasi dengan perintah `docker compose up`. Aplikasi akan berjalan pada port 8080.

## Syarat instalasi langsung

- PHP versi 7.4 sampai 8.2 dengan Composer dan *extension* intl, mbstring, mysqli, json, dan libcurl terpasang
- Server MySQL versi 8.0 atau lebih

## Syarat instalasi via Docker

- Docker Desktop di Windows/MacOS
- Docker di Linux

## Tugas Besar II3160 2023

Kelompok 2

- Willy Frans Farel Sijabat 18221087
- Abraham Megantoro Samudra 18221123
- Aufar Ramadhan 18221163
