# IstanbulSpice E-Ticaret

Laravel 10 tabanlı baharat e-ticaret sistemi. Türkçe, MySQL veritabanı kullanır.

## Kurulum

1. Veritabanı: `istanbulspice-eticaret` (MySQL)
2. `.env` dosyasında `DB_DATABASE=istanbulspice-eticaret` olmalı
3. Migration: `php artisan migrate`
4. Örnek veriler: `php artisan db:seed`

## Erişim

- **Site:** `http://localhost/istanbulspice/eticaret/public` veya ilgili URL
- **Admin:** `http://.../admin`
  - E-posta: `admin@istanbulspice.com`
  - Şifre: `12345678`
- **Test müşteri:** `musteri@test.com` / `12345678`

## Özellikler

### Frontend
- Anasayfa (hero, öne çıkan ürünler, kategoriler)
- Ürün listeleme (kategori filtresi, arama)
- Ürün detay (varyantlar, sepete ekleme)
- Sepet (session tabanlı)
- Ödeme (giriş gerekli)
- Hesabım (siparişler, adresler, favoriler)
- İletişim

### Admin
- Dashboard (istatistikler, son siparişler)
- Ürün CRUD
- Kategori CRUD
- Sipariş yönetimi (durum güncelleme)
- Kullanıcı listesi
- Kupon CRUD
- Site ayarları

## Teknolojiler

- Laravel 10
- PHP 8.1+
- MySQL
- Tailwind CSS (CDN)
- Breeze (auth)

## Not

- Otomatik deploy webhook testi icin guncellendi.
- Webhook push testi 2026-03-25 19:58 icin yenilendi.
