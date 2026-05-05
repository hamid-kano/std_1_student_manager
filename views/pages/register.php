<?php
$faculties   = $data['faculties']   ?? [];
$departments = $data['departments'] ?? [];
?>

<div class="page-header">
  <h1><i class="fa-solid fa-user-plus"></i> التسجيل الجامعي</h1>
  <p>تسجيل طالب جديد في النظام</p>
</div>

<?php include __DIR__ . '/../layout/flash.php'; ?>

<form method="POST" action="/std_1_student_manager/controllers/router.php"
      enctype="multipart/form-data" id="registerForm">
  <input type="hidden" name="controller" value="students">
  <input type="hidden" name="action"     value="store">

  <div class="form-grid">
    <div class="form-group">
      <label>الرقم الجامعي <span style="color:red">*</span></label>
      <input type="text" name="university_id" placeholder="مثال: 2024001" required>
    </div>
    <div class="form-group">
      <label>الاسم الكامل <span style="color:red">*</span></label>
      <input type="text" name="name" placeholder="الاسم الرباعي" required>
    </div>
    <div class="form-group">
      <label>الكلية <span style="color:red">*</span></label>
      <select name="faculty" required>
        <option value="" disabled selected>اختر الكلية</option>
        <?php foreach ($faculties as $f): ?>
          <option value="<?= htmlspecialchars($f['name']) ?>"><?= htmlspecialchars($f['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>القسم <span style="color:red">*</span></label>
      <select name="department" required>
        <option value="" disabled selected>اختر القسم</option>
        <?php foreach ($departments as $d): ?>
          <option value="<?= htmlspecialchars($d['name']) ?>"><?= htmlspecialchars($d['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>مكان الولادة</label>
      <input type="text" name="birth_place" placeholder="المدينة / المحافظة">
    </div>
    <div class="form-group">
      <label>تاريخ الميلاد</label>
      <input type="date" name="birth_date">
    </div>
    <div class="form-group">
      <label>العنوان</label>
      <input type="text" name="address" placeholder="العنوان الحالي">
    </div>
    <div class="form-group">
      <label>رقم الهاتف</label>
      <input type="text" name="phone" placeholder="09xxxxxxxx">
    </div>
    <div class="form-group">
      <label>اسم الأم</label>
      <input type="text" name="mother_name" placeholder="اسم الأم الكامل">
    </div>
    <div class="form-group">
      <label>اسم الأب</label>
      <input type="text" name="father_name" placeholder="اسم الأب الكامل">
    </div>
    <div class="form-group">
      <label>الجنس</label>
      <select name="gender">
        <option value="ذكر">ذكر</option>
        <option value="أنثى">أنثى</option>
      </select>
    </div>
    <div class="form-group">
      <label>صورة الطالب</label>
      <input type="file" name="image" accept="image/*">
    </div>
  </div>
  <br>
  <button type="submit" class="btn-submit" style="max-width:220px;">
    <i class="fa-solid fa-circle-check"></i> تسجيل الطالب
  </button>
</form>
