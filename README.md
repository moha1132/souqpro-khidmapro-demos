[![Deploy to Render](https://render.com/images/deploy-to-render-button.svg)](https://render.com/deploy?repo=https://github.com/moha1132/souqpro-khidmapro-demos)

# SouqPro & KhidmaPro — Demos

- SouqPro: Laravel 12, Breeze, RTL, Products CRUD, SQLite + start.sh + Dockerfile
- KhidmaPro: Laravel 12, Breeze, RTL, Services/Bookings/Invoices CRUD, Roles (admin/pro), Stripe stubs, SQLite + start.sh + Dockerfile

Demo creds
- KhidmaPro: admin@example.com / password, pro@example.com / password
- SouqPro: admin@example.com / password

Local run (either app)
```
php artisan serve
```
Deployment
- Use render.yaml blueprint (two services: souqpro-app, khidmapro-app)
- Each app has start.sh and Dockerfile ready

GitHub
- Authenticate: `gh auth login`
- Create/push: `~/sellable-kits/scripts/setup_github.sh`
