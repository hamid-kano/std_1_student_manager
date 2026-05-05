<div id="dashboard" class="page active">

  <!-- إضافة قسم -->
  <div class="card" style="margin-top:20px;">
    <h3>إضافة قسم جديد</h3><br><br>
    <select id="facultySelect">
      <option disabled selected>اختر الكلية</option>
      <option>كلية العلوم الطبيعية والتكنولوجيا</option>
      <option>كلية الهندسة</option>
      <option>كلية العلوم</option>
    </select>
    <input type="text" id="departmentName" placeholder="اسم القسم">
    <button id="addBtn" onclick="addDepartment()">إضافة القسم</button>
  </div>

  <!-- إضافة مدرس -->
  <div class="card" style="margin-top:25px;">
    <h3>إضافة مدرس</h3><br>
    <input id="staffName" placeholder="اسم المدرس">
    <input id="staffUniversity" placeholder="خريج/ة جامعة">
    <input id="staffExperience" placeholder="الخبرات">
    <button onclick="addStaff()">إضافة المدرس</button>
  </div>

  <!-- إضافة مقرر -->
  <div class="card" style="margin-top:25px;">
    <h3>إضافة مقرر</h3><br>
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
    <select id="courseYear">
      <option disabled selected>اختر السنة</option>
      <option>السنة الأولى</option>
      <option>السنة الثانية</option>
      <option>السنة الثالثة</option>
      <option>السنة الرابعة</option>
    </select>
    <select id="courseSemester">
      <option disabled selected>اختر الفصل</option>
      <option>الفصل الأول</option>
      <option>الفصل الثاني</option>
    </select>
    <input id="courseName" placeholder="اسم المادة">
    <button onclick="addCourseSystem()">إضافة المادة</button>
  </div>

</div>
