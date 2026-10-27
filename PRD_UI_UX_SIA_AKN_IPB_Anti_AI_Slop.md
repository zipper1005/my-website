# PRD UI/UX — Redesign Anti-AI-Slop SIA AKN-IPB

**Versi:** 1.0  
**Tanggal:** 27 Oktober 2026  
**Status:** Spesifikasi implementasi  
**Cakupan:** Dashboard setelah login dan shared application shell  
**Prinsip utama:** Redesign UI/UX tanpa merusak fungsi aplikasi yang sudah berjalan.

---

## 1. Ringkasan Produk

SIA AKN-IPB adalah sistem informasi akuntansi. Antarmuka harus terasa seperti aplikasi akuntansi institusional yang dibuat dengan tujuan jelas: akurat, mudah dipindai, efisien untuk pekerjaan rutin, dan konsisten.

Tujuan redesign bukan sekadar mengganti warna atau membuat tampilan lebih minimalis. Perubahan harus memperbaiki hierarki informasi, kepadatan data, navigasi, keterbacaan angka finansial, perilaku responsif, serta konsistensi interaksi.

**Arah desain:** *Institutional Accounting Workspace* — profesional, tenang, fungsional, dan memiliki karakter visual yang konsisten.

### Hasil yang diharapkan
- Dashboard tidak terlihat seperti template admin/SaaS generik.
- Pengguna dapat memahami kondisi keuangan dan menemukan transaksi penting dengan cepat.
- Navigasi, filter periode, grafik, tabel, dan aksi utama memiliki prioritas visual yang jelas.
- Semua data, perhitungan, izin, dan alur bisnis tetap berasal dari implementasi yang sudah ada.
- Tampilan bekerja baik di desktop, tablet, dan ponsel.

---

## 2. Masalah pada UI Saat Ini

Berdasarkan screenshot dashboard yang diberikan, masalah utama meliputi:

1. **Sidebar terlalu dominan.** Area biru gelap mengambil perhatian besar dan menu tampil seperti template admin standar.
2. **KPI terlalu repetitif.** Empat kartu dengan pola, ikon dalam kotak berwarna, dan proporsi identik membuat layar terasa otomatis dibuat dari komponen template.
3. **Dekorasi lebih menonjol daripada data.** Ikon dan warna pada kartu menambah kebisingan visual tanpa selalu memberikan informasi.
4. **Grafik terasa generik.** Grafik batang belum cukup menjelaskan konteks periode, skala, satuan, dan hubungan data.
5. **Tabel transaksi kurang efisien.** Kolom dan baris perlu lebih mudah dipindai; deskripsi yang terpotong tidak boleh menghilangkan akses ke informasi lengkap.
6. **Header kurang tertata.** Pencarian, shortcut, notifikasi, audit trail, periode, dan ekspor saling berebut perhatian.
7. **Overflow horizontal.** Screenshot memperlihatkan scrollbar horizontal di level halaman. Ini harus diperiksa akar masalahnya, bukan sekadar disembunyikan.
8. **Konsistensi periode perlu diverifikasi.** Screenshot menunjukkan periode Januari 2026 sementara transaksi yang terlihat bertanggal Desember 2023. Periksa apakah ini disengaja, data demo, atau bug filter.

---

## 3. Tujuan dan Bukan Tujuan

### Tujuan
- Memperbaiki hierarki visual dan alur kerja.
- Membuat data finansial menjadi fokus utama.
- Mengurangi ornamen yang tidak memiliki fungsi.
- Menetapkan aturan konsisten untuk warna, tipografi, jarak, ikon, tabel, grafik, dan status.
- Mempertahankan seluruh fungsi dan perilaku aplikasi yang sudah ada.
- Memperbaiki responsivitas dan aksesibilitas.

### Bukan tujuan
- Membangun ulang aplikasi dari nol.
- Mengganti framework, routing, autentikasi, database, atau API.
- Mengubah rumus akuntansi atau struktur data demi tampilan.
- Menghapus fitur yang ada hanya karena tidak cocok dengan mockup.
- Menambahkan fitur palsu, data dummy, statistik rekaan, atau marketing copy.
- Mengubah seluruh halaman yang tidak termasuk cakupan tanpa kebutuhan teknis.

---

## 4. Prinsip Desain Anti-AI-Slop

1. **Fungsi lebih penting daripada dekorasi.** Setiap elemen harus membantu navigasi, pemahaman data, atau tindakan pengguna.
2. **Hierarki yang disengaja.** Tidak semua elemen harus terlihat menonjol pada saat bersamaan.
3. **Kepadatan informasi yang sesuai.** Sistem akuntansi harus efisien, bukan dipenuhi whitespace yang tidak produktif.
4. **Komposisi tidak repetitif.** Jangan gunakan pola kartu identik untuk semua jenis informasi jika tabel, daftar, atau ringkasan inline lebih cocok.
5. **Karakter visual berasal dari detail.** Tipografi, alignment, angka tabular, batas, dan ritme spacing lebih penting daripada efek dekoratif.
6. **Data nyata, bukan ilusi.** Tidak boleh menciptakan tren, persentase, status, transaksi, atau profil pengguna yang tidak didukung sistem.
7. **Interaksi dapat diprediksi.** Tombol, filter, menu, tabel, dan dialog harus berperilaku konsisten.
8. **Aksesibilitas bukan tambahan.** Kontras, keyboard navigation, label, fokus, dan status harus dirancang sejak awal.

### Hindari secara eksplisit
- Gradient ungu-biru sebagai gaya default.
- Glow, blur blob, glassmorphism, dan efek neon yang tidak relevan.
- Badge dekoratif seperti “AI Powered” tanpa fungsi.
- Emoji sebagai ikon antarmuka.
- Shadow tebal pada setiap kartu.
- Radius besar seragam di semua komponen.
- Grid kartu berulang hanya untuk memenuhi ruang.
- Grafik dengan data palsu atau label yang tidak jelas.
- Animasi dekoratif yang memperlambat pekerjaan.
- Teks generik, lorem ipsum, atau fitur yang sebenarnya tidak tersedia.

---

## 5. Pengguna dan Kebutuhan

### Pengguna utama
Pengguna sistem akuntansi yang telah login, dengan akses sesuai role/permission yang sudah diterapkan.

### Kebutuhan
- Mengetahui ringkasan kondisi keuangan dengan cepat.
- Memilih atau memeriksa periode pelaporan.
- Menemukan transaksi terbaru dan membuka detailnya.
- Berpindah ke Transaksi, Jurnal, Buku Besar, Laporan, Master Data, dan Pengaturan.
- Menjalankan tindakan yang memang diizinkan role pengguna.
- Memahami kondisi loading, data kosong, error, dan keberhasilan tanpa kebingungan.

Jangan mengasumsikan semua pengguna memiliki akses yang sama. Pertahankan role dan permission yang sudah ada.

---

## 6. Arsitektur Informasi

Pertahankan semua route dan menu yang tersedia. Susunan berikut adalah panduan pengelompokan, bukan izin untuk menghapus atau mengganti route.

### Navigasi utama
- Dashboard
- Transaksi
- Jurnal
- Buku Besar
- Laporan
- Master Data
- Pengaturan

### Elemen shell aplikasi
- Sidebar dengan state aktif yang jelas.
- Topbar untuk pencarian, notifikasi, akses Audit Trail jika tersedia, dan profil pengguna.
- Area konten dengan judul halaman, konteks periode, dan aksi yang relevan.
- Navigasi responsif untuk layar sempit.

Tautan, submenu, shortcut keyboard, dan tombol hanya boleh ditampilkan sebagai fitur aktif jika implementasinya benar-benar tersedia.

---

## 7. Layout Dashboard

### 7.1 Sidebar
- Target lebar desktop: sekitar 224–248 px; sesuaikan dengan konten dan implementasi yang ada.
- Gunakan satu warna dasar yang stabil, tanpa kontras berlebihan antarbagian.
- Gunakan ikon dari library yang sudah tersedia.
- Ikon konsisten sekitar 18–20 px dan tidak ditempatkan dalam kotak warna dekoratif untuk setiap item.
- State aktif menggunakan indikator sederhana, misalnya latar sedikit berbeda dan garis aksen tipis.
- Atur menu dalam kelompok yang masuk akal jika struktur fitur mendukung.
- Tempatkan pengaturan/logout sebagai tindakan sekunder.
- Pada layar sempit, gunakan drawer atau pola navigasi responsif yang sesuai.
- Pertahankan visibilitas menu berdasarkan permission pengguna.

### 7.2 Topbar
- Tata pencarian, notifikasi, Audit Trail, dan profil dengan alignment serta jarak konsisten.
- Hilangkan posisi absolut yang menyebabkan elemen menimpa area lain.
- Shortcut `Ctrl+K` hanya ditampilkan jika benar-benar berfungsi.
- Gunakan nama dan role dari sesi pengguna yang terautentikasi.
- Tampilkan indikator notifikasi hanya berdasarkan keadaan aktual.
- Jangan memunculkan tombol yang tidak berfungsi.

### 7.3 Page header dan filter
- Judul halaman memiliki prioritas tertinggi pada area konten.
- Deskripsi singkat bersifat informatif, bukan slogan pemasaran.
- Pemilih periode dan ekspor dikelompokkan sebagai kontrol halaman.
- Kontrol harus memiliki label yang jelas dan mudah digunakan.
- Filter periode harus memengaruhi komponen yang memang mengikuti periode tersebut.
- Pada mobile, kontrol boleh berpindah ke baris berikutnya; jangan sampai terpotong atau menyebabkan overflow.

### 7.4 Ringkasan KPI finansial
Metrik yang terlihat saat ini:
- Total Aset
- Total Kewajiban
- Ekuitas
- Laba/Rugi Tercatat

Ketentuan:
- Pertahankan metrik yang relevan dan sudah didukung data.
- Nominal menjadi fokus visual, dengan label yang ringkas.
- Gunakan format mata uang secara konsisten.
- Angka rata kanan atau gunakan tabular numerals jika sesuai konteks.
- Hilangkan kotak ikon dekoratif berukuran besar.
- Perbandingan periode hanya ditampilkan jika periode pembanding dan rumusnya valid.
- Naik/turun harus didasarkan pada perhitungan aktual. Jangan mengasumsikan semua kenaikan adalah positif.
- Jangan mengubah perhitungan akuntansi atau definisi metrik.
- Gunakan layout yang menyesuaikan lebar layar; tidak wajib empat kartu identik.
- Hindari memaksakan semua KPI tampil sebagai kartu jika ringkasan yang lebih sederhana lebih jelas.

### 7.5 Grafik pendapatan dan beban
- Pertahankan library chart jika sudah layak dan tidak ada alasan teknis kuat untuk menggantinya.
- Tampilkan judul, periode, legenda, satuan, serta skala yang mudah dipahami.
- Pastikan tooltip menunjukkan periode dan nilai aktual.
- Gunakan gridline secukupnya.
- Pilih warna yang tetap dapat dibedakan dan memiliki kontras memadai.
- Jangan menggunakan animasi atau gradient hanya untuk mempercantik grafik.
- Tangani data kosong, loading, dan error dengan state yang jelas.
- Jangan membuat nilai contoh terlihat seperti data produksi.
- Pastikan filter periode dan agregasi chart sesuai dengan aturan bisnis yang ada.

### 7.6 Tabel transaksi terbaru
- Pertahankan kolom yang penting dan tersedia, seperti tanggal, nomor bukti, keterangan, dan jumlah.
- Kolom nominal rata kanan dan menggunakan format angka konsisten.
- Tanggal dan nomor bukti harus mudah dipindai.
- Hindari truncation yang membuat informasi penting tidak dapat diakses.
- Jika deskripsi terlalu panjang, sediakan tooltip, detail view, atau mekanisme lain yang cocok dengan aplikasi.
- Gunakan divider halus dan row height yang efisien.
- Header tabel harus jelas tetapi tidak mendominasi.
- Pertahankan sort, filter, pagination, dan aksi baris jika tersedia.
- Tautan “Lihat Semua” harus menuju route transaksi yang benar.
- Pada mobile, gunakan kolom prioritas, horizontal scrolling yang terbatas pada tabel, atau representasi baris yang responsif. Jangan membuat seluruh halaman melebar.
- Pertahankan format angka dan semantik transaksi.

### 7.7 Aksi utama
- “Buat Transaksi” tetap mudah ditemukan jika tersedia dan diizinkan pengguna.
- Gunakan tombol dengan ukuran proporsional, bukan blok dekoratif yang mendominasi sidebar.
- Pertahankan perilaku, validasi, dan navigasi yang sudah ada.
- Jangan mengubah aksi utama menjadi sekadar tampilan visual.

---

## 8. Design System

Gunakan token berikut sebagai titik awal. Periksa identitas merek yang sudah ada sebelum menerapkannya secara menyeluruh.

### Palet warna
- App background: `#F5F5F0`
- Surface: `#FFFFFF`
- Primary: `#243D32`
- Accent: `#47765A`
- Main text: `#222A25`
- Secondary text: `#68716A`
- Border: `#E2E5DE`
- Success: `#28754B`
- Error: `#B33A3A`
- Warning: gunakan token yang konsisten dengan sistem yang ada dan pastikan kontras memadai.

Hindari penggunaan warna status sebagai dekorasi. Makna warna harus konsisten di seluruh aplikasi.

### Tipografi
- Utamakan font yang sudah ada jika terbaca baik.
- Gunakan maksimal satu keluarga font utama dan satu keluarga pendamping jika memang diperlukan.
- Buat hierarki jelas untuk page title, section heading, body, label, helper text, dan data finansial.
- Gunakan angka tabular untuk nilai mata uang jika font mendukung.
- Hindari terlalu banyak bobot font dan ukuran yang berbeda.

### Spacing
Gunakan skala dasar yang konsisten, misalnya:
`4, 8, 12, 16, 24, 32 px`

Jangan menggunakan jarak berbeda secara acak untuk komponen dengan fungsi yang sama.

### Border dan radius
- Border tipis untuk membedakan area dan tabel.
- Radius kecil hingga sedang, sekitar 4–12 px sesuai fungsi.
- Jangan menerapkan radius besar pada setiap komponen.
- Gunakan shadow hanya ketika membantu menunjukkan elevasi atau interaksi.

### Ikon
- Gunakan library yang sudah dipasang bila tersedia.
- Konsisten pada ukuran, stroke, alignment, dan makna.
- Jangan menggunakan emoji sebagai ikon.
- Jangan menambahkan ikon jika label teks sudah cukup dan ikon tidak meningkatkan pemahaman.

---

## 9. Responsivitas

Uji minimal pada viewport berikut:
- 320 px
- 390 px
- 768 px
- 1024 px
- 1280 px
- 1440 px

Kriteria:
- Tidak ada horizontal overflow pada level halaman.
- Sidebar berubah ke pola navigasi mobile yang tepat.
- Topbar tidak saling bertumpuk.
- Judul, filter, dan aksi tetap dapat diakses.
- KPI tersusun sesuai lebar yang tersedia.
- Grafik tetap terbaca tanpa memotong label penting.
- Tabel memiliki strategi responsif yang disengaja.
- Dialog, dropdown, dan menu tidak keluar dari viewport.
- Fokus keyboard tetap terlihat.
- Target sentuh memiliki ukuran yang memadai.

**Jangan menyelesaikan overflow hanya dengan `overflow-x: hidden`.** Temukan elemen yang menyebabkan lebar berlebih dan perbaiki sumbernya. Horizontal scrolling lokal pada tabel boleh digunakan jika memang diperlukan.

---

## 10. Interaksi, State, dan Aksesibilitas

Setiap komponen interaktif harus mempunyai state yang jelas sesuai kebutuhannya:
- Default
- Hover
- Focus
- Active
- Disabled
- Loading
- Success
- Error
- Empty state

Persyaratan:
- Semua aksi penting dapat diakses dengan keyboard.
- Label input dan kontrol eksplisit.
- Fokus keyboard terlihat.
- Kontras teks dan kontrol memadai.
- Status tidak dibedakan berdasarkan warna saja.
- Gunakan semantik HTML yang sesuai.
- Hormati `prefers-reduced-motion`.
- Jangan menambahkan animasi yang mengganggu pekerjaan berulang.
- Pesan error harus menjelaskan masalah dan langkah berikutnya jika memungkinkan.

Jangan membuat state success atau error palsu demi demo visual.

---

## 11. Data dan Konsistensi Akuntansi

Screenshot memperlihatkan periode Januari 2026, sementara transaksi yang terlihat bertanggal Desember 2023. Investigasi sebelum mengubah perilaku.

1. Periksa sumber data KPI, grafik, filter, dan tabel.
2. Telusuri parameter periode yang dikirim ke backend.
3. Pastikan format tanggal, timezone, dan agregasi sesuai implementasi yang berlaku.
4. Tentukan apakah transaksi historis memang sengaja ditampilkan atau terdapat masalah filter.
5. Jika perbedaan periode disengaja, tampilkan konteksnya secara eksplisit.
6. Jangan menghapus atau mengubah transaksi untuk membuat UI terlihat konsisten.
7. Jangan mengganti data produksi dengan mock data.
8. Jangan mengubah formula, saldo, atau definisi akuntansi sebagai bagian dari redesign visual.

---

## 12. Batasan Teknis dan Keamanan

- Pertahankan framework, routing, autentikasi, session, database, endpoint, dan API contracts.
- Pertahankan role dan authorization.
- Jangan hardcode nama pengguna, role, nominal finansial, atau statistik.
- Jangan melemahkan validasi dan keamanan.
- Jangan menambahkan dependency baru tanpa kebutuhan yang jelas.
- Gunakan komponen yang sudah tersedia bila sesuai.
- Jangan melakukan refactor besar yang tidak diperlukan.
- Jangan menimpa perubahan lokal yang sudah ada dan valid.
- Jangan menghapus fitur hanya karena belum sesuai dengan desain baru.
- Jika terdapat perubahan yang belum selesai, periksa terlebih dahulu sebelum mengedit file yang sama.

---

## 13. Urutan Implementasi

### Tahap 1 — Audit kondisi saat ini
- Periksa struktur project dan status perubahan.
- Identifikasi komponen dashboard dan shared shell.
- Temukan sumber overflow dan masalah alignment.
- Periksa data flow dan filter periode.
- Catat baseline build/test.

### Tahap 2 — Design system dan application shell
- Terapkan token warna, typography, spacing, border, dan komponen dasar.
- Redesign sidebar dan topbar.
- Pertahankan route dan perilaku menu.
- Perbaiki alignment serta overflow.

### Tahap 3 — Dashboard content
- Redesign page header dan filter.
- Redesign KPI.
- Perbaiki grafik dan legenda.
- Redesign tabel transaksi.
- Rapikan posisi aksi utama.

### Tahap 4 — Responsive dan accessibility
- Uji seluruh viewport yang ditentukan.
- Perbaiki navigasi mobile dan overflow.
- Uji keyboard, fokus, kontras, serta state komponen.

### Tahap 5 — Regression testing dan visual QA
- Uji navigasi, filter periode, transaksi, detail, ekspor, dan aksi relevan.
- Jalankan test, lint, dan build yang tersedia.
- Buka halaman hasil implementasi di browser atau alat screenshot yang tersedia.
- Bandingkan hasil aktual dengan tujuan desain.
- Perbaiki isu yang ditemukan sebelum menyatakan selesai.

Kerjakan bertahap dengan perubahan yang terukur. Jangan menghabiskan waktu membuat ulang seluruh proyek atau mengulang eksplorasi yang sudah selesai.

---

## 14. Acceptance Criteria

### Visual
- [ ] Tampilan tidak lagi terasa seperti template admin/SaaS generik.
- [ ] Hierarki visual jelas dan konsisten.
- [ ] Elemen dekoratif yang tidak berguna telah dikurangi.
- [ ] Sidebar, topbar, KPI, chart, dan tabel terasa sebagai satu sistem.
- [ ] Tidak ada elemen yang saling menimpa.

### Fungsi
- [ ] Seluruh menu yang sebelumnya berfungsi tetap berfungsi.
- [ ] Aksi Buat Transaksi tetap bekerja sesuai permission.
- [ ] Filter periode berfungsi sesuai aturan bisnis.
- [ ] Grafik dan tabel menggunakan data yang benar.
- [ ] Ekspor PDF dan fitur lain yang tersedia tetap berfungsi.
- [ ] Autentikasi, role, dan akses tidak berubah.

### Data
- [ ] Tidak ada angka atau tren palsu yang ditambahkan.
- [ ] Format angka dan mata uang konsisten.
- [ ] Ketidaksesuaian periode telah diperiksa dan dijelaskan atau diperbaiki dengan benar.

### Responsivitas dan aksesibilitas
- [ ] Semua viewport uji telah diperiksa.
- [ ] Tidak ada horizontal overflow yang tidak disengaja.
- [ ] Navigasi keyboard dan fokus bekerja.
- [ ] Kontras dan label kontrol memadai.

### Engineering
- [ ] Build selesai tanpa error baru.
- [ ] Tes yang relevan telah dijalankan.
- [ ] Tidak ada regresi yang diketahui pada alur utama.
- [ ] Hasil implementasi telah diperiksa secara visual.

---

## 15. Format Laporan Akhir Agent

Setelah implementasi, laporkan:

1. Ringkasan perubahan desain.
2. Daftar file yang diubah.
3. Fitur yang diuji dan hasilnya.
4. Status build dan test.
5. Masalah yang ditemukan serta cara penanganannya.
6. Hal yang belum selesai dan alasan spesifiknya.

Jangan mengklaim sebuah fitur berhasil diuji jika pengujian tersebut tidak benar-benar dilakukan.

**Instruksi final:** Mulai dengan memeriksa kondisi source code terkini. Lanjutkan dari perubahan valid yang sudah ada. Implementasikan redesign secara langsung, pertahankan seluruh perilaku bisnis, lalu verifikasi hasil aktual. Jangan berhenti setelah membuat rencana atau mockup.
