# Wisata Nusantara

Laravel application untuk menampilkan informasi budaya dan wisata dari 38 provinsi di Indonesia.

## 🚀 Quick Start

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Start development server
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📁 Project Structure

```
projek-2/
├── app/
│   ├── Http/Controllers/Api/    # API Controllers
│   └── Models/                   # Eloquent Models
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── public/
│   └── images/                  # Uploaded images
│       ├── provinces/
│       ├── tradisi/
│       ├── wisata/
│       └── kuliner/
├── resources/views/             # Blade templates
└── routes/
    ├── api.php                  # API routes
    └── web.php                  # Web routes
```

## 🛠️ Utilities

### Database & Image Management
```bash
php utilities.php
```
Menu options:
1. Check Database Status - View all data counts
2. Verify All Images - Check image coverage
3. Export Data - Backup database to JSON
4. Quick Stats - Overall statistics

### Image Generation (if needed)
```bash
php generate_tradisi_images.php   # Generate tradisi images
php generate_all_images_master.php # Generate all category images
```

## 📊 Database Models

- **Province** - 38 provinsi Indonesia
- **Tradisi** - Tradisi budaya per provinsi
- **Wisata** - Destinasi wisata per provinsi
- **Kuliner** - Kuliner khas per provinsi
- **Peraturan** - Peraturan daerah per provinsi

## 🔌 API Endpoints

See `API_TESTING_GUIDE.md` or import `Wisata_Nusantara_API.postman_collection.json` to Postman.

Base URL: `http://localhost:8000/api/v1`

### Main Endpoints:
- `GET /provinces` - List all provinces
- `GET /provinces/{id}` - Province details
- `GET /provinces/{id}/tradisi` - Tradisi by province
- `GET /provinces/{id}/wisata` - Wisata by province
- `GET /provinces/{id}/kuliner` - Kuliner by province
- `GET /provinces/{id}/peraturan` - Peraturan by province

## 🎨 Frontend Views

- Homepage: `/` - Grid of all provinces
- Province Detail: `/provinces/{id}` - Province page with categories
- Category Pages: `/provinces/{id}/tradisi`, `/wisata`, etc.

## 📝 Development Notes

- Using Laravel 10.x
- MySQL database
- Image storage in `public/images/`
- API responses in JSON format
- Blade templating for views

## 🔧 Admin Panel

Filament admin panel available at `/admin`

Default credentials (if seeded):
- Email: admin@wisatanusantara.com
- Password: (check seeder)

---

For detailed API documentation, see `API_TESTING_GUIDE.md`
