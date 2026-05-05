<?php
$departments = $data['departments'] ?? [];
$faculties   = $data['faculties']   ?? [];
?>

<div class="page-header">
  <h1><i class="fa-solid fa-folder-open"></i> الأقسام</h1>
  <p>إدارة أقسام الجامعة</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فورم الإضافة -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> إضافة قسم</h3>
  <form method="POST" action="/std_1_student_manager/controllers/router.php">
    <input type="hidden" name="controller" value="departments">
    <input type="hidden" name="action"     value="store">
    <div class="form-grid">
      <div class="form-group">
        <label>اسم القسم</label>
        <input type="text" name="name" placeholder="مثال: هندسة الحاسوب" required>
      </div>
      <div class="form-group">
        <label>الكلية</label>
        <select name="faculty_id" required>
          <option value="" disabled selected>اختر الكلية</option>
          <?php foreach ($faculties as $f): ?>
            <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <br>
    <button type="submit" class="btn-submit" style="max-width:180px;">
      <i class="fa-solid fa-plus"></i> إضافة
    </button>
  </form>
</div>

<!-- جدول الأقسام -->
<div class="card">
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>اسم القسم</th>
          <th>الكلية</th>
          <th>تحكم</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($departments)): ?>
          <tr><td colspan="4" style="color:#94a3b8;">لا توجد أقسام مضافة بعد</td></tr>
        <?php else: ?>
          <?php foreach ($departments as $i => $d): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($d['name']) ?></td>
            <td><?= htmlspecialchars($d['faculty_name'] ?? '—') ?></td>
            <td>
              <button class="edit-btn"
                      onclick="openEditModal(<?= htmlspecialchars(json_encode($d)) ?>)"
                      title="تعديل">
                <i class="fa-solid fa-pen"></i>
              </button>
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline"
                    onsubmit="return confirm('حذف هذا القسم؟')">
                <input type="hidden" name="controller" value="departments">
                <input type="hidden" name="action"     value="delete">
                <input type="hidden" name="id"         value="<?= $d['id'] ?>">
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

<!-- Modal التعديل -->
<div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
     z-index:9999; align-items:center; justify-content:center; padding:20px;">
  <div class="modal-box">
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل القسم</h3>
    <form method="POST" action="/std_1_student_manager/controllers/router.php">
      <input type="hidden" name="controller" value="departments">
      <input type="hidden" name="action"     value="update">
      <input type="hidden" name="id"         id="editId">
      <div class="form-group" style="margin-bottom:14px;">
        <label>اسم القسم</label>
        <input type="text" name="name" id="editName" required>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>الكلية</label>
        <select name="faculty_id" id="editFacultyId">
          <?php foreach ($faculties as $f): ?>
            <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['name']) ?></option>
          <?php endforeach; ?>
        </select>
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
function openEditModal(d) {
  document.getElementById('editId').value        = d.id;
  document.getElementById('editName').value      = d.name;
  document.getElementById('editFacultyId').value = d.faculty_id;
  document.getElementById('editModal').style.display = 'flex';
}
function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}
</script>
