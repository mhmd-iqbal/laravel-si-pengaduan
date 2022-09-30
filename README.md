# Sistem Informasi Pengaduan Kerusakan Barang

Aplikasi web ini adalah project skripsi client buatan orisinil saya sendiri menggunakan laravel 8.

## Run Locally

Clone project

```bash
  git clone https://github.com/mhmd-iqbal/laravel-si-pengaduan.git
```

Masuk ke folder project

```bash
  cd laravel-si-pengaduan
```

Install dependencies

```bash
  composer install
```


## Installation

Tahapan instalasi :

1.  Copy file .env.example menjadi .env
```
cp .env.example .env
```

2.  Buka file .env, lakukan beberapa konfigurasi di bagian
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306 // sesuaikan dengan port mysql anda
DB_DATABASE=laravel_pengaduan // nama database bebas sesuai dengan yang anda buat
DB_USERNAME=root // sesuaikan dengan username mysql anda
DB_PASSWORD= // sesuaikan dengan password mysql anda
```

3.  Jalankan command dibawah untuk mengenerate APP_KEY
```
php artisan key:generate
```

4.  Jalankan command untuk melakukan migration dan seeding ke dalam database yang sudah dibuat
```
php artisan migrate:fresh --seed
```

5.  Semua tahapan di atas jika sudah pernah dilakukan, cukup 1x saja tidak perlu diulang untuk selanjutnya. Kalau sudah mengikuti semua tahapan diatas, tinggal jalankan command dibawah untuk running web servernya
```
php artisan serve
```

6.  Informasi user untuk login ke dalam aplikasi dapat dilihat pada
> app/database/seeders/UserSeeder.php

## Authors

- [GitHub : @mhmd-iqbal](https://www.github.com/mhmd-iqbal)
- [Instagram : @mhmd.iqbaale_](https://www.instagram.com/mhmd.iqbaale_)


## License

[Apache 2.0](https://choosealicense.com/licenses/apache-2.0/)

