<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Laravel

### To launch app:

1. first create .env file:

```bash
cp .env.example .env
```

2. Then launch with docker:

```bash
docker compose up -d
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
```

3. App is now available on:

```
http://localhost:8000/
```

with endpoints:

```
http://localhost:8000/api/products
```
```
http://localhost:8000/api/recommendations/1
```

---

Run tests with:

```bash
docker compose exec app php artisan test
```
