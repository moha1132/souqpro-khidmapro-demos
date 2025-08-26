# دليل الرجوع السريع — SouqPro & KhidmaPro (Alafasi)

المستودع: https://github.com/moha1132/souqpro-khidmapro-demos
الجذر المحلي: ~/sellable-kits
أرشيف التسليم: ~/sellable-kits-demo.zip

تشغيل محلي
- SouqPro: cd ~/sellable-kits/souqpro-app && php artisan serve
- KhidmaPro: cd ~/sellable-kits/khidmapro-app && php artisan serve

Render (Blueprint)
- نشر جاهز: https://render.com/deploy?repo=https://github.com/moha1132/souqpro-khidmapro-demos
- تفعيل Auto-deploy من صفحة الـ Blueprint عند الحاجة

دخول الديمو
- KhidmaPro: admin@example.com / password, pro@example.com / password
- SouqPro: admin@example.com / password

Stripe (KhidmaPro)
1) مفاتيح API: https://dashboard.stripe.com/apikeys → STRIPE_KEY=sk_test_...
2) Webhook: https://dashboard.stripe.com/webhooks
   - Endpoint: https://YOUR-KHIDMAPRO-DOMAIN/payments/webhook
   - Event: checkout.session.completed
   - ضع STRIPE_WEBHOOK_SECRET=whsec_...
3) بطاقات اختبار: https://stripe.com/docs/testing (4242 4242 4242 4242)

SMTP (كلا الخدمتين)
- مثال Brevo: https://app.brevo.com/settings/keys/smtp
- المتغيرات: MAIL_MAILER=smtp, MAIL_HOST, MAIL_PORT=587, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION=tls, MAIL_FROM_ADDRESS, MAIL_FROM_NAME

قاعدة البيانات
- افتراضي: SQLite (يُعاد تهيئته عند الإقلاع)
- Postgres (اختياري): https://render.com/docs/databases
  DB_CONNECTION=pgsql, DB_HOST, DB_PORT=5432, DB_DATABASE, DB_USERNAME, DB_PASSWORD

الدومينات
- الإعداد: https://render.com/docs/custom-domains
- DNS: www → CNAME إلى *.onrender.com، الجذر @ → ALIAS/ANAME أو 301 إلى www

GitHub
- دفع تعديلات: cd ~/sellable-kits && git add -A && git commit -m "update" && git push
- سكربت تجهيز الريبو (موجود): ~/sellable-kits/scripts/setup_github.sh

منجزات أساسية
- SouqPro: Products CRUD RTL
- KhidmaPro: Services/Bookings/Invoices CRUD، أدوار admin/pro، لوحة إدارة، Stripe Checkout + Webhook
- صفحات هبوط RTL + نظام تصميم، دعم Postgres/SQLite، نشر Render جاهز
