<div id="register" class="page">

  <div class="page-header">
    <h1><i class="fa-solid fa-user-plus"></i> التسجيل الجامعي</h1>
    <p>تسجيل طالب جديد في النظام</p>
  </div>

  <form id="form">
    <div class="form-group full">
      <label>صورة الطالب</label>
      <input type="file" accept="image/*">
    </div>
    <div class="form-group">
      <label>الرقم الجامعي</label>
      <input placeholder="مثال: 2024001" required>
    </div>
    <div class="form-group">
      <label>الاسم الكامل</label>
      <input placeholder="الاسم الرباعي" required>
    </div>
    <div class="form-group">
      <label>الكلية</label>
      <select required>
        <option disabled selected>اختر الكلية</option>
        <option>كلية العلوم الطبيعية والتكنولوجيا</option>
        <option>كلية الهندسة</option>
        <option>كلية العلوم</option>
      </select>
    </div>
    <div class="form-group">
      <label>القسم</label>
      <select required>
        <option disabled selected>اختر القسم</option>
        <option>هندسة الحاسوب</option>
        <option>هندسة اتصالات</option>
        <option>هندسة ميكاترونيك</option>
        <option>بيوكيمياء</option>
        <option>رياضيات</option>
        <option>كيمياء</option>
        <option>فيزياء</option>
        <option>بيولوجيا</option>
      </select>
    </div>
    <div class="form-group">
      <label>مكان الولادة</label>
      <input placeholder="المدينة / المحافظة">
    </div>
    <div class="form-group">
      <label>تاريخ الميلاد</label>
      <input type="date">
    </div>
    <div class="form-group">
      <label>بلد / العنوان</label>
      <input placeholder="العنوان الحالي">
    </div>
    <div class="form-group">
      <label>رقم الهاتف</label>
      <input placeholder="09xxxxxxxx">
    </div>
    <div class="form-group">
      <label>اسم الأم</label>
      <input placeholder="اسم الأم الكامل">
    </div>
    <div class="form-group">
      <label>اسم الأب</label>
      <input placeholder="اسم الأب الكامل">
    </div>
    <div class="form-group">
      <label>الجنس</label>
      <select id="editGender">
        <option value="ذكر">ذكر</option>
        <option value="أنثى">أنثى</option>
      </select>
    </div>
    <button type="button" onclick="addStudentFromRegister()">
      <i class="fa-solid fa-circle-check"></i> تسجيل الطالب
    </button>
  </form>

</div>
