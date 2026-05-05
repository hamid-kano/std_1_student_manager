<?php
$courses     = $data['courses']     ?? [];
$departments = $data['departments'] ?? [];
?>

<div class="page-header">
  <h1><i class="fa-solid fa-book-open"></i> المقررات الدراسية</h1>
  <p>إدارة المواد حسب القسم والسنة والفصل</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فورم الإضافة -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> إضافة مقرر</h3>
  <form method="POST" action="/std_1_student_manager/controllers/router.php">
    <input type="hidden" name="controller" value="courses">
    <input type="hidden" name="action"     value="store">
    <div class="form-grid">
      <div class="form-group">
        <label>القسم</label>
        <select name="department_id" required>
          <option value="" disabled selected>اختر القسم</option>
          <?php foreach ($departments as $d): ?>
            <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>اسم المادة</label>
        <input type="text" name="name" placeholder="مثال: برمجة 1" required>
      </div>
      <div class="form-group">
        <label>السنة</label>
        <select name="year" required>
          <option value="" disabled selected>اختر السنة</option>
          <option value="السنة الأولى">السنة الأولى</option>
          <option value="السنة الثانية">السنة الثانية</option>
          <option value="السنة الثالثة">السنة الثالثة</option>
          <option value="السنة الرابعة">السنة الرابعة</option>
        </select>
      </div>
      <div class="form-group">
        <label>الفصل</label>
        <select name="semester" required>
          <option value="" disabled selected>اختر الفصل</option>
          <option value="الفصل الأول">الفصل الأول</option>
          <option value="الفصل الثاني">الفصل الثاني</option>
        </select>
      </div>
    </div>
    <br>
    <button type="submit" class="btn-submit" style="max-width:180px;">
      <i class="fa-solid fa-plus"></i> إضافة
    </button>
  </form>
</div>

<!-- عرض المقررات مجمّعة -->
<?php if (empty($courses)): ?>
  <div class="card" style="color:#94a3b8; text-align:center; padding:40px;">
    <i class="fa-solid fa-book-open" style="font-size:40px; margin-bottom:12px; display:block;"></i>
    لا توجد مقررات مضافة بعد
  </div>
<?php else: ?>
  <?php foreach ($courses as $deptName => $years): ?>
  <div class="course-dept-card">
    <h2><?= htmlspecialchars($deptName) ?></h2>

    <?php foreach ($years as $year => $semesters): ?>
    <div class="course-year">
      <h3><i class="fa-solid fa-calendar"></i> <?= htmlspecialchars($year) ?></h3>

      <?php foreach ($semesters as $semester => $items): ?>
      <div class="course-semester">
        <strong><i class="fa-solid fa-layer-group"></i> <?= htmlspecialchars($semester) ?></strong>
        <div class="course-list">
          <?php foreach ($items as $course): ?>
          <div class="course-item-wrap" style="display:flex; align-items:center; gap:6px;">
            <span class="course-item"><?= htmlspecialchars($course['name']) ?></span>
            <!-- حذف -->
            <form method="POST" action="/std_1_student_manager/controllers/router.php"
                  style="display:inline"
                  onsubmit="return confirm('حذف هذه المادة؟')">
              <input type="hidden" name="controller" value="courses">
              <input type="hidden" name="action"     value="delete">
              <input type="hidden" name="id"         value="<?= $course['id'] ?>">
              <button type="submit" class="delete-btn"
                      style="font-size:12px; padding:3px 6px;" title="حذف">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </form>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
    <?php endforeach; ?>
  </div>
  <?php endforeach; ?>
<?php endif; ?>
