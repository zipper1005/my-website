# SIA AKN-IPB

SIA AKN-IPB (Sistem Informasi Akuntansi) adalah aplikasi berbasis web untuk mendukung pencatatan transaksi, pengelolaan jurnal, posting buku besar, dan penyusunan laporan keuangan.

## Fitur utama

- Pencatatan dan peninjauan transaksi.
- Jurnal umum dan jurnal penyesuaian.
- Posting buku besar dan neraca saldo.
- Chart of Accounts bertingkat.
- Laporan laba rugi, neraca, arus kas, perubahan ekuitas, dan neraca lajur.
- Dashboard ringkasan keuangan dan pemeriksaan keseimbangan debit-kredit.
- Pengelolaan pengguna sesuai peran.

## Teknologi

Aplikasi menggunakan CodeIgniter 4, PHP, Bootstrap/Stisla, dan database yang dikonfigurasi pada lingkungan aplikasi.

## Menjalankan aplikasi secara lokal

1. Pastikan PHP dan ekstensi yang dibutuhkan CodeIgniter 4 tersedia.
2. Pasang dependensi PHP dengan Composer.
3. Salin konfigurasi lingkungan dari `.env.example` jika tersedia, lalu sesuaikan pengaturan database dan URL lokal.
4. Siapkan database sesuai skema/migrasi/seed yang disediakan repository.
5. Jalankan server pengembangan CodeIgniter menggunakan `php spark serve`.

Jangan commit kredensial database, token, atau nilai rahasia lainnya. Gunakan konfigurasi lokal dan environment variables untuk nilai sensitif.

## Catatan

Angka pada dashboard ditampilkan berdasarkan data yang tersedia dalam aplikasi. Perubahan antarperiode hanya boleh ditampilkan jika perbandingan periode dihitung dari data sumber yang sesuai.
