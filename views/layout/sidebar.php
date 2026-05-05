<?php $p = $_GET['page'] ?? 'dashboard'; ?>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="sidebar" id="sidebar">
  <div class="logo">
    <img src="<?= ASSETS_URL ?>/images/logo.jfif" alt="شعار الجامعة">
    <h3>شؤون الطلاب</h3>
  </div>

  <span class="nav-label">القائمة الرئيسية</span>
  <a href="?page=dashboard"  class="<?= $p==='dashboard' ?'active':'' ?>">
    <i class="fa-solid fa-house"></i> الرئيسية
  </a>
  <a href="?page=students"   class="<?= $p==='students'  ?'active':'' ?>">
    <i class="fa-solid fa-user-graduate"></i> الطلاب
  </a>
  <a href="?page=register"   class="<?= $p==='register'  ?'active':'' ?>">
    <i class="fa-solid fa-user-plus"></i> التسجيل الجامعي
  </a>

  <span class="nav-label">الهيكل الأكاديمي</span>
  <a href="?page=faculties"   class="<?= $p==='faculties'   ?'active':'' ?>">
    <i class="fa-solid fa-landmark"></i> الكليات
  </a>
  <a href="?page=departments" class="<?= $p==='departments' ?'active':'' ?>">
    <i class="fa-solid fa-folder-open"></i> الأقسام
  </a>
  <a href="?page=courses"     class="<?= $p==='courses'     ?'active':'' ?>">
    <i class="fa-solid fa-book-open"></i> المقررات
  </a>
  <a href="?page=staff"       class="<?= $p==='staff'       ?'active':'' ?>">
    <i class="fa-solid fa-chalkboard-user"></i> المدرسين
  </a>

  <span class="nav-label">المتابعة الأكاديمية</span>
  <a href="?page=grades"   class="<?= $p==='grades'   ?'active':'' ?>">
    <i class="fa-solid fa-chart-bar"></i> العلامات
  </a>
  <a href="?page=absences" class="<?= $p==='absences' ?'active':'' ?>">
    <i class="fa-solid fa-calendar-xmark"></i> الغيابات
  </a>
  <a href="?page=cards"    class="<?= $p==='cards'    ?'active':'' ?>">
    <i class="fa-solid fa-id-card"></i> البطاقات
  </a>
</div>

<button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
  <i class="fa-solid fa-bars"></i>
</button>
