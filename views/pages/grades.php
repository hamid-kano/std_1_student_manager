<?php
$grades      = $data['grades']      ?? [];
$departments = $data['departments'] ?? [];
$courses     = $data['courses']     ?? [];
$q           = htmlspecialchars($_GET['q']          ?? '');
$deptFilter  = htmlspecialchars($_GET['department'] ?? 'all');

// تجميع المواد حسب department_id لاستخدامها في JS
$coursesByDept = [];
foreach ($courses as $c) {
    $coursesByDept[$c['department_id']][] = $c['name'];
}
?>

<div class="page-header">
  <h1><i class="fa-solid fa-chart-bar"></i> العلامات</h1>
  <p>إدارة علامات الطلاب وحساب المعدلات</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فورم إضافة علامة -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> إضافة علامة</h3>
  <form method="POST" action="/std_1_student_manager/controllers/router.php">
    <input type="hidden" name="controller" value="grades">
    <input type="hidden" name="action"     value="store">
    <div class="form-grid">
      <div class="form-group">
        <label>الرقم الجامعي</label>
        <input type="text" name="university_id" id="gradeUid" placeholder="أدخل الرقم الجامعي" required>
      </div>
      <div class="form-group">
        <label>القسم</label>
        <select name="department" id="gradeDept" onchange="filterCoursesByDept()">
          <option value="">-- اختر القسم أولاً --</option>
          <?php foreach ($departments as $d): ?>
            <option value="<?= htmlspecialchars($d['name']) ?>"
                    data-id="<?= $d['id'] ?>">
              <?= htmlspecialchars($d['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>المادة</label>
        <select name="subject" id="gradeSubject" required>
          <option value="" disabled selected>اختر القسم أولاً</option>
        </select>
      </div>
      <div class="form-group">
        <label>العلامة (0-100)</label>
        <input type="number" name="grade" min="0" max="100" placeholder="العلامة" required>
      </div>
      <div class="form-group">
        <label>السنة</label>
        <select name="year">
          <option value="1">السنة 1</option>
          <option value="2">السنة 2</option>
          <option value="3">السنة 3</option>
          <option value="4">السنة 4</option>
        </select>
      </div>
      <div class="form-group">
        <label>الفصل</label>
        <select name="semester">
          <option value="أول">أول</option>
          <option value="ثاني">ثاني</option>
        </select>
      </div>
    </div>
    <br>
    <button type="submit" class="btn-submit" style="max-width:180px;">
      <i class="fa-solid fa-plus"></i> إضافة
    </button>
  </form>
</div>

<!-- فلاتر البحث -->
<form method="GET" class="filters-bar" style="margin-top:20px;">
  <input type="hidden" name="page" value="grades">
  <input type="text" name="q" value="<?= $q ?>" placeholder="بحث بالاسم أو الرقم...">
  <select name="department">
    <option value="all">كل الأقسام</option>
    <?php foreach ($departments as $d): ?>
      <option value="<?= htmlspecialchars($d['name']) ?>"
              <?= $deptFilter===$d['name']?'selected':'' ?>>
        <?= htmlspecialchars($d['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <button type="submit" class="btn-submit" style="width:auto; padding:9px 18px;">
    <i class="fa-solid fa-magnifying-glass"></i> بحث
  </button>
</form>

<!-- جداول الطلاب -->
<?php if (empty($grades)): ?>
  <div class="card" style="text-align:center; color:#94a3b8; padding:40px;">
    <i class="fa-solid fa-chart-bar" style="font-size:40px; display:block; margin-bottom:12px;"></i>
    لا توجد علامات مضافة بعد
  </div>
<?php else: ?>
  <?php foreach ($grades as $student): ?>
  <?php
    $sum = array_sum(array_column($student['grades'], 'grade'));
    $avg = count($student['grades']) > 0 ? round($sum / count($student['grades']), 2) : 0;
  ?>
  <div class="student-grades">
    <h3>
      <i class="fa-solid fa-user-graduate"></i>
      <?= htmlspecialchars($student['student_name']) ?>
      <span style="color:#64748b; font-weight:400; font-size:13px;">
        (<?= htmlspecialchars($student['university_id']) ?>)
        — <?= htmlspecialchars($student['department'] ?? '') ?>
        — سنة <?= htmlspecialchars($student['year'] ?? '') ?>
        فصل <?= htmlspecialchars($student['semester'] ?? '') ?>
      </span>
    </h3>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>المادة</th>
            <th>العلامة</th>
            <th>تحكم</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($student['grades'] as $g): ?>
          <tr>
            <td><?= htmlspecialchars($g['subject']) ?></td>
            <td>
              <span style="font-weight:700; color:<?= $g['grade']>=50?'#16a34a':'#dc2626' ?>">
                <?= $g['grade'] ?>
              </span>
            </td>
            <td>
              <button class="edit-btn"
                      onclick="openGradeEdit(<?= $g['id'] ?>, '<?= htmlspecialchars($g['subject']) ?>', <?= $g['grade'] ?>)"
                      title="تعديل">
                <i class="fa-solid fa-pen"></i>
              </button>
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline"
                    onsubmit="return confirm('حذف هذه العلامة؟')">
                <input type="hidden" name="controller" value="grades">
                <input type="hidden" name="action"     value="delete">
                <input type="hidden" name="id"         value="<?= $g['id'] ?>">
                <button type="submit" class="delete-btn" title="حذف">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="studentAverage">
      <i class="fa-solid fa-calculator"></i>
      المعدل: <?= $avg ?> / 100
    </div>
  </div>
  <?php endforeach; ?>
<?php endif; ?>

<!-- Modal تعديل العلامة -->
<div id="gradeEditModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
     z-index:9999; align-items:center; justify-content:center; padding:20px;">
  <div class="modal-box" style="max-width:400px;">
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل العلامة</h3>
    <form method="POST" action="/std_1_student_manager/controllers/router.php">
      <input type="hidden" name="controller" value="grades">
      <input type="hidden" name="action"     value="update">
      <input type="hidden" name="id"         id="gradeEditId">
      <div class="form-group" style="margin-bottom:14px;">
        <label>المادة</label>
        <input type="text" name="subject" id="gradeEditSubject" required>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>العلامة</label>
        <input type="number" name="grade" id="gradeEditValue" min="0" max="100" required>
      </div>
      <div class="modal-actions">
        <button type="submit" class="btn-save">
          <i class="fa-solid fa-floppy-disk"></i> حفظ
        </button>
        <button type="button" class="btn-cancel"
                onclick="document.getElementById('gradeEditModal').style.display='none'">
          إلغاء
        </button>
      </div>
    </form>
  </div>
</div>

<script>
// بيانات المواد حسب القسم (من PHP)
const coursesByDept = <?= json_encode($coursesByDept, JSON_UNESCAPED_UNICODE) ?>;

function filterCoursesByDept() {
  const deptSelect  = document.getElementById('gradeDept');
  const subjSelect  = document.getElementById('gradeSubject');
  const deptId      = deptSelect.options[deptSelect.selectedIndex]?.dataset.id;

  subjSelect.innerHTML = '<option value="" disabled selected>اختر المادة</option>';

  const courses = coursesByDept[deptId] ?? [];
  if (courses.length === 0) {
    subjSelect.innerHTML = '<option value="" disabled selected>لا توجد مواد لهذا القسم</option>';
    return;
  }
  courses.forEach(name => {
    const opt = document.createElement('option');
    opt.value = name;
    opt.textContent = name;
    subjSelect.appendChild(opt);
  });
}

function openGradeEdit(id, subject, grade) {
  document.getElementById('gradeEditId').value      = id;
  document.getElementById('gradeEditSubject').value = subject;
  document.getElementById('gradeEditValue').value   = grade;
  document.getElementById('gradeEditModal').style.display = 'flex';
}
</script>
