# QuoteIt

A Laravel + Blade platform for sharing quotes. Guests can read; registered users can share, edit and delete their own quotes, and **like** quotes (extra feature).

## Run locally
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # default DB is SQLite (to use MySQL, edit DB_* in .env)
php artisan migrate --seed          # demo users: lujain@example.com / sara@example.com, password: password123
composer run dev                    # open http://localhost:8000
```

## Features
- View all quotes (guests included): text, author, date, like count
- Sign up (name 2–50 letters, email, password ≥ 8), log in, log out
- Share (3–155 chars), edit and delete own quotes only (403 for others)
- Extra: like / unlike (one like per user per quote), sort by Newest / Most liked
- Passwords hashed; CSRF on all forms; Blade layouts (`@extends`/`@yield`) and components

Schema: `database/migrations` (also `database/schema.sql`).
