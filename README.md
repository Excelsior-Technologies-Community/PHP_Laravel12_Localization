# PHP_Laravel12_Localization

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel">
  <img src="https://img.shields.io/badge/Localization-Multi--Language-blue?style=for-the-badge">
  <img src="https://img.shields.io/badge/I18N-Support-success?style=for-the-badge">
</p>

---

##  Overview
Laravel provides a powerful **Localization System (I18N)** that helps you translate your application into multiple languages.

This documentation demonstrates:

✔ Multi-language support (English, French, German)  
✔ Creating language files  
✔ Creating localization controller  
✔ Route-based language selection  
✔ Testing translations  

###  Supported Languages

| Language | Code |
|----------|------|
| 🇬🇧 English | `en` |
| 🇫🇷 French  | `fr` |
| 🇩🇪 German  | `de` |
---

##  Features
- Multi-language support (EN, FR, DE)
- Dynamic locale switching
- Simple translation structure
- Fallback locale support
- Works with Blade, Controllers & Routes

---

#  Folder Structure
```
resources/
└── lang/
     ├── en/
     │    └── lang.php
     ├── fr/
     │    └── lang.php
     └── de/
          └── lang.php

app/
└── Http/
     └── Controllers/
          └── LocalizationController.php

routes/
└── web.php

.env
README.md
```

---

#  Step 1 — Install Laravel
```bash
composer create-project laravel/laravel LaravelLocalization
cd LaravelLocalization
```

---

#  Step 2 — Configure .env
```
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
```

---

#  Step 3 — Create Language Files

## 🇬🇧 English (en)
 `resources/lang/en/lang.php`
```php
<?php

return [
    'msg' => 'Laravel Internationalization example.'
];
```

## 🇫🇷 French (fr)
 `resources/lang/fr/lang.php`
```php
<?php

return [
    'msg' => 'Exemple Laravel internationalisation.'
];
```

## 🇩🇪 German (de)
 `resources/lang/de/lang.php`
```php
<?php

return [
    'msg' => 'Laravel Internationalisierung Beispiel.'
];
```

---

#  Step 4 — Create Localization Controller

 `app/Http/Controllers/LocalizationController.php`
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request, $locale)
    {
        // Set application locale
        app()->setLocale($locale);

        // Return translated text
        return trans('lang.msg');
    }
}
```

---

#  Step 5 — Add Route

 `routes/web.php`
```php
use App\Http\Controllers\LocalizationController;

Route::get('localization/{locale}', [LocalizationController::class, 'index']);
```

Supported languages:  
✔ en  
✔ fr  
✔ de  

---

#  Step 6 — Start Server
```bash
php artisan serve
```

---

#  Step 7 — Test in Browser

### 🇬🇧 English  
URL:
```
http://127.0.0.1:8000/localization/en
```
Output:
```
Laravel Internationalization example.
```
<img width="418" height="97" alt="Screenshot 2025-12-10 171006" src="https://github.com/user-attachments/assets/8d91fa6d-0cd4-4206-bf98-8810ef38784b" />


### 🇫🇷 French  
URL:
```
http://127.0.0.1:8000/localization/fr
```
Output:
```
Exemple Laravel internationalisation.
```
<img width="391" height="103" alt="Screenshot 2025-12-10 171013" src="https://github.com/user-attachments/assets/59dc1775-c6ab-47f8-b771-6a2782360178" />


### 🇩🇪 German  
URL:
```
http://127.0.0.1:8000/localization/de
```
Output:
```
Laravel Internationalisierung Beispiel.
```
<img width="385" height="98" alt="Screenshot 2025-12-10 171022" src="https://github.com/user-attachments/assets/eac080d1-2bac-4997-a2ed-6bce6e049705" />


---

#  Localization Working Successfully!
Your localization system is now:

✔ Multi-language ready  
✔ Easy to expand  
✔ Works in routes, controllers, views  

---


