# خطة الديمو والنشر

الاستضافة المقترحة
- Backend: Render أو Railway (Laravel + MySQL)
- Frontend/Landing: Vercel (Static)
- قاعدة البيانات: PlanetScale أو Neon (بديل MySQL/Postgres)
- التخزين: Cloudflare R2 أو S3

SouqPro
- بيئة `.env`: مفاتيح Stripe/PayPal، DB، بريد SMTP
- نشر Laravel: Dockerfile + Render Blueprint
- CDN للواجهة: Tailwind CDN أو بناء Mix/Vite

KhidmaPro
- بيئة `.env`: مفاتيح Stripe/PayPal، DB، بريد SMTP
- نشر Laravel: Dockerfile + Render Blueprint
- Webhooks للفواتير: Stripe

قوالب ملفات بيئة
```
# common
APP_NAME=ProductName
APP_ENV=production
APP_KEY=
APP_URL=
LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

STRIPE_KEY=
STRIPE_SECRET=
PAYPAL_CLIENT_ID=
PAYPAL_SECRET=
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="ProductName"
```
