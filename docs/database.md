# قاعدة البيانات

**النوع:** SQLite 3 (قابل للتبديل لـ MySQL)
**الملف:** `database/university.sqlite`

---

## مخطط العلاقات (ERD)

```
faculties (1) ──── (N) departments (1) ──── (N) courses
                         │
                         └──── (N) students (1) ──── (N) grades
                                              (1) ──── (N) absences
users (مستقل)
staff (مستقل)
```

---

## الجداول

### `faculties` — الكليات
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| name | TEXT NOT NULL | اسم الكلية |
| dean | TEXT | اسم العميد |
| created_at | TEXT | تاريخ الإنشاء |

---

### `departments` — الأقسام
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| name | TEXT NOT NULL | اسم القسم |
| faculty_id | INTEGER FK | مرجع للكلية |
| created_at | TEXT | تاريخ الإنشاء |

**العلاقة:** `faculty_id → faculties.id` (ON DELETE SET NULL)

---

### `courses` — المقررات
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| name | TEXT NOT NULL | اسم المادة |
| department_id | INTEGER FK | مرجع للقسم |
| year | TEXT | السنة الدراسية |
| semester | TEXT | الفصل الدراسي |
| created_at | TEXT | تاريخ الإنشاء |

**العلاقة:** `department_id → departments.id` (ON DELETE CASCADE)

---

### `students` — الطلاب
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| university_id | TEXT UNIQUE | الرقم الجامعي |
| name | TEXT NOT NULL | الاسم الكامل |
| faculty | TEXT | اسم الكلية (نص) |
| department | TEXT | اسم القسم (نص) |
| birth_place | TEXT | مكان الولادة |
| birth_date | TEXT | تاريخ الميلاد |
| address | TEXT | العنوان |
| phone | TEXT | رقم الهاتف |
| mother_name | TEXT | اسم الأم |
| father_name | TEXT | اسم الأب |
| gender | TEXT | الجنس (ذكر/أنثى) |
| status | TEXT | الحالة (active/inactive) |
| image | TEXT | مسار الصورة |
| created_at | TEXT | تاريخ التسجيل |
| updated_at | TEXT | تاريخ آخر تعديل |

> **ملاحظة:** `faculty` و `department` مخزنة كنص وليس FK لمرونة أكبر عند التعديل.

---

### `staff` — المدرسون
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| name | TEXT NOT NULL | اسم المدرس |
| university | TEXT | جامعة التخرج |
| experience | TEXT | الخبرات |
| created_at | TEXT | تاريخ الإضافة |

---

### `grades` — العلامات
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| student_id | INTEGER FK | مرجع للطالب |
| subject | TEXT NOT NULL | اسم المادة |
| grade | REAL NOT NULL | العلامة (0-100) |
| year | TEXT | السنة الدراسية |
| semester | TEXT | الفصل (أول/ثاني) |
| department | TEXT | القسم |
| created_at | TEXT | تاريخ الإدخال |

**العلاقة:** `student_id → students.id` (ON DELETE CASCADE)

---

### `absences` — الغيابات
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| student_id | INTEGER FK | مرجع للطالب |
| subject | TEXT NOT NULL | اسم المادة |
| absence_date | TEXT NOT NULL | تاريخ الغياب |
| year | TEXT | السنة الدراسية |
| semester | TEXT | الفصل |
| created_at | TEXT | تاريخ التسجيل |

**العلاقة:** `student_id → students.id` (ON DELETE CASCADE)

---

### `users` — المستخدمون
| العمود | النوع | الوصف |
|--------|-------|-------|
| id | INTEGER PK | معرف تلقائي |
| username | TEXT UNIQUE | اسم المستخدم |
| password | TEXT | كلمة المرور (bcrypt) |
| role | TEXT | الدور (admin) |
| created_at | TEXT | تاريخ الإنشاء |

---

## أوامر مفيدة

```bash
# فتح قاعدة البيانات مباشرة
sqlite3 database/university.sqlite

# عرض الجداول
.tables

# عرض بنية جدول
.schema students

# إعادة إنشاء كل شيء
http://localhost/std_1_student_manager/database/migrate.php

# زرع بيانات تجريبية
http://localhost/std_1_student_manager/database/seed.php

# إعادة تعيين كلمة مرور admin
http://localhost/std_1_student_manager/database/reset_admin.php
```
