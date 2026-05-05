<div id="grades" class="page">

  <div class="page-header">
    <h1><i class="fa-solid fa-chart-bar"></i> العلامات</h1>
    <p>إدارة علامات الطلاب وحساب المعدلات</p>
  </div>

  <!-- أزرار الطباعة -->
  <div style="margin-bottom:16px; display:flex; gap:10px; flex-wrap:wrap;">
    <button onclick="printAllStudents()" style="width:auto; padding:9px 18px; background:#1e293b; color:white; border:none; border-radius:10px; font-family:var(--font); font-weight:600; cursor:pointer;">
      <i class="fa-solid fa-print"></i> طباعة جميع الطلاب
    </button>
  </div>

  <!-- فورم إضافة علامة -->
  <form id="addGradeForm">
    <label>الرقم الجامعي <input type="text" id="studentId" required></label>
    <label>الاسم         <input type="text" id="studentName" required></label>
    <label>السنة
      <select id="year">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
    </label>
    <label>الفصل
      <select id="semester">
        <option value="أول">أول</option>
        <option value="ثاني">ثاني</option>
      </select>
    </label>
    <label>المادة   <input type="text" id="subject" required></label>
    <label>العلامة  <input type="number" id="grade" min="0" max="100" required></label>
    <label>القسم
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
    <button type="submit"><i class="fa-solid fa-plus"></i> إضافة</button>
  </form>

  <hr style="margin:24px 0; border-color:#f1f5f9;">

  <!-- بحث وفلتر -->
  <div class="filters-bar">
    <input type="text" id="gradesSearchName" placeholder="ابحث بالاسم">
    <input type="text" id="gradesSearchId"   placeholder="ابحث بالرقم الجامعي">
    <select id="departmentFilters" onchange="filterByDepartment()">
      <option value="all">كل الأقسام</option>
      <option value="هندسة الحاسوب">هندسة الحاسوب</option>
      <option value="هندسة اتصالات">هندسة اتصالات</option>
      <option value="هندسة ميكاترونيك">هندسة ميكاترونيك</option>
      <option value="بيولوجيا">بيولوجيا</option>
      <option value="رياضيات">رياضيات</option>
      <option value="فيزياء">فيزياء</option>
      <option value="كيمياء">كيمياء</option>
      <option value="بيوكيمياء">بيوكيمياء</option>
    </select>
    <button onclick="printFiltered()" style="width:auto; padding:9px 16px; background:var(--primary); color:white; border:none; border-radius:10px; font-family:var(--font); font-weight:600; cursor:pointer;">
      <i class="fa-solid fa-print"></i> طباعة القسم
    </button>
  </div>

  <div id="studentsTables"></div>

</div>
