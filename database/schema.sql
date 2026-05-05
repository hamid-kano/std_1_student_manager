-- =========================================
-- University System - Database Schema
-- متوافق مع SQLite و MySQL
-- =========================================

-- الكليات
CREATE TABLE IF NOT EXISTS faculties (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    name       TEXT    NOT NULL,
    dean       TEXT,
    created_at TEXT    DEFAULT (datetime('now'))
);

-- الأقسام
CREATE TABLE IF NOT EXISTS departments (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    name       TEXT    NOT NULL,
    faculty_id INTEGER,
    created_at TEXT    DEFAULT (datetime('now')),
    FOREIGN KEY (faculty_id) REFERENCES faculties(id) ON DELETE SET NULL
);

-- المقررات
CREATE TABLE IF NOT EXISTS courses (
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    name          TEXT    NOT NULL,
    department_id INTEGER,
    year          TEXT    NOT NULL,
    semester      TEXT    NOT NULL,
    created_at    TEXT    DEFAULT (datetime('now')),
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
);

-- الطلاب
CREATE TABLE IF NOT EXISTS students (
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    university_id TEXT    NOT NULL UNIQUE,
    name          TEXT    NOT NULL,
    faculty       TEXT,
    department    TEXT,
    birth_place   TEXT,
    birth_date    TEXT,
    address       TEXT,
    phone         TEXT,
    mother_name   TEXT,
    father_name   TEXT,
    gender        TEXT    DEFAULT 'ذكر',
    status        TEXT    DEFAULT 'active',
    image         TEXT,
    created_at    TEXT    DEFAULT (datetime('now')),
    updated_at    TEXT    DEFAULT (datetime('now'))
);

-- المدرسين
CREATE TABLE IF NOT EXISTS staff (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    name       TEXT NOT NULL,
    university TEXT,
    experience TEXT,
    created_at TEXT DEFAULT (datetime('now'))
);

-- العلامات
CREATE TABLE IF NOT EXISTS grades (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    student_id INTEGER NOT NULL,
    subject    TEXT    NOT NULL,
    grade      REAL    NOT NULL,
    year       TEXT    NOT NULL,
    semester   TEXT    NOT NULL,
    department TEXT,
    created_at TEXT    DEFAULT (datetime('now')),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- الغيابات
CREATE TABLE IF NOT EXISTS absences (
    id           INTEGER PRIMARY KEY AUTOINCREMENT,
    student_id   INTEGER NOT NULL,
    subject      TEXT    NOT NULL,
    absence_date TEXT    NOT NULL,
    year         TEXT    NOT NULL,
    semester     TEXT    NOT NULL,
    created_at   TEXT    DEFAULT (datetime('now')),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- المستخدمون
CREATE TABLE IF NOT EXISTS users (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    username   TEXT NOT NULL UNIQUE,
    password   TEXT NOT NULL,
    role       TEXT DEFAULT 'admin',
    created_at TEXT DEFAULT (datetime('now'))
);

-- مستخدم افتراضي: admin / admin123
INSERT OR IGNORE INTO users (username, password, role)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
