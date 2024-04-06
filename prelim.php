<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TBI Preliminary Assessment</title>
</head>
<body>
  <header class="container-fluid bg-primary text-white py-3">
    <div class="container">
      <h1 class="display-4">Traumatic Brain Injury Preliminary Assessment</h1>
      <p class="lead">This is a first screening to identify whether the traumatic brain injury is mild, moderate or severe</p>
    </div>
  </header>
  <main class="container mt-5">
  <p><a href="index.php">Back to Home</a></p>
    <div id="question-card" class="card mb-5 p-3 text-center">
      </div>
    <div id="result" style="display: none;">
      <h2>Your Results</h2>
      <p id="result-text"></p>
    </div>
  </main>
  <script>
    const questionsData = [
  { question: "Do the eyes open?",
    description: "If the eyes do not spontaneously open, prompt the subject to open their eyes. If they do not open their eyes upon prompting, apply pressure on the fingertips.",
    answers: [
      { text: "Eyes open spontaneously", value: 4 },
      { text: "Eyes open when asked to", value: 3 },
      { text: "Eyes open to pain only", value: 2 },
      { text: "No response/don't open", value: 1 },
    ]
  },
  { question: "Do they respond when asked something?",
    description: "Ask the subject their name and the day of the week; record their response",
    answers: [
      { text: "They respond clearly and show they are aware", value: 5 },
      { text: "They respond in a confused manner (e.g. wrong information given)", value: 4 },
      { text: "They respond comprehensibly, but without meaning", value: 3 },
      { text: "They respond incomprehensibly and nonverbally", value: 2 },
      { text: "No response", value: 1 },
    ]
  },
  { question: "Do they demonstrate motor responses?",
    description: "Ask the subject to move. If they do not respond, apply pressure on the fingertips",
    answers: [
      { text: "They follow instructions on how and where to move", value: 6 },
      { text: "They intentionally move away from point of pressure", value: 5 },
      { text: "They reflexively move away from point of pressure", value: 4 },
      { text: "They reflexively flex muscles inwards in response to pressure", value: 2 },
      { text: "They reflexively extend muscles in reponse to pressure", value: 2 },
      { text: "No response", value: 1 },
    ]
  },
  { question: "Do pupils respond to light?",
    description: "Shine a light in the eyes of the subject; record their response, noting if the pupil dilates.",
    answers: [
      { text: "Both pupils react to light", value: 0 },
      { text: "One pupil reacts to light", value: -1 },
      { text: "Neither pupil reacts to light", value: -2 }
    ]
  }
];

let currentQuestionIndex = 0;
let score = 0;

function showQuestionCard() {
  const questionCard = document.getElementById('question-card');
  questionCard.innerHTML = ""; // Clear previous question content

  const questionData = questionsData[currentQuestionIndex];
  const questionText = document.createElement('h3');
  questionText.classList.add('question');
  questionText.innerText = questionData.question;

  const questionDescription =document.createElement('p');
  //questionDescription.classList.add('')
  questionDescription.innerText = questionData.description;

  const answerContainer = document.createElement('div');
  answerContainer.classList.add('btncont', 'text-center');

  questionData.answers.forEach(answer => {
    const answerButton = document.createElement('button');
    answerButton.classList.add('btn', 'btn-primary', 'answer-button');
    answerButton.innerText = answer.text;
    answerButton.dataset.value = answer.value;
    answerButton.addEventListener('click', handleAnswerClick);
    answerContainer.appendChild(answerButton);
  });

  questionCard.appendChild(questionText);
  questionCard.appendChild(questionDescription);
  questionCard.appendChild(answerContainer);
}

function handleAnswerClick(event) {
  const answerButton = event.target;
  score += parseInt(answerButton.dataset.value);

  currentQuestionIndex++;

  if (currentQuestionIndex < questionsData.length) {
    showQuestionCard();
  } else {
    showResults();
  }
}

function showResults() {
  const questionCard = document.getElementById('question-card');
  questionCard.style.display = 'none';

  const resultText = document.getElementById('result-text');
  let severity;
  if (score >= 13) {
    severity = 'Mild/None';
  } else if (score >= 9) {
    severity = 'Moderate';
  } else {
    severity = 'Severe (Seek immediate medical attention)';
  }
  resultText.innerText = `This assessment suggests a potentially ${severity} Traumatic Brain Injury. Remember, this is not a diagnosis. Please consult a doctor for a proper evaluation and treatment plan.`;

  const resultDiv = document.getElementById('result');
  resultDiv.style.display = 'block';
}

showQuestionCard(); // Display the first question card

  </script>
</body>
</html>
