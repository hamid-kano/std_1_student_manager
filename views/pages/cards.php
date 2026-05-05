<div id="Cards" class="page">

  <div class="card-form" style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px;">
    <input type="text"  id="cardUniversity"  placeholder="اسم الجامعة">
    <input type="file"  id="cardLogo"        accept="image/*">
    <input type="text"  id="cardName"        placeholder="اسم الطالب">
    <input type="text"  id="cardNumber"      placeholder="الرقم الجامعي">
    <input type="text"  id="cardMother"      placeholder="اسم الأم">
    <input type="text"  id="cardBirthPlace"  placeholder="مكان وتاريخ الولادة">
    <input type="text"  id="cardFaculty"     placeholder="الكلية">
    <input type="text"  id="cardDepartment"  placeholder="القسم">
    <input type="date"  id="cardDate">
    <input type="file"  id="cardImage"       accept="image/*">
    <button style="width:auto; padding:10px 20px;" onclick="createCard()">إنشاء البطاقة</button>
  </div>

  <hr>

  <input type="text" id="searchCard" placeholder="🔎 ابحث بالاسم أو الرقم الجامعي"
    onkeyup="searchCard()"
    style="width:100%; padding:10px; margin:10px 0; border-radius:8px; border:1px solid #ccc;">

  <div id="cardsOutput"></div>

</div>
