<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="sidebar" id="sidebar">
  <div class="logo">
    <img src="<?= ASSETS_URL ?>/images/logo.jfif" alt="شعار الجامعة">
    <h3>شؤون الطلاب</h3>
  </div>

  <span class="nav-label">القائمة الرئيسية</span>
  <a class="active" onclick="showPage('dashboard', this)">
    <i class="fa-solid fa-house"></i> الرئيسية
  </a>
  <a onclick="showPage('students', this)">
    <i class="fa-solid fa-user-graduate"></i> الطلاب
  </a>
  <a onclick="showPage('register', this)">
    <i class="fa-solid fa-user-plus"></i> التسجيل الجامعي
  </a>

  <span class="nav-label">الهيكل الأكاديمي</span>
  <a onclick="showPage('faculties', this)">
    <i class="fa-solid fa-landmark"></i> الكليات
  </a>
  <a onclick="showPage('departments', this)">
    <i class="fa-solid fa-folder-open"></i> الأقسام
  </a>
  <a onclick="showPage('courses', this)">
    <i class="fa-solid fa-book-open"></i> المقررات
  </a>
  <a onclick="showPage('staff', this)">
    <i class="fa-solid fa-chalkboard-user"></i> المدرسين
  </a>

  <span class="nav-label">المتابعة الأكاديمية</span>
  <a onclick="showPage('grades', this)">
    <i class="fa-solid fa-chart-bar"></i> العلامات
  </a>
  <a onclick="showPage('absences', this)">
    <i class="fa-solid fa-calendar-xmark"></i> الغيابات
  </a>
  <a onclick="showPage('Cards', this)">
    <i class="fa-solid fa-id-card"></i> البطاقات
  </a>
</div>

<button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
  <i class="fa-solid fa-bars"></i>
</button>
