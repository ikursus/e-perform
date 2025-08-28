# E-Perform Laravel Application

Panduan lengkap untuk setup dan pembangunan aplikasi Laravel.

## 1. Sediakan Tools Asas

### VS Code Extensions
- Laravel Extension Pack
- PHP Intelephense
- Namespace Resolver
- GitHub Copilot (jika guna)

### Development Tools
- **Git** (version control)
- **Laragon** (senang, all-in-one) atau **Laravel Herd + DBngin**
- **Database client**: HeidiSQL atau DBeaver
- **Composer** (untuk Laravel dependency)

## 2. Cipta Projek Laravel

### Menggunakan Laragon
1. Laragon → Quick App → Laravel → pilih nama projek
2. Buat database kosong di HeidiSQL/DBeaver
3. Edit fail `.env` → masukkan nama DB, username & password
4. Jalankan migrasi asas: `php artisan migrate`

### Menggunakan Herd
1. Herd → New Site → Laravel
2. Buat database kosong di HeidiSQL/DBeaver
3. Edit fail `.env` → masukkan nama DB, username & password
4. Jalankan migrasi asas: `php artisan migrate`

## 3. Strukturkan Modul (contoh: Order)

Bila nak wujudkan fungsi simpan rekod (apa-apa modul), flow asas:

### Database
- Rancang jadual (fields yang perlu)
- Buat migration → jalankan migrate

### Model
- Buat model & tetapkan field yang boleh diisi

### Routes
- Daftarkan route (create, store, index, show, dll)

### Controller
- Guna command `make:controller` → tambah method (index, create, store, show)
- Dalam method store, validasi input & simpan ke DB

### Form Request (opsyenal tapi best practice)
- Buat class request untuk rules validasi

### View (Blade)
- Sediakan borang input (guna Bootstrap/custom CSS)
- Paparkan error validasi & mesej berjaya

### Testing
- Isi borang → submit → rekod sepatutnya wujud dalam DB
- Semak senarai (index) & paparan (show)

## 4. Ulang Untuk Modul Lain

Bila nak buat modul lain (contoh: Produk, Pelanggan, Invoice), ulang proses sama:

1. Buat migration + model
2. Tambah controller & route
3. Sediakan blade form + list
4. Validasi + simpan

## 5. Tambahan (Opsyenal)

- **Auth**: pasang Laravel Breeze (Blade)
- **Seeder & Factory**: untuk hasilkan dummy data
- **Flash message**: letakkan alert dalam layout utama
- **Pagination & Search**: guna query builder atau Eloquent
- **Relasi**: jika modul saling berkait (cth: Order ada Order Items)

## 📌 Ringkasnya:

1. **Install tools** → Setup projek Laravel → Setup DB
2. **Buat migration** → model → controller → routes → blade
3. **Buat form** → validasi → simpan data → tunjuk senarai & detail
4. **Ulang proses** untuk setiap modul sistem

## Modul Yang Tersedia

Aplikasi ini mengandungi modul-modul berikut:

- **User Holdings** - Pengurusan portfolio pelaburan
- **Digitalization** - Pengurusan data digitalisasi
- **Internet Connections** - Pengurusan sambungan internet
- **Cyber Attacks** - Pengurusan data serangan siber

## Cara Menjalankan Aplikasi

1. Clone repository ini
2. Jalankan `composer install`
3. Salin `.env.example` kepada `.env`
4. Set konfigurasi database dalam `.env`
5. Jalankan `php artisan key:generate`
6. Jalankan `php artisan migrate`
7. Jalankan `php artisan serve` atau guna Laragon, pastikan Start All

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
