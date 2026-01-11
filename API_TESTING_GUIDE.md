# API Testing - Quick Guide

## Main File

**`test_api_master.php`** - Comprehensive API tester untuk semua endpoints.

## Usage

### Run All Tests
```bash
php test_api_master.php
```

Script akan otomatis:
- ✅ Test GET endpoints (provinces)
- ✅ Test POST endpoints (peraturan, wisata, tradisi, kuliner)
- ✅ Menggunakan province_id yang valid dari database
- ✅ Generate detailed report
- ✅ Save results ke `api_test_results.txt`

## What It Tests

1. **GET /api/provinces** - Get all provinces
2. **GET /api/provinces/{id}** - Get single province
3. **POST /api/peraturan** - Create peraturan
4. **POST /api/wisata** - Create wisata
5. **POST /api/tradisi** - Create tradisi
6. **POST /api/kuliner** - Create kuliner

## Output

Hasil test disimpan di: **`api_test_results.txt`**

Format output:
- HTTP status code
- Response type (JSON ✓ or HTML ✗)
- Full response body
- Summary statistics

## Customization

Edit file `test_api_master.php` untuk:
- Tambah test endpoints baru
- Ubah test data
- Customize output format

## Expected Results

✅ **All tests should return:**
- Status: 200-201
- Response Type: JSON ✓
- Success: ✅

❌ **If you see HTML responses:**
- Check headers (Accept: application/json)
- Verify province_id exists in database
- Check Laravel logs

## Tips

- Pastikan Laravel server running: `php artisan serve`
- Check database sebelum run test
- Review `api_test_results.txt` untuk detailed info
