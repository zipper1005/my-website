# PANDUAN LENGKAP HOSTING & UPLOAD APLIKASI AKUNTANSI (SIA AKN-IPB)
## Domain: https://siarajib.software
### Berdasarkan Video Tutorial #20 (Hosting dan Upload)

---

## 📋 DAFTAR FILE PENDUKUNG YANG SUDAH DISIAPKAN:
1. **`aabw_database.sql`**: Dump database terbaru dari database lokal MySQL XAMPP lengkap dengan seluruh tabel transaksi, akun, jurnal penyesuaian, dan user authentication.
2. **`.env.production`**: File konfigurasi environment produksi yang sudah disetting untuk domain `https://siarajib.software/`.

---

## 🛠️ LANGKAH 1: PERSIAPAN DATABASE DI cPANEL
1. Buka cPanel hosting Anda (biasanya `https://siarajib.software:2083` atau melalui dashboard penyedia hosting).
2. Masuk ke menu **MySQL® Database Wizard** atau **MySQL Databases**.
3. **Step 1 - Buat Database**:
   - Beri nama database, misalnya: `aabw` (hasilnya akan seperti `usernamecp_aabw`).
   - Klik **Next Step**.
4. **Step 2 - Buat Database User**:
   - Buat username, misalnya: `dbuser` (hasilnya seperti `usernamecp_dbuser`).
   - Buat password yang kuat (simpan password ini).
   - Klik **Create User**.
5. **Step 3 - Atur Hak Akses**:
   - Centang **ALL PRIVILEGES**.
   - Klik **Make Changes / Next Step**.
6. **Step 4 - Import Data SQL**:
   - Kembali ke dashboard cPanel, buka **phpMyAdmin**.
   - Di panel sebelah kiri, klik nama database baru yang tadi dibuat (`usernamecp_aabw`).
   - Klik tab **Import** di bagian atas.
   - Klik **Choose File** dan pilih file **`aabw_database.sql`** yang ada di folder proyek ini.
   - Klik tombol **Go / Kirim** di bagian bawah. Tunggu hingga muncul notifikasi sukses berwarna hijau.

---

## 📁 LANGKAH 2: UPLOAD SOURCE CODE KE HOSTING

### METODE TERBAIK (SANGAT DIREKOMENDASIKAN & AMAN):
Metode ini memisahkan file sistem dari `public_html` agar file konfigurasi database dan `.env` tidak bisa diakses publik/hacker.

1. **Kompres File Proyek**:
   - Di komputer lokal, kompres seluruh isi folder `aabw` menjadi file `.zip` (misal: `aabw.zip`).
   *(Catatan: Jangan ikutkan folder `.git` jika ada).*

2. **Upload ke File Manager cPanel**:
   - Buka **File Manager** di cPanel.
   - Posisi awal ada di `/home/username/`.
   - Buat folder baru sejajar dengan `public_html`, beri nama misalnya **`aabw`** (path lengkap: `/home/username/aabw`).
   - Masuk ke folder `aabw`, lalu klik **Upload** dan upload file `aabw.zip`.
   - Setelah upload selesai (100% hijau), klik kanan file `aabw.zip` dan pilih **Extract**.
   - Ubah nama file `.env.production` menjadi **`.env`**.
   - Edit file **`.env`** tersebut, sesuaikan bagian database:
     ```ini
     database.default.hostname = localhost
     database.default.database = usernamecp_aabw
     database.default.username = usernamecp_dbuser
     database.default.password = PasswordDatabaseAndaTadi
     ```

3. **Pindahkan Isi Folder `public` ke `public_html`**:
   - Masuk ke `/home/username/aabw/public/`.
   - Pilih semua file dan folder di dalamnya:
     - `index.php`
     - `.htaccess`
     - folder `template/`
     - `favicon.ico`, `robots.txt`
   - Klik menu **Move** dan pindahkan tujuannya ke **`/public_html/`**.

4. **Edit File `public_html/index.php`**:
   - Buka folder `/public_html/`, klik kanan file **`index.php`** lalu pilih **Edit**.
   - Cari baris:
     ```php
     require FCPATH . '../app/Config/Paths.php';
     ```
   - Ubah menjadi:
     ```php
     require FCPATH . '../aabw/app/Config/Paths.php';
     ```
   - Klik **Save Changes**.

---

## 🔒 LANGKAH 3: AKTIFKAN SSL (HTTPS)
1. Di cPanel, cari menu **SSL/TLS Status** atau **Let's Encrypt SSL**.
2. Pilih domain **`siarajib.software`** dan **`www.siarajib.software`**.
3. Klik tombol **Run AutoSSL** atau **Issue SSL**.
4. Tunggu beberapa menit hingga icon gembok berwarna hijau aktif.

---

## ⚙️ LANGKAH 4: PASTIKAN VERSI PHP & EXTENSION SERVER COCOK
1. Di cPanel, buka menu **MultiPHP Manager** atau **Select PHP Version**.
2. Pilih domain **`siarajib.software`**.
3. Set versi PHP ke **PHP 8.2** atau **PHP 8.3** (sesuai kebutuhan CodeIgniter 4.7).
4. Pastikan ekstensi PHP berikut aktif di **PHP Extensions**:
   - `intl` (Wajib untuk format tanggal & angka CI4)
   - `mbstring`
   - `mysqli`
   - `curl`
   - `json`
   - `fileinfo`

---

## 🛡️ LANGKAH 5: PERMISSION FOLDER WRITABLE (PENTING!)
Folder `writable/` digunakan oleh CodeIgniter untuk menyimpan session user, cache, dan log error:
1. Di cPanel File Manager, klik kanan folder **`writable`** (lokasinya ada di `/home/username/aabw/writable/`).
2. Pilih **Change Permissions**.
3. Pastikan permission diset ke **775** atau **777** agar server bisa menulis session login dan log.
4. Lakukan hal yang sama untuk subfolder di dalamnya:
   - `writable/session/`
   - `writable/logs/`
   - `writable/cache/`

---

## 💡 TROUBLESHOOTING UMUM:
* **Error 500 (Internal Server Error)**:
  - Cek versi PHP di cPanel (pastikan minimal PHP 8.2).
  - Cek apakah extension `intl` sudah dicentang/aktif.
  - Buka file `/home/username/aabw/writable/logs/log-tanggal.log` untuk melihat detail error.
* **Error 404 pada URL selain Home**:
  - Pastikan file `.htaccess` di dalam `public_html/` sudah ter-upload (file yang diawali titik `.` kadang tersembunyi; klik tombol *Settings* di kanan atas cPanel File Manager dan centang *Show Hidden Files / dotfiles*).
* **CSS / Gambar tidak muncul**:
  - Pastikan folder `template/` sudah dipindahkan ke dalam `public_html/`.
  - Pastikan `app.baseURL = 'https://siarajib.software/'` di file `.env` sudah benar dengan akhiran garis miring `/`.

---

## 🚀 PENGUJIAN FINAL
Buka browser dan akses:
👉 **`https://siarajib.software/`**

Aplikasi SIA AKN-IPB siap digunakan secara online di domain Anda!

