<div id="grades" class="page">

  <!-- زر طباعة الكل -->
  <div style="margin-bottom:15px; text-align:center;">
    <button onclick="printAllStudents()" style="width:auto; padding:10px 20px;">🖨️ طباعة جميع الطلاب</button>
  </div>

  <!-- فورم إضافة علامة -->
  <form id="addGradeForm">
    <label>الرقم الجامعي: <input type="text" id="studentId" required></label>
    <label>الاسم: <input type="text" id="studentName" required></label>
    <label>السنة:
      <select id="year">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
    </label>
    <label>الفصل:
      <select id="semester">
        <option value="أول">أول</option>
        <option value="ثاني">ثاني</option>
      </select>
    </label>
    <label>المادة: <input type="text" id="subject" required></label>
    <label>العلامة: <input type="number" id="grade" min="0" max="100" required></label>
    <label>القسم:
      <select id="studentDepartment" required>
        <option value="هندسة الحاسوب">هندسة الحاسوب</option>
        <option value="هندسة اتصالات">هندسة اتصالات</option>
        <option value="هندسة ميكاترونيك">هندسة ميكاترونيك</option>
        <option value="بيولوجيا">بيولوجيا</option>
        <option value="رياضيات">رياضيات</option>
        <option value="فيزياء">فيزياء</option>
        <option value="كيمياء">كيمياء</option>
        <option value="بيوكيمياء">بيوكيمياء</option>
      </select>
    </label>
    <button type="submit">إضافة</button>
  </form>

  <hr style="margin:20px 0;">

  <!-- بحث وفلتر -->
  <div style="margin-bottom:15px; text-align:center;">
    <input type="text" id="gradesSearchName" placeholder="ابحث بالاسم"
      style="padding:6px 10px; width:200px; margin-right:10px;">
    <input type="text" id="gradesSearchId" placeholder="ابحث بالرقم الجامعي"
      style="padding:6px 10px; width:200px;">
  </div>

  <label>فلترة حسب القسم:</label>
  <select id="departmentFilters" onchange="filterByDepartment()">
    <option value="all">عرض الكل</option>
    <option value="هندسة الحاسوب">هندسة الحاسوب</option>
    <option value="هندسة اتصالات">هندسة اتصالات</option>
    <option value="هندسة ميكاترونيك">هندسة ميكاترونيك</option>
    <option value="بيولوجيا">بيولوجيا</option>
    <option value="رياضيات">رياضيات</option>
    <option value="فيزياء">فيزياء</option>
    <option value="كيمياء">كيمياء</option>
    <option value="بيوكيمياء">بيوكيمياء</option>
  </select>
  <button onclick="printFiltered()" style="width:auto; padding:8px 16px; margin-right:10px;">طباعة القسم</button>

  <br><br>

  <!-- جداول الطلاب -->
  <div id="studentsTables"></div>

</div>
