<div id="absences" class="page">
  <div class="absence-container">

    <!-- بحث -->
    <div class="search-box" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:15px;">
      <input type="text" id="searchName" placeholder="اسم الطالب" onkeyup="filterAbsences()">
      <input type="text" id="searchId"   placeholder="الرقم الجامعي" onkeyup="filterAbsences()">
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
    </div>

    <!-- إضافة -->
    <div class="absence-form" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:15px;">
      <input type="date" id="absenceDate">
      <input type="text" id="absenceSubject" placeholder="اسم المادة">
      <button style="width:auto; padding:8px 16px;" onclick="addAbsence()">حفظ</button>
    </div>

    <!-- بحث سريع -->
    <input type="text" id="absenceSearch" placeholder="ابحث بالاسم أو الرقم الجامعي..."
      style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc; margin-bottom:15px;">

    <!-- جدول -->
    <table>
      <thead>
        <tr>
          <th>الاسم</th>
          <th>الرقم الجامعي</th>
          <th>تاريخ الغياب</th>
          <th>المادة</th>
          <th>السنة</th>
          <th>الفصل</th>
          <th>✏️</th>
          <th>🗑️</th>
        </tr>
      </thead>
      <tbody id="absenceTable"></tbody>
    </table>

  </div>
</div>
