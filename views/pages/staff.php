<?php $staff = $data['staff'] ?? []; ?>

<div class="page-header">
  <h1><i class="fa-solid fa-chalkboard-user"></i> المدرسين</h1>
  <p>إدارة أعضاء هيئة التدريس</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فورم الإضافة -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> إضافة مدرس</h3>
  <form method="POST" action="/std_1_student_manager/controllers/router.php">
    <input type="hidden" name="controller" value="staff">
    <input type="hidden" name="action"     value="store">
    <div class="form-grid">
      <div class="form-group">
        <label>اسم المدرس</label>
        <input type="text" name="name" placeholder="الاسم الكامل" required>
      </div>
      <div class="form-group">
        <label>خريج جامعة</label>
        <input type="text" name="university" placeholder="اسم الجامعة">
      </div>
      <div class="form-group full">
        <label>الخبرات</label>
        <input type="text" name="experience" placeholder="اذكر الخبرات">
      </div>
    </div>
    <br>
    <button type="submit" class="btn-submit" style="max-width:180px;">
      <i class="fa-solid fa-plus"></i> إضافة
    </button>
  </form>
</div>

<!-- جدول المدرسين -->
<div class="card">
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>الاسم</th>
          <th>خريج جامعة</th>
          <th>الخبرات</th>
          <th>تحكم</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($staff)): ?>
          <tr><td colspan="5" style="color:#94a3b8;">لا يوجد مدرسون مضافون بعد</td></tr>
        <?php else: ?>
          <?php foreach ($staff as $i => $s): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['university'] ?? '—') ?></td>
            <td><?= htmlspecialchars($s['experience'] ?? '—') ?></td>
            <td>
              <button class="edit-btn"
                      onclick="openEditModal(<?= htmlspecialchars(json_encode($s)) ?>)"
                      title="تعديل">
                <i class="fa-solid fa-pen"></i>
              </button>
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline"
                    onsubmit="return confirm('حذف هذا المدرس؟')">
                <input type="hidden" name="controller" value="staff">
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

<!-- Modal التعديل -->
<div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
     z-index:9999; align-items:center; justify-content:center; padding:20px;">
  <div class="modal-box">
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل بيانات المدرس</h3>
    <form method="POST" action="/std_1_student_manager/controllers/router.php">
      <input type="hidden" name="controller" value="staff">
      <input type="hidden" name="action"     value="update">
      <input type="hidden" name="id"         id="editId">
      <div class="form-group" style="margin-bottom:14px;">
        <label>الاسم</label>
        <input type="text" name="name" id="editName" required>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>خريج جامعة</label>
        <input type="text" name="university" id="editUniversity">
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>الخبرات</label>
        <input type="text" name="experience" id="editExperience">
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
  document.getElementById('editUniversity').value = s.university ?? '';
  document.getElementById('editExperience').value = s.experience ?? '';
  document.getElementById('editModal').style.display = 'flex';
}
function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}
</script>
