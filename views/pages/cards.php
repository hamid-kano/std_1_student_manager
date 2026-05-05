<div class="page-header">
  <h1><i class="fa-solid fa-id-card"></i> البطاقات الجامعية</h1>
  <p>إنشاء وطباعة بطاقات هوية الطلاب</p>
</div>





<!-- فورم الإنشاء -->
<div class="card">
  <h3><i class="fa-solid fa-plus-circle"></i> إنشاء بطاقة جديدة</h3>
  <br>
  <div class="form-grid">
    <div class="form-group">
      <label>اسم الجامعة</label>
      <input type="text" id="cardUniversity" placeholder="اسم الجامعة">
    </div>
    <div class="form-group">
      <label>شعار الجامعة</label>
      <input type="file" id="cardLogo" accept="image/*">
    </div>
    <div class="form-group">
      <label>اسم الطالب</label>
      <input type="text" id="cardName" placeholder="الاسم الكامل">
    </div>
    <div class="form-group">
      <label>الرقم الجامعي</label>
      <input type="text" id="cardNumber" placeholder="الرقم الجامعي">
    </div>
    <div class="form-group">
      <label>اسم الأم</label>
      <input type="text" id="cardMother" placeholder="اسم الأم">
    </div>
    <div class="form-group">
      <label>مكان وتاريخ الولادة</label>
      <input type="text" id="cardBirthPlace" placeholder="مكان وتاريخ الولادة">
    </div>
    <div class="form-group">
      <label>الكلية</label>
      <input type="text" id="cardFaculty" placeholder="الكلية">
    </div>
    <div class="form-group">
      <label>القسم</label>
      <input type="text" id="cardDepartment" placeholder="القسم">
    </div>
    <div class="form-group">
      <label>تاريخ البطاقة</label>
      <input type="date" id="cardDate">
    </div>
    <div class="form-group">
      <label>صورة الطالب</label>
      <input type="file" id="cardImage" accept="image/*">
    </div>
  </div>
  <br>
  <button class="btn-submit" style="max-width:220px;" onclick="createCard()">
    <i class="fa-solid fa-id-card"></i> إنشاء البطاقة
  </button>
</div>

<!-- بحث -->
<div class="filters-bar" style="margin-top:20px;">
  <input type="text" id="searchCard"
         placeholder="ابحث بالاسم أو الرقم الجامعي..."
         onkeyup="searchCard()"
         style="max-width:400px;">
</div>

<!-- البطاقات -->
<div id="cardsOutput"></div>

<!-- تحميل cards.js فقط في هذه الصفحة -->
<script src="<?= ASSETS_URL ?>/js/cards.js"></script>
