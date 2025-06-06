# RINEMA - Platform untuk Pecinta Film Indonesia 

[![Lisensi: MIT](https://img.shields.io/badge/Lisensi-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-12-red)](https://laravel.com/)
[![Dideploy](https://img.shields.io/badge/Dideploy-Ya-green)](https://rinemaa.paramadina.ac.id/)

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![cPanel](https://img.shields.io/badge/cPanel-FF6C2C?style=for-the-badge&logo=cpanel&logoColor=white)](https://cpanel.net/)

### Kelompok: Apa Bae

#### [README.md](README-en.markdown) English Ver.

**RINEMA** adalah platform digital yang didedikasikan untuk merayakan dan mengeksplorasi sinema Indonesia. Dirancang untuk membangun komunitas pecinta film yang bersemangat, RINEMA menyediakan ruang untuk memberikan rating, berkomentar, berdiskusi, dan masuk dengan mudah menggunakan akun Google. Baik Anda penggemar film layar lebar atau karya independen, RINEMA adalah tempat untuk menyelami kekayaan perfilman Tanah Air.

🌟 **Demo Langsung**: Kunjungi RINEMA di [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

🎬 **Demo Video**: Tonton Demo Rinema di [https://drive.google.com/demo-rinema](https://drive.google.com/file/d/1GFU2u-NRTmvaZKGEcnh3LjmsA2knm4Hj/view?usp=drive_link)

✨ **Link Design Figma**: Lihat desain Rinema di [https://www.figma.com/rinema-design](https://www.figma.com/design/yb2RG0CQay2An0RKcYorFD/Rinema?node-id=0-1&t=BAkABHVPZgUs5MtC-1)

## Daftar Isi

-   [Tentang RINEMA](#tentang-rinema)
-   [Fitur](#fitur)
-   [Teknologi](#teknologi)
-   [Struktur Proyek](#struktur-proyek--mvc-)
-   [Struktur Database](#struktur-database)
-   [Kelompok](#kelompok)
-   [UML (Unifiede Modeling Language)](#UML)
-   [Performa Website](#performa-website)
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

-   **Pencarian Film**: Temukan film Indonesia dengan cepat menggunakan kata kunci, seperti judul, sutradara, atau aktor.
-   **Filter Film**: Saring film berdasarkan terpopuler, terbaru, terlawas, atau genre untuk menemukan konten yang sesuai minat Anda.
-   **Mobile-Friendly**: Nikmati pengalaman yang mulus di perangkat mobile dengan desain responsif.
-   **Rating Film**: Berikan penilaian pribadi untuk film yang telah ditonton, ekspresikan suka atau tidak suka secara jujur.
-   **Komentar Bebas**: Tulis pemikiran dan perasaan Anda, dari kritik membangun hingga pujian tanpa batas.
-   **Forum Diskusi**: Ikut serta dalam percakapan seru, bahas detail film, teori, atau kekurangan bersama pengguna lain.
-   **Profil Pengguna**:  Kelola aktivitas Anda, lihat riwayat rating, komentar, dan partisipasi di forum.
-   **Manajemen Akun**: Perbarui informasi profil atau hapus akun sesuai kebutuhan.
-   **Login dengan Google**: Masuk dengan cepat dan aman menggunakan akun Google, memudahkan akses ke semua fitur.

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

## Struktur Proyek ( MVC )

```
RINEMA/
├── app/    
│   ├── Http/
│   │     └── Controllers/  # Controller
│   └── Models/             # Model          
│
├── resource/
│    └── views/             # Views
│          ├── admin/           # halaman dashboard admin
│          ├── auth/            # halaman autentikasi (login & register)
│          ├── error/           # halaman 404
│          ├── komponen/        # komponen
│          ├── page/            # halaman untuk pengguna
│          └── index.blade.php  # main index
│
└── routes/                  # Handling Route            
```

## Struktur Database

```sql
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role VARCHAR(50) DEFAULT 'user',
    is_active BOOLEAN DEFAULT TRUE,
    avatar VARCHAR(255) NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE films (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    release_date DATE NOT NULL,
    director VARCHAR(255) NOT NULL,
    poster VARCHAR(255) NOT NULL,
    duration INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE genres (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE film_genre (
    film_id INT REFERENCES films(id) ON DELETE CASCADE,
    genre_id INT REFERENCES genres(id) ON DELETE CASCADE,
    PRIMARY KEY (film_id, genre_id)
);

CREATE TABLE ratings (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    film_id INT REFERENCES films(id) ON DELETE CASCADE,
    rating DECIMAL(2,1) CHECK (rating BETWEEN 0 AND 10),
    comment TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, film_id)
);

CREATE TABLE forums (
    id SERIAL PRIMARY KEY,
    film_id INT REFERENCES films(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE forum_replies (
    id SERIAL PRIMARY KEY,
    forum_id INT REFERENCES forums(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    parent_reply_id INT NULL REFERENCES forum_replies(id) ON DELETE CASCADE,
    reply TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Kelompok

-   Miftahul Fitriah (Ketua)
-   Ichramsyah Abdurrachman

## UML

### Class Diagram

![Class Diagram](https://github.com/user-attachments/assets/49e71499-4a76-474a-b1e6-93eca50870a7)

### Use Case Diagram

![usecase diagram](https://github.com/user-attachments/assets/b415e827-8202-461d-b914-bd26e3f2afd7)

### Activity Diagram

![Activity Diagram](https://github.com/user-attachments/assets/1bc38f7d-4d99-42e6-b5c9-9393080462ca)

## Performa Website

### Pagespeed Insight

- Laporan URL: [https://pagespeed.web.dev/analysis/https-rinemaa-paramadina-ac-id](https://pagespeed.web.dev/analysis/https-rinemaa-paramadina-ac-id/d474r7jp7e?form_factor=desktop)

![Asset 1](https://github.com/user-attachments/assets/d5bc74eb-29a7-424b-a5dc-a3f25434f81f)

### ⚠️ Catatan Akses dan SEO Audit

Website Rinema dihosting menggunakan subdomain kampus paramadina.ac.id, sehingga berada di bawah kebijakan keamanan server institusi. Hal ini mengakibatkan beberapa layanan audit otomatis seperti Google Lighthouse atau PageSpeed Insights tidak dapat mengakses situs sepenuhnya karena adanya pembatasan pada level server, yang ditandai dengan kode HTTP 403 (Forbidden). Meskipun demikian, situs ini tetap dapat diindeks oleh Google dan telah muncul di hasil pencarian, yang membuktikan bahwa Googlebot tetap diizinkan mengakses dan mengindeks konten. Untuk keperluan pengujian performa dan SEO secara menyeluruh, disarankan menjalankan audit Lighthouse secara lokal melalui browser.

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

Berikut adalah pratinjau halaman utama RINEMA :

-   **Halaman Beranda**
    
    ![image](https://github.com/user-attachments/assets/06011c9d-28f8-4f1e-830b-0fe11ae20fe8)

-   **Halaman Film**
  
    ![image](https://github.com/user-attachments/assets/fe9438a3-eb61-4a58-ad76-42b508804c4a)
  
-   **Halaman Detail Film**

    ![image](https://github.com/user-attachments/assets/3785a1a1-a765-4129-99b5-d36b2463971b)

-   **Forum Diskusi**
 
    ![image](https://github.com/user-attachments/assets/47684a78-afa9-4712-9eb9-da43ceeffa1d)

-   **Pemberian Rating**
 
    ![image](https://github.com/user-attachments/assets/669a7774-fe1a-4dbd-91ff-667e74ce9f72)

-   **Halaman Login** 

    ![image](https://github.com/user-attachments/assets/18f61793-ddf2-45e8-9346-b7c34e34c1fa)
    
-   **Halaman Register** 

    ![image](https://github.com/user-attachments/assets/51a5da02-1ffc-48c1-8db5-0dfb09f2202d)

-   **Halaman Profil** 

    ![image](https://github.com/user-attachments/assets/8e22335f-bead-4af5-9642-469d0c3a3aa8)

-   **Halaman Dashboard Admin** 

    ![image](https://github.com/user-attachments/assets/029b801f-3871-429b-abad-2d8a48a91832)

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

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file [LICENSE](LICENSE.txt) untuk detailnya.

## Kontak

Untuk pertanyaan, umpan balik, atau peluang kolaborasi, hubungi tim RINEMA:

-   **Email**: ichramsyahabdurrachman@gmail.com

Bergabunglah dengan kami untuk merayakan sinema Indonesia bersama RINEMA! 🎥

