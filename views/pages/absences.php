<?php
$absences = $data['absences'] ?? [];
$courses  = $data['courses']  ?? [];
$q        = htmlspecialchars($_GET['q']        ?? '');
$year     = htmlspecialchars($_GET['year']     ?? '');
$semester = htmlspecialchars($_GET['semester'] ?? '');

$coursesByDept = [];
foreach ($courses as $c) {
    $coursesByDept[$c['department_id']][] = $c['name'];
}
?>

<div class="page-header">
  <h1><i class="fa-solid fa-calendar-xmark"></i> الغيابات</h1>
  <p>تسجيل ومتابعة غيابات الطلاب</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فورم التسجيل -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> تسجيل غياب</h3>
  <form method="POST" action="/std_1_student_manager/controllers/router.php">
    <input type="hidden" name="controller" value="absences">
    <input type="hidden" name="action"     value="store">
    <div class="form-grid">
      <div class="form-group">
        <label>الرقم الجامعي</label>
        <input type="text" name="university_id" placeholder="أدخل الرقم الجامعي" required>
      </div>
      <div class="form-group">
        <label>القسم</label>
        <select id="absDept" onchange="filterAbsCourses()">
          <option value="">-- اختر القسم أولاً --</option>
          <?php
          $db   = Database::getInstance();
          $deps = $db->query("SELECT id, name FROM departments ORDER BY name")->fetchAll();
          foreach ($deps as $d): ?>
            <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>المادة</label>
        <select name="subject" id="absSubject" required>
          <option value="" disabled selected>اختر القسم أولاً</option>
        </select>
      </div>
      <div class="form-group">
        <label>تاريخ الغياب</label>
        <input type="date" name="absence_date" required>
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
      <i class="fa-solid fa-floppy-disk"></i> حفظ
    </button>
  </form>
</div>

<!-- فلاتر -->
<form method="GET" class="filters-bar" style="margin-top:16px;">
  <input type="hidden" name="page" value="absences">
  <input type="text" name="q" value="<?= $q ?>" placeholder="بحث بالاسم أو الرقم...">
  <select name="year">
    <option value="">كل السنوات</option>
    <?php foreach (['1','2','3','4'] as $y): ?>
      <option value="<?= $y ?>" <?= $year===$y?'selected':'' ?>>السنة <?= $y ?></option>
    <?php endforeach; ?>
  </select>
  <select name="semester">
    <option value="">كل الفصول</option>
    <option value="أول"  <?= $semester==='أول' ?'selected':'' ?>>أول</option>
    <option value="ثاني" <?= $semester==='ثاني'?'selected':'' ?>>ثاني</option>
  </select>
  <button type="submit" class="btn-submit" style="width:auto; padding:9px 18px;">
    <i class="fa-solid fa-magnifying-glass"></i> بحث
  </button>
</form>

<!-- جدول الغيابات -->
<div class="card">
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>الاسم</th>
          <th>الرقم الجامعي</th>
          <th>المادة</th>
          <th>التاريخ</th>
          <th>السنة</th>
          <th>الفصل</th>
          <th>تحكم</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($absences)): ?>
          <tr><td colspan="8" style="color:#94a3b8; padding:30px;">لا توجد غيابات مسجلة</td></tr>
        <?php else: ?>
          <?php foreach ($absences as $i => $a): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($a['student_name']) ?></td>
            <td><?= htmlspecialchars($a['university_id']) ?></td>
            <td><?= htmlspecialchars($a['subject']) ?></td>
            <td><?= htmlspecialchars($a['absence_date']) ?></td>
            <td><?= htmlspecialchars($a['year']) ?></td>
            <td><?= htmlspecialchars($a['semester']) ?></td>
            <td>
              <button class="edit-btn"
                      onclick="openAbsenceEdit(<?= htmlspecialchars(json_encode($a)) ?>)"
                      title="تعديل">
                <i class="fa-solid fa-pen"></i>
              </button>
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline"
                    onsubmit="return confirm('حذف هذا الغياب؟')">
                <input type="hidden" name="controller" value="absences">
                <input type="hidden" name="action"     value="delete">
                <input type="hidden" name="id"         value="<?= $a['id'] ?>">
                <button type="submit" class="delete-btn" title="حذف">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal تعديل -->
<div id="absenceEditModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
     z-index:9999; align-items:center; justify-content:center; padding:20px;">
  <div class="modal-box" style="max-width:440px;">
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل الغياب</h3>
    <form method="POST" action="/std_1_student_manager/controllers/router.php">
      <input type="hidden" name="controller" value="absences">
      <input type="hidden" name="action"     value="update">
      <input type="hidden" name="id"         id="absEditId">
      <div class="form-group" style="margin-bottom:14px;">
        <label>المادة</label>
        <input type="text" name="subject" id="absEditSubject" required>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>التاريخ</label>
        <input type="date" name="absence_date" id="absEditDate" required>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>السنة</label>
        <select name="year" id="absEditYear">
          <option value="1">1</option><option value="2">2</option>
          <option value="3">3</option><option value="4">4</option>
        </select>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>الفصل</label>
        <select name="semester" id="absEditSemester">
          <option value="أول">أول</option>
          <option value="ثاني">ثاني</option>
        </select>
      </div>
      <div class="modal-actions">
        <button type="submit" class="btn-save">
          <i class="fa-solid fa-floppy-disk"></i> حفظ
        </button>
        <button type="button" class="btn-cancel"
                onclick="document.getElementById('absenceEditModal').style.display='none'">
          إلغاء
        </button>
      </div>
    </form>
  </div>
</div>

<script>
const absCoursesByDept = <?= json_encode($coursesByDept, JSON_UNESCAPED_UNICODE) ?>;

function filterAbsCourses() {
  const deptId   = document.getElementById('absDept').value;
  const subjSel  = document.getElementById('absSubject');

  subjSel.innerHTML = '<option value="" disabled selected>اختر المادة</option>';

  const courses = absCoursesByDept[deptId] ?? [];
  if (courses.length === 0) {
    subjSel.innerHTML = '<option value="" disabled selected>لا توجد مواد لهذا القسم</option>';
    return;
  }
  courses.forEach(name => {
    const opt = document.createElement('option');
    opt.value = name;
    opt.textContent = name;
    subjSel.appendChild(opt);
  });
}

function openAbsenceEdit(a) {
  document.getElementById('absEditId').value       = a.id;
  document.getElementById('absEditSubject').value  = a.subject;
  document.getElementById('absEditDate').value     = a.absence_date;
  document.getElementById('absEditYear').value     = a.year;
  document.getElementById('absEditSemester').value = a.semester;
  document.getElementById('absenceEditModal').style.display = 'flex';
}
</script>
