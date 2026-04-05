# Cara Update ke Server (Batik VPS)

Setiap kali ada pembaruan di komputermu (misal: tambah fitur, ubah desain HTML, atau instal *package* baru), lakukan langkah ini:

## Langkah 1: Push dari Komputermu (Lokal)
Buka terminal di komputermu, dan jalankan:
```bash
git add .
git commit -m "Update fitur blablabla"
git push origin main
```

---

## Langkah 2: Pull & Terapkan di Server (VPS)
Masuk (SSH) ke servermu, pindah ke folder proyek `kumpulan-kisi-kisi`, lalu jalankan baris-baris perintah ini:

1. **Tarik pembaruan:**
```bash
git pull origin main
```

2. **Lakukan Optimasasi & Pembaruan Sistem (Docker Exec):**
```bash
# Jika ada install package (vendor) Composer baru:
docker exec kumpulan_kisi_app composer install --no-dev --optimize-autoloader

# Membersihkan cache lama (Penting saat update route / views / config):
docker exec kumpulan_kisi_app php artisan optimize:clear

# Refresh cache baru (Opsional untuk buat website melesat lagi):
docker exec kumpulan_kisi_app php artisan config:cache
docker exec kumpulan_kisi_app php artisan route:cache
docker exec kumpulan_kisi_app php artisan view:cache

# (Wajib jika update-mu tadi mengandung database migration/tabel baru)
docker exec kumpulan_kisi_app php artisan migrate --force
```

3. **Pastikan file permission aman (Opsional, tapi jika bermasalah log bisa dijalankan ulang):**
```bash
docker exec kumpulan_kisi_app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

Jika tidak ada update *framework composer*, langkah paling kritis untuk update kode-kode saja cukup `git pull origin main` dan `php artisan optimize:clear` sudah langsung teraplikasi di server loh.
