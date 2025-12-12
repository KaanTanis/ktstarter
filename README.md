# KT Starter Kit

Laravel 12, Filament 4, Livewire 3 ve Tailwind 4 üzerine kurulmuş, SEO dostu ve çok dilli hazır bir başlangıç kiti. Post (haber/blog) içerik yönetimi, sayfa yönetimi, yönlendirme, bakım modu ve form toplama özellikleriyle üretime yakın bir temel sağlar.

## Neler Hazır?
- Filament paneli ile **blog**, **sayfa**, **ayar** ve **kullanıcı/rol** yönetimi (Shield entegre)
- Çoklu dil (LaravelLocalization) + locale switcher helper'ı
- SEO & sosyal meta (SEOTools), sitemap üretimi, slug ve görüntülenme sayacı
- URL yönlendirme ve bakım modu middleware'leri
- İletişim/abonelik formları + hız sınırlama + bildirimler
- Cookie/Privacy modalları, temel layout bileşenleri (ihtiyaca göre özelleştirilebilir)

## Teknoloji Yığını
- Backend: Laravel 12, Filament 4, Livewire 3, Filament Shield, Spatie Sluggable & Sitemap, Eloquent Viewable, Intervention Image
- Frontend: Vite, TailwindCSS 4, DaisyUI, Alpine.js, GSAP, Splide, Fancybox

## Kurulum (Geliştirme)
```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate --seed   # admin, sayfa ve ayarlar gelir
npm run dev                  # Vite
php artisan serve            # API/Frontend
```

### Hızlı kurulum (tek komut)
```bash
chmod +x local_install.sh
./local_install.sh
```
> Not: Script `.env.example` dosyasını taşır (varsa mevcut .env yedekleyin), sqlite kurar, migrate/seed ve build adımlarını çalıştırır.

### Varsayılan Girişler (Filament admin)
- URL: `/admin`
- Süper admin: `admin@mail.com` / `12345678`

## Kullanışlı Komutlar
- Sitemap üret: `php artisan app:generate-sitemap`
- Post görüntülenme sayısını güncelle: `php artisan app:update-post-views-count`
- Cron/Schedule: `routes/console.php` içinde (sitemap günlük, views 30 dk)

## Yapı Taşları
- Helper: `getLocalizedUrl($locale, $path = null)` — locale switcher için
- Sayfa controller: `PageController` slug üzerinden Filament Fabricator sayfalarını render eder, görüntülenme kaydeder ve SEO yükler
- Middleware: `MaintenanceMiddleware`, `RedirectMiddleware`
- SEO servisleri: `App\Services\Seo\*`
- Blade bileşenleri: `resources/views/components/layouts/*.blade.php`, `banner`, `menu`, `modals`, `preloader`, Livewire formları

## Ortam Ayarları
- `APP_URL`, `APP_LOCALE`, `APP_FALLBACK_LOCALE`
- Mail hedefi: `mail.from.address` veya Settings içindeki `contact_mail`, `contact_mail_cc`
- Cache/Queue için Redis önerilir; yoksa `.env` ile file cache kullanabilirsiniz.

## Test & Kalite
- PHPUnit hazır (`php artisan test`)
- PHPStan yapılandırması: `phpstan.neon`
- Kod stili: `./vendor/bin/pint`

## Üretim Notları
- Derleme: `npm run build`
- Önbellek: `php artisan config:cache && php artisan route:cache`
- Cron: `php artisan schedule:work` veya sistem cron ile `php artisan schedule:run`
- Dosyalar: `php artisan storage:link` ve CDN/S3 entegrasyonlarını kullanabilirsiniz.

## Lisans
MIT License

## Website
- [Kaan Tanış](https://kaantanis.com)
- [Cacto Art](https://cacto.art)