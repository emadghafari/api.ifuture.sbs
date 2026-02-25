# iFuture Hub - Hostinger Deployment Guide

This guide outlines the steps required to deploy the **iFuture Hub** application seamlessly to a Hostinger shared or VPS hosting environment.

## 1. Backend (Laravel 12) Deployment

### File Transfer
1.  Zip your entire `backend` directory (excluding `vendor` and `node_modules`).
2.  Upload the zip file via Hostinger File Manager to your desired subdomain/folder (e.g., `api.ifuture.sbs`).
3.  Extract the files.

### Database Setup
1.  In the Hostinger hPanel, create a new MySQL Database and Database User.
2.  Import your local database (if any) using phpMyAdmin, or prepare to run migrations.

### Environment Configuration (.env)
1.  Rename `.env.example` to `.env`.
2.  Update the critical variables:
    ```env
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://api.ifuture.sbs
    FRONTEND_URL=https://ifuture.sbs
    SANCTUM_STATEFUL_DOMAINS=ifuture.sbs,www.ifuture.sbs
    
    DB_DATABASE=your_hostinger_db_name
    DB_USERNAME=your_hostinger_db_user
    DB_PASSWORD=your_hostinger_db_pass
    
    SESSION_DOMAIN=.ifuture.sbs
    ```

### Execution
1.  Connect via SSH (available in Hostinger VPS or Premium Shared Hosting).
2.  Navigate to the backend directory: `cd public_html/api`
3.  Run Composer: `composer install --optimize-autoloader --no-dev`
4.  Run Migrations: `php artisan migrate --force`
5.  Link Storage: `php artisan storage:link`
6.  Cache Configs: `php artisan optimize`

*(If SSH is unavailable, you can run migrations via web routes or export the local DB and import it).*

---

## 2. Frontend (Next.js 14) Deployment

Since Next.js requires Node.js, ensure your Hostinger plan supports Node.js (VPS or specialized Node plans). If using shared hosting, you must export the Next.js app statically, but since we rely on server API calls, a Node.js server is required.

### Updating API URLs
Before building, update the API routes in your Next.js application:
1.  All instances of `http://localhost:8000` must be replaced with `https://api.ifuture.sbs`.
2.  Configure your `axios`/`fetch` base URLs.

### Build and Transfer
1.  On your local machine, run: `npm run build`
2.  Zip the Next.js project folder (including `.next`, `package.json`, and `public`, but excluding `node_modules`).
3.  Upload and extract via Hostinger File Manager to your main domain (e.g., `public_html`).

### Running the Node Server
1.  Connect via SSH to your host.
2.  Navigate to your frontend directory.
3.  Install dependencies: `npm install --production`
4.  Start the Next.js server using a process manager like PM2:
    ```bash
    npm install -g pm2
    pm2 start npm --name "ifuture-frontend" -- start
    pm2 save
    ```

## Post-Deployment Checklist
- [ ] Configure Hostinger SSL certificates for both `ifuture.sbs` and `api.ifuture.sbs`.
- [ ] Verify CORS functionality by logging into the Admin CMS.
- [ ] Access the `/admin/dashboard` to verify data flow.
