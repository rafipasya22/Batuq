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



const questionElement = document.getElementById("question");
const answerButton = document.getElementById("answer-button");
const NxtBtn = document.getElementById("next-btn");
const quiz = document.getElementById("quiz");
const hasil = document.getElementById("score");
const header = document.getElementById("head");
const awal = document.getElementById("awal");
const mulaibtn = document.getElementById("mulai");
const totalque = document.getElementById("Total");
const now = document.getElementById("Now");
const skor = document.getElementById("scoreakhir");
const lanjut = document.getElementById("lanjut");
const menit = document.getElementById("minutes");
const detik = document.getElementById("seconds");
const jam = document.getElementById("hours");
const selesai = document.getElementById("udahan");

function acak(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

let currentQuestionIndex = 0;
let Score = 0;

function startQuiz(){
    currentQuestionIndex = 0;
    Score = 0;
    acak(questions);
    awal.style.display = "none";
    header.style.display = "flex";
    quiz.style.display = "block";
    showquestion();
    
}

function showquestion(){
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    let questionNo = currentQuestionIndex + 1;
    questionElement.innerHTML = questionNo + ". " + currentQuestion.question;
    totalque.innerHTML = questions.length;
    now.innerHTML = questionNo;

    let Jawaban = acak([...currentQuestion.anwers]);

    Jawaban.forEach(answer =>{
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        answerButton.appendChild(button);
        if(answer.correct){
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    });

}

function resetState(){
    NxtBtn.style.display = "none";
    while(answerButton.firstChild){
        answerButton.removeChild(answerButton.firstChild);
    }   
}

function  selectAnswer(e){
    const selectedbtn = e.target;
    const isCorrect = selectedbtn.dataset.correct == "true";
    if(isCorrect){
        selectedbtn.classList.add("correct");
        Score++;
    }else{
        selectedbtn.classList.add("incorrect");
    }
    Array.from(answerButton.children).forEach(button =>{
        if(button.dataset.correct == "true"){
            button.classList.add("correct");
        }
        button.disabled = true;
    });
    NxtBtn.style.display="block";
}



function handleNxtBtn(){
    currentQuestionIndex++;
    if(currentQuestionIndex < questions.length){
        showquestion();
    }else{
        showScore();
    }
}

lanjut.addEventListener("click", ()=>{
    if(SkorAkhir > 80){
        window.location.href = '../Dashboard/Latso_Nun_Sukun.php';
    }else{
        hasil.style.display = "none";
        startQuiz();
        resetCountdown();
        startCountdown();
    }
})

NxtBtn.addEventListener("click", ()=>{
    if(currentQuestionIndex<questions.length){
        handleNxtBtn();
    }else{
        startQuiz();
        
    }
});


mulaibtn.addEventListener("click", ()=>{
    startQuiz();
    startCountdown()
})

let countdown;
let hours = 0
let minutes = 10;
let seconds = 0;

function startCountdown() {
    countdown = setInterval(updateCountdown, 1000);
}
  
function stopCountdown() {
    clearInterval(countdown);
}

function resetCountdown() {
    clearInterval(countdown);
    minutes = 10;
    seconds = 0;
    menit.innerText = formatTime(minutes);
    detik.innerText = formatTime(seconds);
}


  
function formatTime(time) {
    return time < 10 ? '0' + time : time;
}