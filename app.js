
const questions = [
  {
    topic: "Pogodite grad u Crnoj Gori",
    words: [
      "podgorica",
      "budva",
      "bar",
      "kolašin",
      "danilovgrad",
      "tivat",
      "kotor"
    ]
  },
  {
    topic: "Pogodite programski jezik",
    words:[
      "javascript",
      "php",
      "cpp",
      "csharp",
      "kotlin"
    ]
  }
];
const letters = ['a','b','c','č','ć','d','dž','đ','e','f','g','h','i','j','k','l','lj','m','n','nj','o','p','r','s','š','t','u','v','z','ž'];

let mistakes = 0;
const maxMistakes = 6;
let currentWord = null;
let wordToGuess = null;
let pickedLetters = [];

function generateKeyboard(){
  let keyboardHTML = [];
  letters.forEach( letter => {
    keyboardHTML.push(
      `<button id="letter_${letter}" class="btn btn-primary m-2" onClick="pickLetter('${letter}')" >${letter}</button>`
    );
  });
  document.getElementById("keyboard").innerHTML = keyboardHTML.join('');
}

function pickRandomWord(){
  let question = randomElement(questions);
  wordToGuess = randomElement(question.words);

  document.getElementById("topicName").innerHTML = question.topic;
  displayWordToGuess();
}

function pickLetter(letter){

  pickedLetters.push(letter);
  document.getElementById("letter_"+letter).setAttribute('disabled', true);

  if(wordToGuess.includes(letter)){
    correctLetter();
    checkVictory();
  }else{
    mistakes++;
    updateMistakes();
    updateImage();
    checkLoss();
  }
}

function randomElement(array){
  return array[ Math.floor( Math.random() * array.length ) ];
}

function displayWordToGuess(){
  let result = "";
  for(let i = 0; i < wordToGuess.length; i++) result += "_";
  document.getElementById("wordToGuess").innerHTML = result;
}

function correctLetter(){

  currentWord = "";
  let answerTemp = wordToGuess.split('');

  answerTemp.forEach( letter => {
    if(pickedLetters.indexOf(letter) >= 0) currentWord += letter;
    else currentWord += "_";
  });

  document.getElementById("wordToGuess").innerHTML = currentWord;
}

function checkVictory(){
  if(currentWord === wordToGuess){
    document.getElementById("keyboard").innerHTML = `<div class="my-3 alert alert-success text-center" >Bravo! Pogodili ste riječ!!!</div>` ;
  }
}

function updateMistakes(){
  document.getElementById("mistakeNum").innerHTML = mistakes;
}

function updateImage(){
  document.getElementById("gameImage").src = './img/'+mistakes+'.png';
}

function checkLoss(){
  if(mistakes === maxMistakes){
    document.getElementById("wordToGuess").innerHTML = `Tražena riječ je: <br/> ${wordToGuess}`;
    document.getElementById("keyboard").innerHTML = "";
  }
}

function resetGame(){
  
  mistakes = 0;
  pickedLetters = [];
  
  pickRandomWord();
  displayWordToGuess();

  updateMistakes();
  updateImage();
  generateKeyboard();

}

generateKeyboard();
pickRandomWord();