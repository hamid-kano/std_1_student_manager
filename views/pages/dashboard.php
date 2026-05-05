<?php
// إحصائيات سريعة
$db = Database::getInstance();
$stats = [
  'students'    => $db->query("SELECT COUNT(*) FROM students")->fetchColumn(),
  'active'      => $db->query("SELECT COUNT(*) FROM students WHERE status='active'")->fetchColumn(),
  'staff'       => $db->query("SELECT COUNT(*) FROM staff")->fetchColumn(),
  'departments' => $db->query("SELECT COUNT(*) FROM departments")->fetchColumn(),
  'courses'     => $db->query("SELECT COUNT(*) FROM courses")->fetchColumn(),
  'grades'      => $db->query("SELECT COUNT(*) FROM grades")->fetchColumn(),
];
?>

<div class="page-header">
  <h1><i class="fa-solid fa-house"></i> لوحة التحكم</h1>
  <p>مرحباً، <?= htmlspecialchars(Session::user()['username'] ?? 'admin') ?></p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- إحصائيات -->
<div class="stats">
  <div class="stat">
    <h2><?= $stats['students'] ?></h2>
    <p><i class="fa-solid fa-user-graduate"></i> إجمالي الطلاب</p>
  </div>
  <div class="stat" style="border-top-color:#16a34a;">
    <h2 style="color:#16a34a;"><?= $stats['active'] ?></h2>
    <p><i class="fa-solid fa-circle-check"></i> الطلاب المنتظمون</p>
  </div>
  <div class="stat" style="border-top-color:#f59e0b;">
    <h2 style="color:#f59e0b;"><?= $stats['staff'] ?></h2>
    <p><i class="fa-solid fa-chalkboard-user"></i> المدرسون</p>
  </div>
  <div class="stat" style="border-top-color:#8b5cf6;">
    <h2 style="color:#8b5cf6;"><?= $stats['departments'] ?></h2>
    <p><i class="fa-solid fa-folder-open"></i> الأقسام</p>
  </div>
  <div class="stat" style="border-top-color:#06b6d4;">
    <h2 style="color:#06b6d4;"><?= $stats['courses'] ?></h2>
    <p><i class="fa-solid fa-book-open"></i> المقررات</p>
  </div>
  <div class="stat" style="border-top-color:#ec4899;">
    <h2 style="color:#ec4899;"><?= $stats['grades'] ?></h2>
    <p><i class="fa-solid fa-chart-bar"></i> العلامات المسجلة</p>
  </div>
</div>

<!-- روابط سريعة -->
<div class="card" style="margin-top:28px;">
  <h3><i class="fa-solid fa-bolt"></i> وصول سريع</h3>
  <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:16px;">
    <?php
    $links = [
      ['page'=>'register',    'icon'=>'fa-user-plus',        'label'=>'تسجيل طالب',    'color'=>'#2563eb'],
      ['page'=>'students',    'icon'=>'fa-user-graduate',    'label'=>'قائمة الطلاب',  'color'=>'#16a34a'],
      ['page'=>'grades',      'icon'=>'fa-chart-bar',        'label'=>'إضافة علامة',   'color'=>'#f59e0b'],
      ['page'=>'absences',    'icon'=>'fa-calendar-xmark',   'label'=>'تسجيل غياب',    'color'=>'#dc2626'],
      ['page'=>'faculties',   'icon'=>'fa-landmark',         'label'=>'الكليات',        'color'=>'#8b5cf6'],
      ['page'=>'departments', 'icon'=>'fa-folder-open',      'label'=>'الأقسام',        'color'=>'#06b6d4'],
    ];
    foreach ($links as $l): ?>
    <a href="?page=<?= $l['page'] ?>"
       style="display:flex; align-items:center; gap:8px; padding:12px 20px;
              background:<?= $l['color'] ?>15; color:<?= $l['color'] ?>;
              border-radius:10px; text-decoration:none; font-weight:600; font-size:14px;
              border:1px solid <?= $l['color'] ?>30; transition:.2s;"
       onmouseover="this.style.background='<?= $l['color'] ?>'; this.style.color='white';"
       onmouseout="this.style.background='<?= $l['color'] ?>15'; this.style.color='<?= $l['color'] ?>';">
      <i class="fa-solid <?= $l['icon'] ?>"></i> <?= $l['label'] ?>
    </a>
    <?php endforeach; ?>
  </div>
</div>
