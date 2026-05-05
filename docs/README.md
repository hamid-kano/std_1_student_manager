# نظام شؤون طلاب الجامعة

نظام ويب متكامل لإدارة شؤون الطلاب الجامعيين، مبني بـ PHP التقليدي مع SQLite.

---

## متطلبات التشغيل

| المتطلب | الإصدار |
|---------|---------|
| PHP     | 8.1+    |
| SQLite  | 3+      |
| XAMPP   | أي إصدار حديث |

---

## خطوات التشغيل

```bash
# 1. ضع المشروع في htdocs
C:/xampp/htdocs/std_1_student_manager/

# 2. أنشئ قاعدة البيانات
http://localhost/std_1_student_manager/database/migrate.php

# 3. زرع البيانات التجريبية (اختياري)
http://localhost/std_1_student_manager/database/seed.php

# 4. ادخل للنظام
http://localhost/std_1_student_manager/
```

**بيانات الدخول الافتراضية:**
- المستخدم: `admin`
- كلمة المرور: `admin123`

---

## هيكل المشروع

```
std_1_student_manager/
├── index.php                  ← نقطة الدخول الرئيسية
├── config/
│   ├── app.php                ← BASE_URL و ASSETS_URL
│   └── database.php           ← إعدادات قاعدة البيانات
├── app/
│   ├── bootstrap.php          ← تحميل كل الكلاسات
│   ├── Core/
│   │   ├── Database.php       ← PDO Singleton
│   │   ├── Session.php        ← إدارة الجلسات
│   │   └── BaseModel.php      ← CRUD مشترك
│   ├── Models/                ← 7 Models
│   └── Controllers/           ← 8 Controllers
├── controllers/
│   └── router.php             ← موجّه POST requests
├── views/
│   ├── layout/                ← header, sidebar, footer, flash
│   ├── auth/                  ← login
│   └── pages/                 ← 10 صفحات
├── assets/
│   ├── css/                   ← 6 ملفات CSS
│   ├── js/                    ← cards.js فقط (client-side)
│   └── images/
└── database/
    ├── schema.sql             ← تعريف الجداول
    ├── migrate.php            ← إنشاء الجداول
    ├── seed.php               ← بيانات تجريبية
    └── university.sqlite      ← ملف قاعدة البيانات
```

---

## تدفق الطلبات

```
GET  /?page=xxx
  └─► index.php
        ├─ Session::requireLogin()
        ├─ تحميل البيانات من Model
        └─ عرض views/pages/xxx.php

POST → controllers/router.php
  └─► Controller->handle()
        ├─ التحقق من البيانات
        ├─ تنفيذ العملية (Model)
        └─ Session::flash() + redirect
```

---

## التبديل إلى MySQL

في `config/database.php` فقط:

```php
// عطّل SQLite
// define('DB_DRIVER', 'sqlite');

// فعّل MySQL
define('DB_DRIVER', 'mysql');
define('DB_HOST',   'localhost');
define('DB_NAME',   'university_db');
define('DB_USER',   'root');
define('DB_PASS',   '');
define('DB_CHARSET','utf8mb4');
```
