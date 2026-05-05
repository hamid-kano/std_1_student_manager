<?php
$students = $data['students'] ?? [];
$counts   = $data['counts']   ?? ['total' => 0, 'active' => 0, 'inactive' => 0];
$q        = htmlspecialchars($_GET['q']          ?? '');
$dept     = htmlspecialchars($_GET['department'] ?? '');
$status   = htmlspecialchars($_GET['status']     ?? 'all');
?>

<div class="page-header">
  <h1><i class="fa-solid fa-user-graduate"></i> الطلاب</h1>
  <p>إدارة بيانات الطلاب المسجلين</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فلاتر البحث -->
<form method="GET" action="" class="filters-bar">
  <input type="hidden" name="page" value="students">
  <input type="text"  name="q"          value="<?= $q ?>"    placeholder="بحث بالاسم أو الرقم...">
  <select name="department">
    <option value="">كل الأقسام</option>
    <?php
    $depts = array_unique(array_column($students + (new Student())->all(), 'department'));
    foreach ($depts as $d): ?>
      <option value="<?= htmlspecialchars($d) ?>" <?= $dept===$d?'selected':'' ?>>
        <?= htmlspecialchars($d) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <select name="status">
    <option value="all"     <?= $status==='all'     ?'selected':'' ?>>كل الحالات</option>
    <option value="active"  <?= $status==='active'  ?'selected':'' ?>>منتظم</option>
    <option value="inactive"<?= $status==='inactive'?'selected':'' ?>>موقوف</option>
  </select>
  <button type="submit" class="btn-submit" style="width:auto; padding:9px 18px;">
    <i class="fa-solid fa-magnifying-glass"></i> بحث
  </button>
  <a href="?page=students" class="btn-submit"
     style="width:auto; padding:9px 18px; background:#64748b; text-decoration:none; border-radius:10px; color:white; font-size:14px;">
    <i class="fa-solid fa-rotate-right"></i> إعادة تعيين
  </a>
</form>

<!-- جدول الطلاب -->
<div class="card">
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>الصورة</th>
          <th>الرقم الجامعي</th>
          <th>الاسم</th>
          <th>الكلية</th>
          <th>القسم</th>
          <th>الهاتف</th>
          <th>الجنس</th>
          <th>الحالة</th>
          <th>تحكم</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($students)): ?>
          <tr><td colspan="9" style="color:#94a3b8; padding:30px;">لا يوجد طلاب</td></tr>
        <?php else: ?>
          <?php foreach ($students as $s): ?>
          <tr>
            <td>
              <?php if ($s['image']): ?>
                <img src="<?= htmlspecialchars($s['image']) ?>"
                     style="width:38px;height:38px;border-radius:50%;object-fit:cover;">
              <?php else: ?>
                <span style="font-size:28px; color:#cbd5e1;">
                  <i class="fa-solid fa-circle-user"></i>
                </span>
              <?php endif; ?>
            </td>
            <td><strong><?= htmlspecialchars($s['university_id']) ?></strong></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['faculty'] ?? '—') ?></td>
            <td><?= htmlspecialchars($s['department'] ?? '—') ?></td>
            <td><?= htmlspecialchars($s['phone'] ?? '—') ?></td>
            <td><?= htmlspecialchars($s['gender'] ?? '—') ?></td>
            <td>
              <span class="status <?= $s['status'] ?>">
                <?= $s['status'] === 'active' ? 'منتظم' : 'موقوف' ?>
              </span>
            </td>
            <td style="white-space:nowrap;">
              <!-- تغيير الحالة -->
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline">
                <input type="hidden" name="controller" value="students">
                <input type="hidden" name="action"     value="toggle_status">
                <input type="hidden" name="id"         value="<?= $s['id'] ?>">
                <button type="submit"
                        class="btn <?= $s['status']==='active' ? 'active-btn' : 'inactive-btn' ?>"
                        title="تغيير الحالة">
                  <?= $s['status']==='active' ? 'منتظم' : 'موقوف' ?>
                </button>
              </form>
              <!-- تعديل -->
              <button class="edit-btn"
                      onclick="openEditModal(<?= htmlspecialchars(json_encode($s)) ?>)"
                      title="تعديل">
                <i class="fa-solid fa-pen"></i>
              </button>
              <!-- حذف -->
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline"
                    onsubmit="return confirm('حذف هذا الطالب نهائياً؟')">
                <input type="hidden" name="controller" value="students">
                <input type="hidden" name="action"     value="delete">
                <input type="hidden" name="id"         value="<?= $s['id'] ?>">
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

<!-- إحصائيات -->
<div class="stats">
  <div class="stat">
    <h2><?= (int)$counts['total'] ?></h2>
    <p>إجمالي الطلاب</p>
  </div>
  <div class="stat" style="border-top-color:#16a34a;">
    <h2 style="color:#16a34a;"><?= (int)$counts['active'] ?></h2>
    <p>المنتظمون</p>
  </div>
  <div class="stat" style="border-top-color:#dc2626;">
    <h2 style="color:#dc2626;"><?= (int)$counts['inactive'] ?></h2>
    <p>الموقوفون</p>
  </div>
</div>

<!-- Modal التعديل -->
<div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
     z-index:9999; align-items:center; justify-content:center; padding:20px;">
  <div class="modal-box">
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل بيانات الطالب</h3>
    <form method="POST" action="/std_1_student_manager/controllers/router.php"
          enctype="multipart/form-data">
      <input type="hidden" name="controller" value="students">
      <input type="hidden" name="action"     value="update">
      <input type="hidden" name="id"         id="editId">
      <div class="form-grid">
        <div class="form-group">
          <label>الاسم</label>
          <input type="text" name="name" id="editName" required>
        </div>
        <div class="form-group">
          <label>الجنس</label>
          <select name="gender" id="editGender">
            <option value="ذكر">ذكر</option>
            <option value="أنثى">أنثى</option>
          </select>
        </div>
        <div class="form-group">
          <label>الكلية</label>
          <input type="text" name="faculty" id="editFaculty">
        </div>
        <div class="form-group">
          <label>القسم</label>
          <input type="text" name="department" id="editDepartment">
        </div>
        <div class="form-group">
          <label>مكان الولادة</label>
          <input type="text" name="birth_place" id="editBirthPlace">
        </div>
        <div class="form-group">
          <label>تاريخ الميلاد</label>
          <input type="date" name="birth_date" id="editBirthDate">
        </div>
        <div class="form-group">
          <label>العنوان</label>
          <input type="text" name="address" id="editAddress">
        </div>
        <div class="form-group">
          <label>الهاتف</label>
          <input type="text" name="phone" id="editPhone">
        </div>
        <div class="form-group">
          <label>اسم الأم</label>
          <input type="text" name="mother_name" id="editMother">
        </div>
        <div class="form-group">
          <label>اسم الأب</label>
          <input type="text" name="father_name" id="editFather">
        </div>
        <div class="form-group full">
          <label>تغيير الصورة</label>
          <input type="file" name="image" accept="image/*">
        </div>
      </div>
      <div class="modal-actions">
        <button type="submit" class="btn-save">
          <i class="fa-solid fa-floppy-disk"></i> حفظ
        </button>
        <button type="button" class="btn-cancel" onclick="closeEditModal()">إلغاء</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditModal(s) {
  document.getElementById('editId').value         = s.id;
  document.getElementById('editName').value       = s.name;
  document.getElementById('editGender').value     = s.gender    ?? 'ذكر';
  document.getElementById('editFaculty').value    = s.faculty   ?? '';
  document.getElementById('editDepartment').value = s.department ?? '';
  document.getElementById('editBirthPlace').value = s.birth_place ?? '';
  document.getElementById('editBirthDate').value  = s.birth_date  ?? '';
  document.getElementById('editAddress').value    = s.address   ?? '';
  document.getElementById('editPhone').value      = s.phone     ?? '';
  document.getElementById('editMother').value     = s.mother_name ?? '';
  document.getElementById('editFather').value     = s.father_name ?? '';
  document.getElementById('editModal').style.display = 'flex';
}
function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}
</script>
