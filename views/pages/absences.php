<div id="absences" class="page">

  <div class="page-header">
    <h1><i class="fa-solid fa-calendar-xmark"></i> الغيابات</h1>
    <p>تسجيل ومتابعة غيابات الطلاب</p>
  </div>

  <div class="absence-container">

    <!-- إضافة غياب -->
    <div class="card">
      <h3><i class="fa-solid fa-plus-circle"></i> تسجيل غياب</h3>
      <div class="absence-form">
        <input type="text" id="searchName" placeholder="اسم الطالب">
        <input type="text" id="searchId"   placeholder="الرقم الجامعي">
        <input type="date" id="absenceDate">
        <input type="text" id="absenceSubject" placeholder="اسم المادة">
        <select id="absenceYear">
          <option value="1">السنة 1</option>
          <option value="2">السنة 2</option>
          <option value="3">السنة 3</option>
          <option value="4">السنة 4</option>
        </select>
        <select id="absenceSemester">
          <option value="أول">أول</option>
          <option value="ثاني">ثاني</option>
        </select>
        <button onclick="addAbsence()">
          <i class="fa-solid fa-floppy-disk"></i> حفظ
        </button>
      </div>
    </div>

    <!-- بحث سريع -->
    <div class="filters-bar" style="margin-top:16px;">
      <input type="text" id="absenceSearch" placeholder="ابحث بالاسم أو الرقم الجامعي...">
    </div>

    <!-- جدول -->
    <div class="card">
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>الاسم</th>
              <th>الرقم الجامعي</th>
              <th>تاريخ الغياب</th>
              <th>المادة</th>
              <th>السنة</th>
              <th>الفصل</th>
              <th><i class="fa-solid fa-pen"></i></th>
              <th><i class="fa-solid fa-trash"></i></th>
            </tr>
          </thead>
          <tbody id="absenceTable"></tbody>
        </table>
      </div>
    </div>

  </div>
</div>
