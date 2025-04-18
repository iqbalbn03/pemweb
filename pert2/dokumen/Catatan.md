# Penjelasan tentang Bootstrap

Bootstrap adalah framework CSS open-source yang menyediakan komponen dan alat siap pakai untuk membangun antarmuka pengguna (UI) yang responsif dan modern. Berikut penjelasan implementasi Bootstrap :

## Struktur Dasar

1. **Pemanggilan CSS Bootstrap**:
   ```html
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
   ```
   - Mengimpor stylesheet Bootstrap dari CDN (Content Delivery Network)

2. **JavaScript Bootstrap**:
   ```html
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js"></script>
   ```
   - Popper.js diperlukan untuk komponen yang membutuhkan positioning seperti tooltips dan popovers
   - JavaScript Bootstrap untuk fungsi interaktif

## Komponen yang Digunakan

### 1. Navbar (Navigation Bar)
```html
<nav class="navbar navbar-expand-lg bg-body-tertiary">
```
- `navbar`: kelas dasar untuk komponen navbar
- `navbar-expand-lg`: navbar akan expand (melebar) pada breakpoint large (≥992px)
- `bg-body-tertiary`: warna background navbar

Fitur navbar:
- Logo/merk (`navbar-brand`)
- Tombol toggle untuk tampilan mobile (`navbar-toggler`)
- Menu dropdown
- Form pencarian

### 2. Card (Profile Section)
```html
<div class="card mb-4">
```
- `card`: komponen container fleksibel
- `mb-4`: margin bottom dengan ukuran 4 (1.5rem)

Fitur card profile:
- Gambar lingkaran (`rounded-circle`)
- Tombol dengan variasi (`btn-primary`, `btn-outline-success`)
- Spacing utility (`mt-3`, `mb-4`, dll)

### 3. Grid System
```html
<div class="row">
  <div class="col-lg-5 mx-auto">
```
- `row`: container untuk kolom
- `col-lg-5`: kolom dengan lebar 5/12 pada breakpoint large
- `mx-auto`: margin horizontal auto untuk posisi tengah

### 4. Progress Bar (Skills Section)
```html
<div class="progress rounded mb-3">
  <div class="progress-bar" role="progressbar" style="width: 90%;">
```
- Menampilkan skill dalam bentuk visual
- `progress`: container progress bar
- `progress-bar`: bar progres aktual
- `rounded`: sudut bulat

### 5. Utility Classes
Bootstrap menyediakan banyak utility class untuk:
- Spacing (`mt-5`, `mb-4`, `ms-1`)
- Warna teks (`text-muted`, `text-center`)
- Background (`bg-body-tertiary`)
- Flexbox (`d-flex`, `justify-content-center`)

### 6. Responsive Design
Bootstrap secara otomatis membuat desain responsif dengan:
- Breakpoints (xs, sm, md, lg, xl, xxl)
- Grid system yang menyesuaikan lebar layar
- Komponen yang beradaptasi (seperti navbar yang menjadi toggle menu di mobile)

## Kelebihan yang Terlihat dari Kode Ini

1. **Konsistensi Desain**: Semua komponen memiliki gaya yang konsisten
2. **Responsif**: Layout akan menyesuaikan berbagai ukuran layar
3. **Cepat Development**: Komponen siap pakai mengurangi kebutuhan kode custom
4. **Aksesibilitas**: Komponen Bootstrap dibangun dengan mempertimbangkan aksesibilitas
5. **Customizable**: Meskipun menggunakan class default, bisa dengan mudah dikustomisasi

Dokumentasi lengkap Bootstrap bisa dilihat di: https://getbootstrap.com/docs/5.3/getting-started/introduction/