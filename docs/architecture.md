# معمارية المشروع

## النمط المستخدم: MVC التقليدي

```
Model  ← قاعدة البيانات (PDO + SQLite)
View   ← PHP + HTML (views/pages/)
Controller ← معالجة POST + redirect
```

---

## Core Classes

### `Database` — PDO Singleton
```php
$db = Database::getInstance(); // نفس الاتصال في كل مكان
```
- يدعم SQLite و MySQL بدون تغيير في باقي الكود
- يفعّل Foreign Keys تلقائياً في SQLite
- Singleton يمنع فتح اتصالات متعددة

---

### `Session` — إدارة الجلسات
```php
Session::requireLogin();          // حماية الصفحة
Session::flash('success', 'تم'); // رسالة تظهر مرة واحدة
Session::user();                  // بيانات المستخدم الحالي
```

**Flash Messages:**
تُخزَّن في `$_SESSION['_flash']` وتُحذَّف فور قراءتها — تُستخدم لإظهار رسائل النجاح/الخطأ بعد redirect.

---

### `BaseModel` — CRUD مشترك
كل Model يرث منه ويحدد `$table` و `$fillable` فقط:

```php
class Staff extends BaseModel {
    protected string $table    = 'staff';
    protected array  $fillable = ['name','university','experience'];
}

// الاستخدام
$staff = new Staff();
$staff->all();           // جلب الكل
$staff->find(5);         // جلب بالـ ID
$staff->create($data);   // إضافة
$staff->update(5, $data);// تعديل
$staff->delete(5);       // حذف
```

**`$fillable`:** يمنع Mass Assignment — فقط الحقول المذكورة تُحفظ في قاعدة البيانات.

---

## تدفق POST Request

```
1. المستخدم يضغط "حفظ" في الفورم
2. POST → controllers/router.php
3. router يقرأ $_POST['controller'] و $_POST['action']
4. يستدعي Controller المناسب
5. Controller يتحقق من البيانات
6. يستدعي Model لتنفيذ العملية
7. Session::flash('success', 'تم')
8. header('Location: ...') + exit
9. المتصفح يعيد تحميل الصفحة
10. flash message تظهر ثم تختفي
```

---

## تدفق GET Request

```
1. المستخدم يفتح /?page=students
2. index.php يتحقق من الجلسة
3. match($page) يحدد البيانات المطلوبة
4. Model يجلب البيانات من SQLite
5. $data تُمرَّر للـ view
6. views/pages/students.php يعرض البيانات
```

---

## الحماية

| الطبقة | الآلية |
|--------|--------|
| تسجيل الدخول | `password_hash` + `password_verify` |
| حماية الصفحات | `Session::requireLogin()` في كل صفحة |
| حماية POST | `Session::requireLogin()` في كل Controller |
| XSS | `htmlspecialchars()` على كل output |
| SQL Injection | PDO Prepared Statements في كل query |
| CSRF | (مخطط للمرحلة القادمة) |
