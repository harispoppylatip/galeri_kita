# Frontend Design Guide — Haris & Balqis Gallery

## 1) Sitemap Website

- `/` — Beranda
- `/galeri` — Galeri Foto
- `/album` — Album
- `/foto/{slug}` — Detail Foto
- `/tentang-kami` — Tentang Kami
- `/admin/upload-foto` — Upload Foto (Admin Layout)

## 2) Wireframe Setiap Halaman

### Beranda

```
[Navbar]
[Hero: Judul + CTA + Highlight Foto]
[Timeline Kenangan Terbaru (grid 3 kolom)]
[Album Pilihan (grid card)]
[Footer]
```

### Galeri Foto

```
[Navbar]
[Header Galeri + Filter Tab]
[Timeline by Bulan]
  [Tanggal]
  [Google Photos-like Grid]
  [Tanggal]
  [Google Photos-like Grid]
[Load More + Infinite Anchor]
[Lightbox Modal]
[Footer]
```

### Album

```
[Navbar]
[Header Album]
[Album Card List (cover + metadata + preview 3 foto)]
[Footer]
```

### Detail Foto

```
[Navbar]
[Back to Galeri]
[Foto Besar][Panel Info Metadata]
[Foto Terkait]
[Footer]
```

### Tentang Kami

```
[Navbar]
[Hero Tentang Kami]
[Timeline Cerita Pasangan]
[Footer]
```

### Upload Foto (Admin Layout)

```
[Navbar]
[Header Admin Upload]
[Form Upload][Panduan Cepat]
[Tabel Foto Terakhir]
[Footer]
```

## 3) Desain UI (Modern + Elegan)

- Mood: romantis, minimalis, modern.
- Warna utama: cream/warm tone (`cream`, `brown-primary`, `brown-light`, `brown-dark`).
- Typography:
    - Display/script: `Great Vibes`
    - Heading: `Playfair Display`
    - Body/UI text: `Poppins`
- Gaya visual: rounded card, soft shadow, hover halus, spacing lega.

## 4) Layout Galeri untuk Banyak Foto

- Menggunakan `.photos-grid` responsif:
    - Mobile: 2 kolom
    - Desktop: 4 kolom
- Variasi tile untuk ritme visual:
    - `.photo-tile--wide`
    - `.photo-tile--square`
    - `.photo-tile--tall`
- Timeline ditampilkan per bulan dan per tanggal untuk memudahkan browsing kronologis.

## 5) Pagination / Infinite Scroll

- Implementasi frontend demo di halaman galeri:
    - Tombol `Muat Lebih Banyak` sebagai fallback pagination sederhana.
    - `IntersectionObserver` pada anchor bawah untuk simulasi infinite scroll.
- Pendekatan ini siap diganti ke data backend Laravel (paginated API/query builder) nanti.

## 6) Tanggal pada Setiap Foto (Timeline)

- Level 1: Grup bulan (`April 2026`, `Maret 2026`, dst).
- Level 2: Grup tanggal detail (`24 April 2026`, dll).
- Tiap tile membawa metadata tanggal/lokasi untuk lightbox/detail.

## Struktur Komponen UI

- `Navbar` (desktop + mobile toggle)
- `HeroSection`
- `PhotoCard`
- `AlbumCard`
- `TimelineHeader`
- `PhotosGrid`
- `PhotoTile`
- `LightboxModal`
- `UploadFormPanel`
- `AdminTable`
- `Footer`

## Struktur Folder Frontend

```
resources/
  css/
    app.css
  js/
    app.js
  views/
    layouts/
      app.blade.php
    partials/
      gallery-data.blade.php
    pages/
      home.blade.php
      gallery.blade.php
      albums.blade.php
      photo-detail.blade.php
      about.blade.php
      admin-upload.blade.php
docs/
  frontend-design-guide.md
routes/
  web.php
```

## Rekomendasi UX untuk Galeri Foto

1. Pertahankan filter sederhana (Semua, Romantis, Travel, Daily) agar tidak membingungkan.
2. Pastikan tap target mobile cukup besar (minimal 40px tinggi).
3. Gunakan skeleton/loading state saat nanti terhubung backend.
4. Simpan posisi scroll saat kembali dari halaman detail ke galeri.
5. Beri opsi keyboard di lightbox (Esc untuk tutup, panah kiri/kanan untuk navigasi) pada iterasi berikutnya.
