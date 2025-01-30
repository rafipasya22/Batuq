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