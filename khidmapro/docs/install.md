# KhidmaPro — التثبيت المحلي

المتطلبات
- PHP 8.2+
- Composer 2.x
- MySQL 8.x
- Node.js 18+

الخطوات
1) نسخ المتغيرات
```
cp .env.example .env
```
2) إعداد قاعدة البيانات في `.env`
```
DB_DATABASE=khidmapro
DB_USERNAME=root
DB_PASSWORD=secret
```
3) تثبيت الاعتمادات
```
composer install --no-dev --prefer-dist
php artisan key:generate
php artisan migrate --seed
```
4) بناء الواجهات (اختياري)
```
npm install
npm run build
```
5) تشغيل الخادم
```
php artisan serve
```

حسابات تجريبية
- المدير: admin@example.com / password
- مستقل: pro@example.com / password

ملاحظات
- لتفعيل RTL: القوالب مهيأة بـ Tailwind RTL مسبقاً.
- التخزين المؤقت: يوصى باستخدام Redis للإنتاج.
