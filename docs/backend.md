# Backend — Controllers & Models

## Controllers

كل Controller يحتوي على دالة `handle()` تقرأ `$_POST['action']` وتوجّه للدالة المناسبة.

### النمط المشترك

```php
public function handle(): void
{
    Session::requireLogin();          // حماية إلزامية
    match($_POST['action'] ?? '') {
        'store'  => $this->store(),
        'update' => $this->update(),
        'delete' => $this->delete(),
        default  => header("Location: ...") & exit
    };
}
```

---

### `AuthController`
| Action | الوصف |
|--------|-------|
| `login` | التحقق من username/password ثم تعيين الجلسة |
| `logout` | تدمير الجلسة والتوجيه لصفحة الدخول |

**منطق تسجيل الدخول:**
```php
$user = $db->prepare("SELECT * FROM users WHERE username = ?");
if (!$user || !password_verify($password, $user['password'])) {
    // خطأ
}
Session::set('user', [...]);
```

---

### `StudentController`
| Action | الوصف |
|--------|-------|
| `store` | تسجيل طالب جديد مع رفع الصورة |
| `update` | تعديل بيانات طالب موجود |
| `delete` | حذف طالب نهائياً |
| `toggle_status` | تبديل الحالة بين منتظم/موقوف |

**رفع الصورة:**
```php
// يحفظ الصورة في assets/uploads/students/
$filename = uniqid('student_') . '.' . $ext;
move_uploaded_file($file['tmp_name'], $dir . $filename);
```

---

### `GradeController`
| Action | الوصف |
|--------|-------|
| `store` | إضافة علامة — يبحث عن الطالب بالرقم الجامعي أولاً |
| `update` | تعديل المادة والعلامة |
| `delete` | حذف علامة واحدة |

**ملاحظة:** يقبل `university_id` في الإدخال ويحوّله لـ `student_id` تلقائياً.

---

### `AbsenceController`
| Action | الوصف |
|--------|-------|
| `store` | تسجيل غياب — يبحث عن الطالب بالرقم الجامعي |
| `update` | تعديل بيانات الغياب |
| `delete` | حذف سجل غياب |

---

## Models

### `Student` — أهم الدوال

```php
// فلتر متعدد المعايير
$model->filter($q, $department, $status);

// البحث بالرقم الجامعي (للـ grades و absences)
$model->findByUniversityId('20240001');

// تبديل الحالة بـ SQL مباشر
$model->toggleStatus($id);
// UPDATE students SET status = CASE WHEN status='active' THEN 'inactive' ELSE 'active' END

// إحصائيات سريعة
$model->counts(); // ['total'=>28, 'active'=>24, 'inactive'=>4]
```

---

### `Grade` — `allGrouped()`

تجمع العلامات حسب الطالب وتحسب المعدل:

```php
// النتيجة
[
  [
    'student_id'   => 1,
    'student_name' => 'أحمد محمد',
    'university_id'=> '20240001',
    'department'   => 'هندسة الحاسوب',
    'grades' => [
      ['id'=>1, 'subject'=>'برمجة 1', 'grade'=>85],
      ['id'=>2, 'subject'=>'رياضيات', 'grade'=>72],
    ]
  ],
  ...
]
```

---

### `Course` — `grouped()`

تجمع المقررات هرمياً:

```php
[
  'هندسة الحاسوب' => [
    'السنة الأولى' => [
      'الفصل الأول' => [
        ['id'=>1, 'name'=>'مقدمة في البرمجة'],
      ]
    ]
  ]
]
```

---

## Router

`controllers/router.php` — نقطة استقبال كل POST:

```php
match($controller) {
    'auth'        => (new AuthController())->handle(),
    'students'    => (new StudentController())->handle(),
    'staff'       => (new StaffController())->handle(),
    'faculties'   => (new FacultyController())->handle(),
    'departments' => (new DepartmentController())->handle(),
    'courses'     => (new CourseController())->handle(),
    'grades'      => (new GradeController())->handle(),
    'absences'    => (new AbsenceController())->handle(),
};
```

كل فورم في الـ views يحتوي على:
```html
<input type="hidden" name="controller" value="students">
<input type="hidden" name="action"     value="store">
```
