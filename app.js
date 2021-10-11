
const quizDuration = 10; // sekundi
const questions = [
    {
      text: "Ko je osnivač kompanije <em>Apple</em>?", 
      answers: {
        a: "Bil Gejts",
        b: "Ilon Maks",
        c: "Stiv Džobs"
      },
      correctAnswer: "c"
    },
    {
      text: "Kako se zvala prva programerka? Jedan progamski jezik nosi njeno ime.",
      answers: {
        a: "Ada Bajron",
        b: "Karmen Elektra",
        c: "Java Script"
      },
      correctAnswer: "a"
    },
    {
      text: "Kako se zove čuveni naučnik o kome govori film <em>The Immitation Game</em> ",
      answers: {
        a: "Nikola Tesla",
        b: "Alen Tjuring",
        c: "Tomas Edison"
      },
      correctAnswer: "b"
    }
];

var quizWrapper = document.getElementById('quizWrapper');
var finishButton = document.getElementById('finishButton');
var resultWrapper = document.getElementById('resultWrapper');
var tryAgainButton = document.getElementById('tryAgainButton');
var timerWrapper = document.getElementById('timerWrapper');

var timeLeft = quizDuration;

function startQuiz(){

  timerWrapper.innerHTML = timeLeft;
  let questionsHtml = [];

  questions.forEach( (question, questionIndex) => {
    
    let answersHtmlTemp = [];
    for(let letter in question.answers){
      let answerHtml = `<label>
                          <input type="radio" name="answer${questionIndex}" value="${letter}" > ${letter} : ${question.answers[letter]}
                        </label>`;
      answersHtmlTemp.push(answerHtml);
    }

    let questionHtmlTemp = `<div class="accordion-item">
                          <h2 class="accordion-header" id="heading${questionIndex}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${questionIndex}" aria-expanded="true" aria-controls="collapseOne">
                              ${question.text}
                            </button>
                          </h2>
                          <div id="collapse${questionIndex}" class="accordion-collapse collapse" aria-labelledby="heading${questionIndex}" data-bs-parent="#quizWrapper">
                            <div class="accordion-body">
                              ${answersHtmlTemp.join('')}
                            </div>
                          </div>
                        </div>`;

    questionsHtml.push(questionHtmlTemp);

  });

  quizWrapper.innerHTML = questionsHtml.join('');
}

function finishQuiz(){

  let points = 0;

  questions.forEach( (question, questionIndex) => {

    let selector = `input[name=answer${questionIndex}]:checked`;
    let playerAnswer = document.querySelector(selector)?.value; // optional chaining

    if(playerAnswer === question.correctAnswer){
      points++;
    }

  });

  let resultClass = "alert-success";
  if(points < 2) resultClass = "alert-danger";
  else if(points == 2) resultClass = "alert-warning";

  resultWrapper.innerHTML = `<h4>Osvojeno poena: ${points} od ${questions.length} </h4>`;
  resultWrapper.classList.add(resultClass);
  finishButton.classList.add('d-none');
  tryAgainButton.classList.remove('d-none');
}

startQuiz();
finishButton.addEventListener('click', finishQuiz);
tryAgainButton.addEventListener('click', () => window.location.reload() );

setTimeout( finishQuiz , quizDuration * 1000);
setInterval( () => {
  
  if(timeLeft == 0){
    timerWrapper.innerHTML = "Vrijeme je isteklo!";
    return;
  }
  
  timeLeft--;
  timerWrapper.innerHTML = timeLeft;

}, 1000);