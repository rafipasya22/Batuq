const activepage = window.location.pathname;
const sideMenu = document.querySelector("aside");
const hehe = document.getElementById("sub-menu-wrap");
const MenuBtn = document.querySelector("#menu-btn");
const CloseBtn = document.querySelector("#close-btn");
const Toggler = document.querySelector(".theme-toggler");
const links = document.querySelectorAll('.link');
const DropBtn = document.querySelector("#drop-btn");
const CloseBtn2 = document.querySelector("#close-btn2");


MenuBtn.addEventListener('click', ()=>{
    sideMenu.style.display = 'block';
})

CloseBtn.addEventListener('click', ()=>{
    sideMenu.style.display = 'none';
})

const isDarkMode = localStorage.getItem('darkMode') === 'true';

if (isDarkMode) {
    document.body.classList.add('dark-theme-variables');
    Toggler.querySelector('span:nth-child(1)').classList.toggle('active');
    Toggler.querySelector('span:nth-child(2)').classList.toggle('active');
}


Toggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');


    Toggler.querySelector('span:nth-child(1)').classList.toggle('active');
    Toggler.querySelector('span:nth-child(2)').classList.toggle('active');

    const isDarkModeNow = document.body.classList.contains('dark-theme-variables');
    localStorage.setItem('darkMode', isDarkModeNow);
});



if (links.length) {
    links.forEach((link) => {
      link.addEventListener('click', (e) => {
        links.forEach((link) => {
            link.classList.remove('active');
        });
        link.classList.add('active');
      });
    });
  }

  
DropBtn.addEventListener('click', ()=>{
    hehe.style.display = 'block';
})

CloseBtn2.addEventListener('click', ()=>{
    hehe.style.display = 'none';
})

let currentSurahNumber = null; 

function sendData(surahNumber) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'Baca_Quran.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          
      }
  };
  xhr.send('surahNumber=' + encodeURIComponent(surahNumber));
}

const previousButton = document.getElementById("sebelumnya");
const nextButton = document.getElementById("selanjutnya");
const balikdaftar = document.getElementById("kembali");

previousButton.addEventListener("click", () => {
    if (currentSurahNumber > 1) { 
      sendData(currentSurahNumber - 1);
        showSurah(currentSurahNumber - 1);
        
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
});

nextButton.addEventListener("click", () => {
    if (currentSurahNumber < 114) { 
      sendData(currentSurahNumber + 1);
        showSurah(currentSurahNumber + 1);
        
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
});

    document.getElementById("kembali").style.display = "none";
    previousButton.style.display = "none";
    nextButton.style.display = "none";



  async function showSurah(surahNumber) {
    currentSurahNumber = surahNumber;
    const url = `http://api.alquran.cloud/v1/surah/${surahNumber}/editions/quran-simple,id.indonesian`;

    try {
      const response = await fetch(url);

      if (response.ok) {
        const data = await response.json();

        

        document.getElementById("surah-list").style.display = "none"; 
        if(currentSurahNumber == 1){
          document.getElementById("sebelumnya").style.display = "none";
          document.getElementById("kembali").style.display = "block";
          document.getElementById("selanjutnya").style.display = "block";
        }else if(currentSurahNumber == 114){
          document.getElementById("sebelumnya").style.display = "block"; 
          document.getElementById("kembali").style.display = "block";
          document.getElementById("selanjutnya").style.display = "none";
        }else{
          document.getElementById("kembali").style.display = "block";
          document.getElementById("selanjutnya").style.display = "block";
          document.getElementById("sebelumnya").style.display = "block"; 
        }
        

        const surahContent = document.getElementById("surah-content");
        surahContent.innerHTML = ""; 

        const surahTitle = document.createElement("h2");
        surahTitle.textContent = `${data.data[0].englishName} (${data.data[0].name})`; 
        surahContent.appendChild(surahTitle);

        const surahName = `${data.data[0].englishName} (${data.data[0].name})`;


        localStorage.setItem('currentSurahName', surahName); 
        localStorage.setItem('surah_number', surahNumber);

        data.data[1].ayahs.forEach((ayah, index) => { 
          const ayatElement = document.createElement("div");
          ayatElement.className = 'ayatt';
          ayatElement.innerHTML = `<strong>Ayat ${index + 1}</strong>: <p>${data.data[0].ayahs[index].text}</p>Artinya: ${ayah.text}`;
          surahContent.appendChild(ayatElement);
        });

        surahContent.style.display = "block"; 
      } else {
        console.error("Gagal mendapatkan data dari API");
      }
    } catch (error) {
      console.error("Terjadi kesalahan:", error);
    }
  }

  function goBack() {
    document.getElementById("surah-list").style.display = "block";
    document.getElementById("surah-content").style.display = "none"; 
    document.getElementById("kembali").style.display = "none";
    previousButton.style.display = "none";
    nextButton.style.display = "none";
    currentSurahNumber = null;
  }

  window.onload = function() {
    getSurahList();
  };