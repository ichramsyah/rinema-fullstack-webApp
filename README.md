# RINEMA - Platform untuk Pecinta Film Indonesia

[![Lisensi: MIT](https://img.shields.io/badge/Lisensi-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-12-red)](https://laravel.com/)
[![Dideploy](https://img.shields.io/badge/Dideploy-Ya-green)](https://rinemaa.paramadina.ac.id/)

**RINEMA** adalah platform digital yang didedikasikan untuk merayakan dan mengeksplorasi sinema Indonesia. Dirancang untuk membangun komunitas pecinta film yang bersemangat, RINEMA menyediakan ruang untuk memberikan rating, berkomentar, berdiskusi, dan masuk dengan mudah menggunakan akun Google. Baik Anda penggemar film layar lebar atau karya independen, RINEMA adalah tempat untuk menyelami kekayaan perfilman Tanah Air.

🌟 **Demo Langsung**: Kunjungi RINEMA di [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

## Daftar Isi

-   [Tentang RINEMA](#tentang-rinema)
-   [Fitur](#fitur)
-   [Teknologi](#teknologi)
-   [Instalasi](#instalasi)
-   [Penggunaan](#penggunaan)
-   [Tangkapan Layar](#tangkapan-layar)
-   [Kontribusi](#kontribusi)
-   [Lisensi](#lisensi)
-   [Kontak](#kontak)

## Tentang RINEMA

Industri perfilman Indonesia sedang mengalami masa keemasan, dengan karya berkualitas yang semakin sering tampil di bioskop dan festival film, baik nasional maupun internasional. Namun, belum ada platform terpusat yang memungkinkan penggemar untuk mengapresiasi dan mendiskusikan film Indonesia secara mendalam. RINEMA hadir untuk mengisi kekosongan ini, terinspirasi oleh platform global seperti IMDb, tetapi dirancang khusus untuk sinema Indonesia.

### Tujuan

-   Membangun platform interaktif untuk pecinta film Indonesia.
-   Mendorong komunitas aktif yang suportif dengan kebebasan berpendapat yang bertanggung jawab.
-   Menyediakan ruang aman untuk rating jujur, komentar terbuka, dan diskusi dinamis tentang film Indonesia.

## Fitur

-   **Rating Film**: Berikan penilaian pribadi untuk film Indonesia yang telah ditonton, ekspresikan suka atau tidak suka secara jujur.
-   **Komentar Bebas**: Tulis pemikiran dan perasaan Anda tentang film, dari kritik membangun hingga pujian tanpa batas.
-   **Forum Diskusi**: Ikut serta dalam percakapan seru, bahas detail film, teori, atau kekurangan bersama pengguna lain.
-   **Profil Pengguna**: Kelola aktivitas Anda, lihat riwayat rating, komentar, dan partisipasi di forum.
-   **Manajemen Akun**: Perbarui informasi profil atau hapus akun sesuai kebutuhan.
-   **Login dengan Google**: Masuk dengan cepat dan aman menggunakan akun Google Anda, memudahkan akses ke semua fitur RINEMA.

## Teknologi

RINEMA dibangun dengan teknologi modern dan andal:

-   **Front-end**:
    -   Laravel Blade (Templating Engine)
    -   Tailwind CSS (Styling)
    -   Vanilla JavaScript (Interaktivitas)
-   **Back-end**:
    -   Laravel 12 (Framework)
    -   PHP
-   **Database**:
    -   MySQL
-   **Integrasi**:
    -   Google OAuth untuk fitur Login dengan Google
-   **Deployment**:
    -   Dihosting melalui cPanel di [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

## Instalasi

Untuk menjalankan RINEMA secara lokal, ikuti langkah-langkah berikut:

### Prasyarat

-   PHP >= 8.1
-   Composer
-   MySQL
-   Node.js & npm
-   Git
-   Akun Google Developer untuk konfigurasi OAuth (opsional untuk fitur Login dengan Google)

### Langkah Instalasi

1. **Kloning Repositori**:

    ```bash
    git clone https://github.com/ichramsyah/rinema-fullstack-webapp.git
    cd rinema
    ```

2. **Instal Dependensi**:

    ```bash
    composer install
    npm install
    ```

3. **Konfigurasi Lingkungan**:

    - Salin file `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    - Perbarui `.env` dengan kredensial database dan Google OAuth (jika menggunakan fitur Login dengan Google):

        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=rinema
        DB_USERNAME=nama_pengguna_anda
        DB_PASSWORD=kata_sandi_anda

        GOOGLE_CLIENT_ID=your_google_client_id
        GOOGLE_CLIENT_SECRET=your_google_client_secret
        GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
        ```

4. **Buat Kunci Aplikasi**:

    ```bash
    php artisan key:generate
    ```

5. **Jalankan Migrasi Database**:

    ```bash
    php artisan migrate
    ```

6. **Bangun Aset Front-end**:

    ```bash
    npm run dev
    ```

7. **Jalankan Server Pengembangan**:
    ```bash
    php artisan serve
    ```
    Akses RINEMA di `http://localhost:8000`.

### Catatan untuk Login dengan Google

-   Buat kredensial OAuth di [Google Developer Console](https://console.developers.google.com/).
-   Tambahkan kredensial ke file `.env` seperti di atas.
-   Pastikan rute callback (`/auth/google/callback`) sesuai dengan pengaturan aplikasi Anda.

## Penggunaan

1. **Daftar/Masuk**: Buat akun baru, masuk dengan email, atau gunakan Login dengan Google untuk akses cepat.
2. **Jelajahi Film**: Telusuri film Indonesia dan lihat detail seperti pemeran, sutradara, dan sinopsis.
3. **Beri Rating & Komentar**: Bagikan penilaian dan opini Anda tentang film yang telah ditonton.
4. **Ikuti Diskusi**: Bergabung di forum untuk membahas alur, tema, atau teori bersama pengguna lain.
5. **Kelola Profil**: Lihat riwayat aktivitas Anda dan perbarui pengaturan akun.

## Tangkapan Layar

Berikut adalah pratinjau halaman utama RINEMA (ganti dengan gambar asli di repositori Anda):

-   **Halaman Beranda**: Menyambut pengguna untuk menjelajahi sinema Indonesia.  
    ![Halaman Beranda](screenshots/beranda.png)
-   **Detail Film**: Informasi lengkap film dengan rating dan komentar.  
    ![Detail Film](screenshots/detail-film.png)
-   **Forum Diskusi**: Diskusi seru antar pecinta film.  
    ![Forum](screenshots/forum.png)
-   **Halaman Login**: Opsi masuk dengan Google atau email.  
    ![Halaman Login](screenshots/login.png)

## Kontribusi

Kami menyambut kontribusi untuk membuat RINEMA semakin baik! Untuk berkontribusi:

1. Fork repositori ini.
2. Buat cabang baru (`git checkout -b fitur/nama-fitur`).
3. Lakukan perubahan dan commit (`git commit -m "Menambahkan fitur"`).
4. Push ke cabang (`git push origin fitur/nama-fitur`).
5. Buka Pull Request dengan deskripsi jelas tentang perubahan Anda.

Harap patuhi [Kode Etik](CODE_OF_CONDUCT.md) kami dan pastikan kontribusi Anda sejalan dengan misi RINEMA untuk diskusi yang konstruktif dan hormat.

### Saran Kontribusi

-   Tingkatkan fitur pencarian dan filter (misalnya, berdasarkan genre atau sutradara).
-   Tambahkan upvote/downvote untuk komentar atau balasan bertingkat di forum.
-   Integrasikan rekomendasi film berdasarkan aktivitas pengguna.
-   Kembangkan alat moderasi untuk menjaga diskusi yang sehat.

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detailnya.

## Kontak

Untuk pertanyaan, umpan balik, atau peluang kolaborasi, hubungi tim RINEMA:

-   **Email**: ichramsyahabdurrachman@gmail.com

Bergabunglah dengan kami untuk merayakan sinema Indonesia bersama RINEMA! 🎥
