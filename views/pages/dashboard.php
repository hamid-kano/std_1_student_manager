<div id="dashboard" class="page active">

  <div class="page-header">
    <h1><i class="fa-solid fa-house"></i> الرئيسية</h1>
    <p>إضافة الأقسام والمدرسين والمقررات</p>
  </div>

  <!-- إضافة قسم -->
  <div class="card">
    <h3><i class="fa-solid fa-folder-plus"></i> إضافة قسم جديد</h3>
    <div class="form-grid">
      <div class="form-group">
        <label>الكلية</label>
        <select id="facultySelect">
          <option disabled selected>اختر الكلية</option>
          <option>كلية العلوم الطبيعية والتكنولوجيا</option>
          <option>كلية الهندسة</option>
          <option>كلية العلوم</option>
        </select>
      </div>
      <div class="form-group">
        <label>اسم القسم</label>
        <input type="text" id="departmentName" placeholder="أدخل اسم القسم">
      </div>
    </div>
    <br>
    <button id="addBtn" class="btn-submit" style="max-width:200px;" onclick="addDepartment()">إضافة القسم</button>
  </div>

  <!-- إضافة مدرس -->
  <div class="card">
    <h3><i class="fa-solid fa-chalkboard-user"></i> إضافة مدرس</h3>
    <div class="form-grid">
      <div class="form-group">
        <label>اسم المدرس</label>
        <input id="staffName" placeholder="الاسم الكامل">
      </div>
      <div class="form-group">
        <label>خريج جامعة</label>
        <input id="staffUniversity" placeholder="اسم الجامعة">
      </div>
      <div class="form-group full">
        <label>الخبرات</label>
        <input id="staffExperience" placeholder="اذكر الخبرات">
      </div>
    </div>
    <br>
    <button class="btn-submit" style="max-width:200px;" onclick="addStaff()">إضافة المدرس</button>
  </div>

  <!-- إضافة مقرر -->
  <div class="card">
    <h3><i class="fa-solid fa-book-medical"></i> إضافة مقرر دراسي</h3>
    <div class="form-grid">
      <div class="form-group">
        <label>القسم</label>
        <select id="courseDept">
          <option disabled selected>اختر القسم</option>
          <option>هندسة الحاسوب</option>
          <option>هندسة اتصالات</option>
          <option>هندسة ميكاترونيك</option>
          <option>بيولوجيا</option>
          <option>رياضيات</option>
          <option>فيزياء</option>
          <option>كيمياء</option>
          <option>بيوكيمياء</option>
        </select>
      </div>
      <div class="form-group">
        <label>السنة الدراسية</label>
        <select id="courseYear">
          <option disabled selected>اختر السنة</option>
          <option>السنة الأولى</option>
          <option>السنة الثانية</option>
          <option>السنة الثالثة</option>
          <option>السنة الرابعة</option>
        </select>
      </div>
      <div class="form-group">
        <label>الفصل الدراسي</label>
        <select id="courseSemester">
          <option disabled selected>اختر الفصل</option>
          <option>الفصل الأول</option>
          <option>الفصل الثاني</option>
        </select>
      </div>
      <div class="form-group">
        <label>اسم المادة</label>
        <input id="courseName" placeholder="أدخل اسم المادة">
      </div>
    </div>
    <br>
    <button class="btn-submit" style="max-width:200px;" onclick="addCourseSystem()">إضافة المادة</button>
  </div>

</div>
