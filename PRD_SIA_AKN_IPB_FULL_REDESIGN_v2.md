# PRD — Total UI/UX Redesign SIA AKN-IPB
**Versi:** 2.0 — Full Visual Reset  
**Status:** Ready for coding agent  
**Tujuan:** Mengganti keseluruhan tampilan SIA AKN-IPB agar terasa seperti produk software akuntansi modern yang dirancang khusus untuk lingkungan akademik—bukan dashboard template generik.

---

## 1. Arahan Utama

**Jangan sekadar mempercantik UI lama. Lakukan redesign menyeluruh.**

Ubah identitas visual, logo/wordmark, sistem warna, tipografi, struktur halaman, sidebar, topbar, KPI, grafik, tabel, filter, tombol, form, empty state, loading state, dan responsive layout. Hasil akhirnya harus terlihat berbeda secara jelas dari tampilan lama.

Arah visual: **“Academic Ledger”** — rapi, editorial, berwibawa, tenang, dan presisi. Referensi nuansa: software finance profesional dengan karakter institusi pendidikan. Hindari dashboard SaaS generik yang penuh kartu putih, gradient ungu/biru, ikon acak, rounded corner berlebihan, dan dekorasi yang tidak membantu pekerjaan.

PRD ini memberi kebebasan kreatif untuk keputusan visual. Coding agent boleh membuat keputusan desain yang lebih baik selama tetap mengikuti sistem desain dan prinsip di bawah.

## 2. Tujuan Produk

SIA AKN-IPB adalah workspace sistem informasi akuntansi. UI harus membantu pengguna:
- Memahami kondisi keuangan dan aktivitas terbaru dalam beberapa detik.
- Menemukan transaksi, laporan, akun, dan periode dengan cepat.
- Membedakan data penting, peringatan, dan informasi pendukung.
- Melakukan pekerjaan akuntansi dengan konsisten dan minim kesalahan.
- Menggunakan aplikasi dengan nyaman di desktop, laptop, tablet, dan ponsel.

### Ukuran keberhasilan
- Perubahan visual terlihat nyata di seluruh halaman utama, bukan hanya dashboard.
- Navigasi aktif dan hierarki informasi lebih jelas.
- Tabel dan filter tetap efisien untuk data padat.
- Tidak ada perubahan pada hasil perhitungan, API, database, autentikasi, otorisasi, atau aturan bisnis.
- Semua komponen memakai satu design system yang konsisten.

## 3. Identitas Visual Baru

### 3.1 Nama dan wordmark
Gunakan wordmark:
- **SIA** sebagai nama utama yang kuat.
- **AKN · IPB** sebagai identitas institusi sekunder.
- Descriptor kecil: **Sistem Informasi Akuntansi**.

Jangan menggunakan logo resmi IPB atau lambang institusi yang tidak tersedia/diizinkan. Buat **logo produk original berbasis SVG**: simbol geometris sederhana yang menggabungkan bentuk buku besar/ledger dengan kolom atau garis pembukuan. Logo harus tetap terbaca pada ukuran 24–32 px, monokrom, dan tanpa gradient. Jika project sudah memiliki aset logo resmi yang sah, pertahankan aset tersebut sebagai identitas institusi dan tempatkan wordmark produk di sebelahnya.

### 3.2 Palet warna
Gunakan warna berikut sebagai titik awal dan definisikan sebagai design tokens/CSS variables.

| Token | Warna | Penggunaan |
|---|---|---|
| `--ink-950` | `#14251F` | Teks utama, sidebar gelap |
| `--ink-800` | `#263D34` | Heading dan elemen penting |
| `--forest-700` | `#245B45` | Primary action, link aktif |
| `--forest-600` | `#347657` | Hover/active states |
| `--mint-100` | `#E5F1E9` | Selected state dan highlight lembut |
| `--paper-50` | `#F7F8F4` | Latar aplikasi |
| `--surface-0` | `#FFFFFF` | Surface utama |
| `--line-200` | `#E1E6DF` | Border dan divider |
| `--muted-600` | `#69776F` | Teks sekunder |
| `--amber-700` | `#96631B` | Warning |
| `--amber-100` | `#FBF0D8` | Warning background |
| `--red-700` | `#A33E3E` | Error/overdue |
| `--red-100` | `#F9E8E6` | Error background |
| `--blue-700` | `#315E88` | Informasi netral |
| `--blue-100` | `#E8F0F8` | Informasi background |

Jangan memakai warna hanya sebagai dekorasi. Warna status harus memiliki makna konsisten. Jangan mengandalkan warna saja untuk menyampaikan status.

### 3.3 Tipografi
Gunakan font lokal yang sudah ada bila tersedia. Jika project mendukung import font, gunakan **Plus Jakarta Sans** untuk UI dan **IBM Plex Mono** hanya untuk kode akun, nomor referensi, dan angka yang perlu disejajarkan. Fallback: `Inter`, system UI, sans-serif.

- Heading halaman: 28–32 px, weight 650–700.
- Heading section: 16–18 px, weight 600.
- Body: 14 px dengan line-height 1.5.
- Label dan metadata: 12–13 px.
- Angka finansial utama: 26–32 px, tabular numerals.
- Tabel: 13–14 px; jangan mengecilkan font agar semua kolom muat.

### 3.4 Bentuk dan elevasi
- Radius panel: 10–12 px.
- Radius input/button: 7–9 px.
- Radius badge: 5–6 px, bukan pill besar untuk semua hal.
- Border tipis lebih diutamakan daripada shadow.
- Shadow hanya untuk popover, dropdown, modal, dan elemen yang benar-benar mengambang.
- Gunakan spacing scale 4/8/12/16/24/32 px.
- Hindari glassmorphism, neon glow, gradient dekoratif, blur berlebihan, dan animasi berlebihan.

## 4. Struktur Aplikasi Baru

### 4.1 App shell
Buat shell aplikasi yang konsisten:
- Sidebar kiri tetap pada desktop, lebar sekitar 244 px.
- Area konten memiliki lebar fleksibel dengan batas baca yang masuk akal.
- Header halaman berada di area konten, bukan menumpuk terlalu banyak toolbar global.
- Latar utama `paper-50`, panel konten `surface-0`.
- Sidebar boleh memakai `ink-950` dengan teks terang dan active state `forest-700`/mint yang jelas.
- Sidebar dapat collapse ke mode ikon di desktop dan menjadi drawer di layar kecil.

### 4.2 Sidebar
Bagian atas:
1. Logo original + wordmark `SIA`.
2. Label kecil `AKN · IPB`.
3. Pemisah halus.

Kelompok navigasi (sesuaikan dengan route yang benar-benar ada di project):
- **WORKSPACE**
  - Ringkasan
  - Transaksi
  - Jurnal Umum
- **FINANSIAL**
  - Buku Besar
  - Daftar Akun
  - Laporan Keuangan
- **PENGELOLAAN**
  - Pengguna / Pengaturan, hanya jika route dan izin memang ada.

Ketentuan:
- Jangan membuat link palsu untuk halaman yang tidak ada.
- Pertahankan seluruh route yang sudah ada; petakan ke kelompok paling sesuai.
- Item aktif memiliki background terarah, penanda sisi kiri 3 px, dan teks/icon yang kontras.
- Ikon harus satu keluarga visual (misalnya Lucide yang sudah terpasang), ukuran 18 px, stroke konsisten.
- Bagian bawah: profil pengguna, role jika tersedia, dan tombol keluar jika memang sudah ada.
- Jangan menampilkan data profil atau role palsu.

### 4.3 Topbar
Sederhanakan topbar menjadi:
- Breadcrumb atau nama area kerja di kiri.
- Periode aktif / filter global hanya jika memang memengaruhi data halaman.
- Aksi notifikasi hanya jika fitur nyata tersedia.
- Profil pengguna di kanan jika sudah didukung.

Jangan menambahkan search global, notifikasi, avatar, atau tombol yang tidak punya fungsi nyata. Hindari dua header yang menyampaikan informasi sama.

## 5. Dashboard Baru

Dashboard bukan sekadar grid KPI. Susun menjadi ringkasan kerja akuntansi.

### 5.1 Page header
- Eyebrow kecil: `WORKSPACE / RINGKASAN`.
- Judul: `Ringkasan Keuangan`.
- Deskripsi singkat: menjelaskan apa yang ditampilkan.
- Kontrol periode yang jelas, dengan label dan rentang tanggal yang terlihat.
- Aksi utama harus sesuai kemampuan aplikasi saat ini; misalnya `Lihat transaksi` jika route tersedia. Jangan mengarang aksi yang tidak didukung.

### 5.2 KPI / financial summary
Gunakan empat metrik maksimum dalam satu baris desktop, dipilih berdasarkan data nyata yang tersedia:
- Total pemasukan.
- Total pengeluaran.
- Saldo bersih / selisih.
- Jumlah transaksi.

Jangan menampilkan metrik jika definisi atau sumber datanya tidak jelas. Jangan menciptakan persentase pertumbuhan, tren, target, atau perbandingan periode tanpa perhitungan valid dan data pembanding yang tersedia.

Desain setiap KPI:
- Label kecil dan jelas.
- Nilai utama besar, rata kanan bila masuk akal.
- Periode atau definisi singkat.
- Indikator tren hanya jika benar-benar dihitung dari data.
- Gunakan border dan whitespace; jangan membuat empat kartu identik dengan icon dekoratif besar.

### 5.3 Visualisasi
- Gunakan satu grafik utama yang menjawab pertanyaan jelas, misalnya arus pemasukan/pengeluaran per periode.
- Legend eksplisit; label sumbu terbaca; tooltip informatif.
- Hindari donut chart dekoratif tanpa tujuan analitis.
- Jika data belum tersedia atau terlalu sedikit, tampilkan empty state yang menjelaskan kondisi—jangan membuat data dummy seolah nyata.
- Gunakan warna forest untuk pemasukan, amber/merah untuk pengeluaran bila sesuai konteks, dan tetap dapat dibedakan tanpa warna.

### 5.4 Aktivitas dan transaksi terbaru
- Judul section: `Transaksi terbaru`.
- Tampilkan kolom yang paling membantu: tanggal, deskripsi, akun/kategori jika tersedia, jenis, nominal, status jika tersedia.
- Nominal disejajarkan ke kanan dan menggunakan tabular numerals.
- Gunakan status badge hanya bila status benar-benar ada di model data.
- Sediakan link `Lihat semua` hanya bila route terkait tersedia.
- Desktop menampilkan tabel; mobile menampilkan list/row ringkas yang tetap mempertahankan nominal, tanggal, dan deskripsi.

### 5.5 Validitas periode
Periode di UI harus konsisten dengan data yang ditampilkan. Jangan menampilkan periode Januari 2026 jika daftar transaksi yang ditampilkan sebenarnya berasal dari Desember 2023, kecuali perbedaan tersebut memang disengaja dan diberi penjelasan yang jelas. Jangan memperbaiki mismatch dengan mengubah data sumber atau hardcode tanggal; telusuri state/filter/API yang ada.

## 6. Design System Komponen

Buat atau rapikan komponen reusable sesuai framework yang digunakan:
- `AppShell`
- `Sidebar`
- `Topbar`
- `PageHeader`
- `SectionHeader`
- `MetricSummary`
- `DateRangeFilter` atau filter periode yang sesuai dengan implementasi sekarang
- `DataTable`
- `StatusBadge`
- `SearchField`
- `SelectField`
- `Button` dengan variant primary/secondary/tertiary/danger
- `EmptyState`
- `ErrorState`
- `LoadingSkeleton`
- `ConfirmDialog`
- `Toast` atau feedback pattern yang sudah dipakai project

Jangan membuat duplikasi komponen jika versi yang setara sudah ada; refactor komponen existing bila lebih aman.

### Tombol
- Primary: forest solid, teks putih.
- Secondary: putih/paper dengan border.
- Tertiary: tanpa background untuk aksi ringan.
- Danger: merah untuk aksi destruktif.
- Semua tombol punya hover, focus-visible, active, disabled, dan loading state yang jelas.

### Input dan filter
- Label selalu terlihat; jangan hanya mengandalkan placeholder.
- Focus ring jelas dan konsisten.
- Pesan validasi tampil dekat field terkait.
- Filter yang diterapkan harus terlihat sebagai state aktif dan dapat di-reset.
- Pertahankan perilaku filter yang sudah benar.

### Tabel
- Header memiliki kontras dan pemisahan yang jelas.
- Row height sekitar 44–52 px.
- Hover state halus.
- Angka rata kanan; tanggal dan kode punya alignment konsisten.
- Sorting hanya ditampilkan jika benar-benar berfungsi.
- Pagination hanya ditampilkan jika implementasinya tersedia.
- Pada layar sempit, gunakan horizontal overflow terkontrol atau layout row mobile; jangan memampatkan semua kolom sampai tidak terbaca.

### State
Setiap halaman utama harus menangani:
- Loading.
- Data tersedia.
- Empty result.
- Error.
- Permission denied, jika relevan.
- Action success/failure.
Tidak boleh ada skeleton yang berputar selamanya atau tombol yang tampak aktif tapi tidak bekerja.

## 7. Motion dan Micro-interaction
- Durasi transisi umum 120–180 ms.
- Animasi hanya untuk feedback, perpindahan state, drawer, dropdown, dan modal.
- Hindari parallax, animasi masuk berulang, dan gerakan dekoratif.
- Hormati `prefers-reduced-motion`.
- Semua interaksi harus terasa cepat dan tidak menghalangi pekerjaan.

## 8. Responsive Behavior
### Desktop ≥ 1280 px
- Sidebar penuh.
- KPI 4 kolom bila muat.
- Grafik dan panel aktivitas menggunakan grid seimbang.
- Tabel menampilkan kolom penting.

### Tablet 768–1279 px
- Sidebar dapat collapse.
- KPI 2 kolom.
- Grafik dan tabel disusun ulang sesuai lebar.

### Mobile < 768 px
- Sidebar menjadi drawer dengan tombol menu yang aksesibel.
- Header tidak bertumpuk berlebihan.
- KPI 2 kolom atau 1 kolom sesuai panjang nilai.
- Form satu kolom.
- Tabel berubah menjadi list atau overflow yang disengaja.
- Tombol utama mudah dijangkau; tidak ada horizontal overflow pada keseluruhan halaman.

## 9. Accessibility
- Kontras teks memenuhi WCAG AA untuk teks normal sebisa mungkin.
- Navigasi keyboard berfungsi.
- Focus indicator terlihat.
- Icon-only button wajib memiliki accessible label.
- Jangan memakai warna sebagai satu-satunya indikator.
- Gunakan semantic heading order, label form, dan tabel yang benar.
- Modal/drawer mengelola fokus dengan benar.
- Pastikan ukuran target sentuh nyaman pada mobile.

## 10. Batasan Teknis dan Integritas Data

Ini adalah redesign frontend, bukan perubahan sistem akuntansi.

**Jangan mengubah:**
- Backend, database schema, API contract, business logic, atau perhitungan akuntansi.
- Authentication, authorization, role, dan permission checks.
- Sumber data transaksi atau aturan pembentukan jurnal.
- Route yang sudah digunakan tanpa alasan teknis yang kuat.
- Dependency/build setup kecuali benar-benar diperlukan dan dijelaskan.

**Wajib:**
- Audit struktur project, framework, route, komponen, style system, dan perubahan lokal sebelum mengedit.
- Gunakan data dari sumber yang sudah ada; jangan hardcode angka transaksi, saldo, user, status, grafik, atau tanggal.
- Pertahankan seluruh fitur yang berjalan.
- Jika ada elemen yang tidak didukung backend, jangan pura-pura membuatnya berfungsi.
- Jika nama field atau definisi metrik belum jelas, ikuti implementasi existing dan dokumentasikan asumsi; jangan menebak perhitungan finansial.
- Jangan menghapus file atau perubahan yang dibuat sebelumnya tanpa memeriksa kegunaannya.

## 11. Rencana Implementasi Wajib

### Fase 1 — Audit
1. Periksa struktur repository, package manager, framework, routing, dan entry point.
2. Periksa semua halaman, bukan hanya screenshot dashboard.
3. Temukan komponen layout, token CSS, library icon, chart, tabel, form, dan theme yang sudah digunakan.
4. Identifikasi perubahan lokal yang belum di-commit; jangan menimpanya.
5. Buat daftar route dan fitur yang harus tetap berjalan.

### Fase 2 — Design system
1. Implementasikan token warna, typography, spacing, radius, border, shadow, dan focus ring.
2. Buat logo SVG original/wordmark produk sesuai arahan.
3. Bangun ulang app shell, sidebar, topbar, dan komponen dasar.
4. Pastikan tema diterapkan konsisten, bukan ditambahkan sebagai stylesheet yang hanya menimpa sebagian UI lama.

### Fase 3 — Implementasi halaman
1. Redesign dashboard penuh.
2. Terapkan bahasa visual baru ke seluruh halaman yang ada.
3. Redesign tabel, filter, form, modal, empty/loading/error state.
4. Pastikan route aktif, navigasi, tombol, dan form tetap bekerja.

### Fase 4 — Validasi
1. Jalankan lint, typecheck, test, dan build sesuai script project.
2. Perbaiki error yang muncul akibat perubahan.
3. Jalankan aplikasi dan periksa dashboard serta halaman utama di desktop dan mobile.
4. Periksa overflow, kontras, focus state, console error, dan data yang tidak konsisten.
5. Jika browser automation/screenshot tersedia, ambil screenshot sebelum-sesudah untuk membuktikan perubahan visual.

## 12. Acceptance Criteria

Pekerjaan dianggap selesai hanya jika:
- [ ] Tampilan secara visual jelas berbeda dari UI lama.
- [ ] Identitas SIA baru diterapkan pada logo/wordmark dan app shell.
- [ ] Warna, tipografi, spacing, radius, dan komponen mengikuti design system.
- [ ] Sidebar, topbar, dashboard, KPI, grafik, tabel, filter, dan state utama telah didesain ulang.
- [ ] Semua halaman/route existing tetap bisa diakses.
- [ ] Semua angka dan grafik berasal dari data nyata; tidak ada data dummy yang disamarkan sebagai real.
- [ ] Tidak ada perubahan backend atau business logic.
- [ ] Responsive desktop/tablet/mobile berfungsi.
- [ ] Loading, empty, error, disabled, focus, dan feedback state ditangani.
- [ ] Lint/typecheck/test/build yang tersedia dijalankan dan hasilnya dilaporkan.
- [ ] Perubahan visual diverifikasi lewat screenshot atau inspeksi langsung bila tooling memungkinkan.

## 13. Prompt Operasional untuk Coding Agent

Baca PRD ini sampai selesai. Lakukan **full visual redesign**, bukan perbaikan kecil atau sekadar mengganti warna. Mulai dengan mengaudit repository, route, design system, data flow, dan perubahan lokal. Lanjutkan dari kondisi project yang benar-benar ada; jangan reset atau menimpa pekerjaan yang masih valid.

Bangun identitas visual **Academic Ledger** untuk SIA AKN-IPB dengan logo/wordmark produk original, palet forest/paper, tipografi profesional, app shell baru, sidebar/topbar baru, dashboard baru, serta pembaruan menyeluruh pada semua halaman dan komponen. Pertahankan fitur, route, integrasi, backend, API, autentikasi, otorisasi, dan business logic yang sudah ada.

Jangan berhenti setelah membuat rencana atau token warna. Implementasikan perubahan langsung ke source code. Jangan membuat data, metrik, tombol, route, atau fitur palsu. Setelah selesai, jalankan pemeriksaan yang tersedia dan laporkan: file utama yang diubah, halaman yang sudah di-redesign, hasil lint/typecheck/test/build, isu yang belum selesai, serta bukti verifikasi visual jika memungkinkan.
