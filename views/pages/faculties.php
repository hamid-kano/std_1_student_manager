<?php /** @var array $data */ $faculties = $data['faculties'] ?? []; ?>

<div class="page-header">
  <h1><i class="fa-solid fa-landmark"></i> الكليات</h1>
  <p>إدارة كليات الجامعة</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<!-- فورم الإضافة -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> إضافة كلية</h3>
  <form method="POST" action="/std_1_student_manager/controllers/router.php">
    <input type="hidden" name="controller" value="faculties">
    <input type="hidden" name="action"     value="store">
    <div class="form-grid">
      <div class="form-group">
        <label>اسم الكلية</label>
        <input type="text" name="name" placeholder="مثال: كلية الهندسة" required>
      </div>
      <div class="form-group">
        <label>العميد</label>
        <input type="text" name="dean" placeholder="د. اسم العميد">
      </div>
    </div>
    <br>
    <button type="submit" class="btn-submit" style="max-width:180px;">
      <i class="fa-solid fa-plus"></i> إضافة
    </button>
  </form>
</div>

<!-- جدول الكليات -->
<div class="card">
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>اسم الكلية</th>
          <th>العميد</th>
          <th>تحكم</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($faculties)): ?>
          <tr><td colspan="4" style="color:#94a3b8;">لا توجد كليات مضافة بعد</td></tr>
        <?php else: ?>
          <?php foreach ($faculties as $i => $f): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($f['name']) ?></td>
            <td><?= htmlspecialchars($f['dean'] ?? '—') ?></td>
            <td>
              <!-- زر تعديل -->
              <button class="edit-btn" onclick="openEditModal(<?= htmlspecialchars(json_encode($f)) ?>)"
                      title="تعديل">
                <i class="fa-solid fa-pen"></i>
              </button>
              <!-- زر حذف -->
              <form method="POST" action="/std_1_student_manager/controllers/router.php"
                    style="display:inline"
                    onsubmit="return confirm('هل أنت متأكد من حذف هذه الكلية؟')">
                <input type="hidden" name="controller" value="faculties">
                <input type="hidden" name="action"     value="delete">
                <input type="hidden" name="id"         value="<?= $f['id'] ?>">
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
    <h3><i class="fa-solid fa-pen-to-square"></i> تعديل الكلية</h3>
    <form method="POST" action="/std_1_student_manager/controllers/router.php">
      <input type="hidden" name="controller" value="faculties">
      <input type="hidden" name="action"     value="update">
      <input type="hidden" name="id"         id="editId">
      <div class="form-group" style="margin-bottom:14px;">
        <label>اسم الكلية</label>
        <input type="text" name="name" id="editName" required>
      </div>
      <div class="form-group" style="margin-bottom:14px;">
        <label>العميد</label>
        <input type="text" name="dean" id="editDean">
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
function openEditModal(f) {
  document.getElementById('editId').value   = f.id;
  document.getElementById('editName').value = f.name;
  document.getElementById('editDean').value = f.dean ?? '';
  document.getElementById('editModal').style.display = 'flex';
}
function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}
</script>
