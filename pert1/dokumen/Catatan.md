# catatan

## docker

Docker adalah alat yang memungkinkan kita menjalankan aplikasi dalam "kotak" terpisah (disebut container). Bayangkan seperti ini:

    Biasanya, saat kita menginstal aplikasi di komputer, aplikasi itu berbagi sumber daya dengan sistem operasi dan aplikasi lain. Ini bisa menyebabkan masalah, seperti konflik atau ketidakcocokan versi.

    Dengan Docker, aplikasi dan semua yang dibutuhkannya (seperti library, tools, atau file konfigurasi) dikemas dalam sebuah container. Container ini terisolasi dari sistem utama, sehingga aplikasi bisa berjalan dengan lancar tanpa mengganggu aplikasi lain.

## docker-compose.yml
```yml
services:
  web:
    image: nginx:latest
    ports:
      - 80:80
    volumes:
      - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf
      - ./src:/usr/share/nginx/html

```
## Docker Compose Configuration

File `docker-compose.yml` ini digunakan untuk mengatur dan menjalankan layanan menggunakan Docker. Berikut adalah penjelasan dari setiap bagian:

## Services

### `web`
Layanan ini menggunakan image `nginx:latest` untuk menjalankan server web Nginx.

#### Konfigurasi:
- **`image: nginx:latest`**: 
  - Menggunakan image resmi Nginx dengan tag `latest` (versi terbaru).
  
- **`ports:`**
  - `- 80:80`: 
    - Memetakan port `80` pada host (komputer lokal) ke port `80` pada container.
    - Ini memungkinkan akses ke server Nginx melalui `http://localhost:80`.

- **`volumes:`**
  - `- ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf`:
    - Memetakan file konfigurasi Nginx lokal (`./nginx/nginx.conf`) ke file konfigurasi default Nginx di dalam container (`/etc/nginx/conf.d/default.conf`).
    - Ini memungkinkan Anda untuk mengustomisasi konfigurasi Nginx tanpa perlu masuk ke dalam container.
  
  - `- ./src:/usr/share/nginx/html`:
    - Memetakan direktori lokal (`./src`) ke direktori `/usr/share/nginx/html` di dalam container.
    - Direktori ini biasanya digunakan oleh Nginx untuk menyimpan file-file HTML, CSS, JavaScript, dan aset lainnya yang akan disajikan oleh server web.

## Cara Menjalankan
1. Pastikan Docker dan Docker Compose sudah terinstal di sistem Anda.
2. Simpan file `docker-compose.yml` ini di direktori proyek Anda.
3. Jalankan perintah berikut di terminal:
   ```bash
   docker-compose up

# Environment Variables Configuration

File `.env` ini digunakan untuk menyimpan variabel lingkungan yang dapat digunakan dalam file `docker-compose.yml`. Variabel-variabel ini memungkinkan Anda untuk mengonfigurasi proyek Docker dengan lebih fleksibel dan dinamis.

## .env

```
COMPOSE_PROJECT_NAME=esgul
REPOSITORY_NAME=pemweb
IMAGE_TAG=latest
```

## Variabel Lingkungan

### `COMPOSE_PROJECT_NAME=esgul`
- **Deskripsi**: 
  - Menentukan nama proyek Docker Compose.
  - Nama proyek ini akan digunakan sebagai prefix untuk nama container, network, dan volume yang dibuat oleh Docker Compose.
- **Nilai**: 
  - `esgul`: Nama proyek ini adalah `esgul`.

### `REPOSITORY_NAME=pemweb`
- **Deskripsi**:
  - Menentukan nama repository atau direktori yang digunakan untuk proyek ini.
  - Ini bisa digunakan untuk mengatur nama image Docker atau direktori proyek.
- **Nilai**:
  - `pemweb`: Nama repository atau direktori adalah `pemweb`.

### `IMAGE_TAG=latest`
- **Deskripsi**:
  - Menentukan tag untuk image Docker yang akan digunakan.
  - Tag ini biasanya merujuk pada versi image (misalnya, `latest`, `1.0`, `2.0`, dll.).
- **Nilai**:
  - `latest`: Menggunakan tag `latest`, yang biasanya merujuk pada versi terbaru dari image.

# Konfigurasi Nginx

File `nginx.conf` ini digunakan untuk mengonfigurasi server Nginx. Konfigurasi ini menentukan bagaimana server Nginx akan menangani permintaan HTTP dan melayani file-file statis.

## nginx.conf
```nginx
server {
    listen 80;
    server_name localhost;

    root /usr/share/nginx/html;
    index index.html index.htm;

    location / {
        try_files $uri $uri/ =404;
    }
}
```

## Struktur Konfigurasi

### `server`
Blok `server` digunakan untuk mendefinisikan pengaturan server virtual. Setiap blok `server` dapat memiliki konfigurasi yang berbeda berdasarkan domain atau port.

#### Parameter dalam Blok `server`:
- **`listen 80;`**:
  - Menentukan bahwa server Nginx akan mendengarkan permintaan pada port `80`.
  - Port `80` adalah port default untuk protokol HTTP.

- **`server_name localhost;`**:
  - Menentukan nama server (domain) yang akan ditangani oleh blok `server` ini.
  - Dalam hal ini, server akan merespons permintaan yang ditujukan ke `localhost`.

- **`root /usr/share/nginx/html;`**:
  - Menentukan direktori root di mana file-file statis (seperti HTML, CSS, JavaScript) disimpan.
  - Nginx akan mencari file-file yang diminta oleh klien di direktori ini.
  - Dalam konteks Docker, direktori ini dipetakan ke `./src` pada host melalui volume di `docker-compose.yml`.

- **`index index.html index.htm;`**:
  - Menentukan file default yang akan dilayani ketika klien mengakses direktori root (`/`).
  - Jika ada file `index.html` atau `index.htm` di direktori root, Nginx akan secara otomatis menampilkannya.

- **`location / { ... }`**:
  - Blok `location` digunakan untuk menentukan bagaimana Nginx harus menangani permintaan yang sesuai dengan path tertentu.
  - Dalam hal ini, `location /` menangani semua permintaan ke root path (`/`).

  #### Parameter dalam Blok `location`:
  - **`try_files $uri $uri/ =404;`**:
    - Mencoba melayani file yang diminta (`$uri`) atau direktori (`$uri/`).
    - Jika file atau direktori tidak ditemukan, Nginx akan mengembalikan respons `404 Not Found`.

## Contoh Penggunaan
- Jika Anda mengakses `http://localhost/`, Nginx akan mencoba menampilkan file `index.html` atau `index.htm` dari direktori `/usr/share/nginx/html`.
- Jika file tersebut tidak ada, Nginx akan mengembalikan respons `404 Not Found`.

## Cara Kerja dalam Docker
- File `nginx.conf` ini dipetakan ke `/etc/nginx/conf.d/default.conf` di dalam container Nginx melalui volume di `docker-compose.yml`.
- Direktori `/usr/share/nginx/html` di dalam container dipetakan ke `./src` pada host, sehingga Anda dapat mengelola file-file statis di direktori `./src`.

## Keuntungan
- **Sederhana**: Konfigurasi ini cocok untuk melayani aplikasi web statis.
- **Fleksibel**: Anda dapat dengan mudah menambahkan konfigurasi tambahan (seperti reverse proxy, caching, dll.) sesuai kebutuhan.
- **Mudah Dikelola**: File konfigurasi dapat diubah di host tanpa perlu masuk ke dalam container.

# WEBSITE
Website adalah kumpulan halaman web yang saling terhubung dan dapat diakses melalui internet. Website biasanya berisi teks, gambar, video, atau konten lainnya, dan dirancang untuk memberikan informasi, layanan, atau hiburan kepada pengguna.

Komponen Utama Website:

    Halaman Web (Web Page): Setiap website terdiri dari satu atau lebih halaman web. Contoh: Halaman beranda, halaman tentang kami, halaman kontak.

    Domain: Nama unik yang digunakan untuk mengidentifikasi website (contoh: google.com).

    Hosting: Tempat di mana file-file website disimpan dan diakses melalui internet.

    Browser: Perangkat lunak yang digunakan untuk mengakses website (contoh: Chrome, Firefox, Safari).

    Server: Komputer yang menyimpan dan mengirimkan halaman web ke browser pengguna.

# HTML
HTML adalah singkatan dari HyperText Markup Language. Ini adalah bahasa dasar yang digunakan untuk membuat dan menyusun halaman web. HTML bukanlah bahasa pemrograman, melainkan bahasa markup yang menggunakan "tag" untuk mendefinisikan struktur dan konten di dalam sebuah halaman web.
Apa Itu HTML?

- HTML adalah kerangka atau tulang punggung dari sebuah halaman web.

- HTML menggunakan tag (tanda khusus) untuk menandai elemen-elemen seperti teks, gambar, link, tabel, dan lainnya.

- File HTML disimpan dengan ekstensi .html dan bisa dibuka di browser web (seperti Chrome, Firefox, atau Edge).

## Penjelasan Kode HTML


#### `<!DOCTYPE html>`
- **Fungsi**: Mendefinisikan tipe dokumen sebagai HTML5. Ini membantu browser memahami versi HTML yang digunakan.

#### `<html lang="en">`
- **Fungsi**: Tag root yang membungkus seluruh konten HTML. Atribut `lang="en"` menunjukkan bahwa bahasa utama dokumen adalah Inggris.

#### `<head>`
- **Fungsi**: Berisi metadata tentang dokumen, seperti judul, stylesheet, dan informasi lainnya yang tidak ditampilkan langsung di halaman web.

#### `<meta charset="UTF-8">`
- **Fungsi**: Menentukan pengkodean karakter dokumen sebagai UTF-8, yang mendukung sebagian besar karakter dan simbol.

#### `<meta name="viewport" content="width=device-width, initial-scale=1.0">`
- **Fungsi**: Mengontrol tampilan halaman pada perangkat mobile. `width=device-width` membuat lebar halaman sesuai dengan lebar perangkat, dan `initial-scale=1.0` mengatur zoom awal ke 100%.

#### `<title>esgul</title>`
- **Fungsi**: Menentukan judul halaman yang ditampilkan di tab browser atau judul window.

#### `<body>`
- **Fungsi**: Berisi konten utama yang akan ditampilkan di halaman web, seperti teks, gambar, dan elemen lainnya.

#### `<h1>esgul</h1>`
- **Fungsi**: Membuat heading level 1 (judul utama) dengan teks "esgul".

#### `<p>esgul</p>`
- **Fungsi**: Membuat paragraf dengan teks "esgul".

#### `</body>`
- **Fungsi**: Menutup tag `<body>`, menandakan akhir dari konten utama.

#### `</html>`
- **Fungsi**: Menutup tag `<html>`, menandakan akhir dari dokumen HTML.



