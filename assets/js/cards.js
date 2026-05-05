/**
 * cards.js - إدارة البطاقات الجامعية
 */

function createCard() {
  const university = document.getElementById('cardUniversity').value;
  const name       = document.getElementById('cardName').value;
  const number     = document.getElementById('cardNumber').value;
  const mother     = document.getElementById('cardMother').value;
  const birth      = document.getElementById('cardBirthPlace').value;
  const faculty    = document.getElementById('cardFaculty').value;
  const dept       = document.getElementById('cardDepartment').value;
  const date       = document.getElementById('cardDate').value;
  const logoInput  = document.getElementById('cardLogo');
  const imageInput = document.getElementById('cardImage');

  if (!name || !number || !imageInput.files[0]) {
    alert('يرجى إدخال الاسم والرقم الجامعي وصورة الطالب');
    return;
  }

  const readerPhoto = new FileReader();
  readerPhoto.readAsDataURL(imageInput.files[0]);
  readerPhoto.onload = function () {
    const photo = readerPhoto.result;
    if (logoInput.files[0]) {
      const readerLogo = new FileReader();
      readerLogo.readAsDataURL(logoInput.files[0]);
      readerLogo.onload = function () {
        addCardToPage(university, name, number, mother, birth, faculty, dept, date, photo, readerLogo.result);
      };
    } else {
      addCardToPage(university, name, number, mother, birth, faculty, dept, date, photo, '');
    }
  };
}

function addCardToPage(university, name, number, mother, birth, faculty, dept, date, photo, logo) {
  document.getElementById('cardsOutput').innerHTML += `
    <div class="student-card">
      <div class="card-top">
        ${logo ? `<img src="${logo}">` : ''}
        <div class="university-name">${university}</div>
      </div>
      <div class="card-body">
        <div class="card-info">
          <p><strong>الاسم:</strong> ${name}</p>
          <p><strong>الرقم الجامعي:</strong> ${number}</p>
          <p><strong>اسم الأم:</strong> ${mother}</p>
          <p><strong>مكان الولادة:</strong> ${birth}</p>
          <p><strong>الكلية:</strong> ${faculty}</p>
          <p><strong>القسم:</strong> ${dept}</p>
          <p><strong>تاريخ البطاقة:</strong> ${date}</p>
        </div>
        <img src="${photo}" class="student-photo">
      </div>
      <div class="card-actions">
        <button onclick="printCard(this)" style="width:auto; padding:5px 12px;"><i class="fa-solid fa-print"></i> طباعة</button>
        <button onclick="deleteCard(this)" style="width:auto; padding:5px 12px;"><i class="fa-solid fa-trash"></i> حذف</button>
      </div>
    </div>`;
  saveCards();
}

function deleteCard(btn) {
  btn.closest('.student-card').remove();
  saveCards();
}

function printCard(btn) {
  const card = btn.closest('.student-card').outerHTML;
  const win  = window.open('', '', 'width=900,height=900');
  win.document.write(`
    <html><head><title>طباعة بطاقة</title>
    <style>
      body{display:flex;justify-content:center;align-items:center;height:100vh;direction:rtl;}
      .card-actions{display:none!important;}
      .student-card{width:500px;border:2px solid #1e3a8a;border-radius:12px;padding:15px;font-size:14px;}
      .card-top{display:flex;align-items:center;gap:10px;margin-bottom:12px;}
      .card-top img{width:80px;height:80px;border-radius:50%;}
      .university-name{font-weight:bold;font-size:16px;color:#1e3a8a;}
      .card-body{display:flex;gap:15px;margin-top:30px;}
      .student-photo{width:120px;height:140px;object-fit:cover;border-radius:8px;}
      .card-info{flex:1;line-height:1.8;}
    </style></head>
    <body>${card}</body></html>`);
  win.document.close();
  setTimeout(() => win.print(), 500);
}

function searchCard() {
  const input = document.getElementById('searchCard').value.toLowerCase();
  document.querySelectorAll('.student-card').forEach(card => {
    const name   = card.querySelector('.card-info p:nth-child(1)').innerText.toLowerCase();
    const number = card.querySelector('.card-info p:nth-child(2)').innerText.toLowerCase();
    card.style.display = (name.includes(input) || number.includes(input)) ? 'block' : 'none';
  });
}

function saveCards() {
  localStorage.setItem('CardsPage', document.getElementById('cardsOutput').innerHTML);
}

function loadCards() {
  const saved = localStorage.getItem('CardsPage');
  if (saved) document.getElementById('cardsOutput').innerHTML = saved;
}

document.addEventListener('DOMContentLoaded', loadCards);
