<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TBI Preliminary Assessment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ZenhVNpHmPQ0oW9R7vZc6iIWkTKN9s7XhxaAOGxW4zBpOpVr4kB44zWKIjT8qZst" crossorigin="anonymous">
  <style>
    .question {
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <header class="container-fluid bg-primary text-white py-3">
    <div class="container d-flex justify-content-between">
      <h1 class="display-4">TBI Preliminary Assessment</h1>
      <p class="lead">This web app offers a non-official screening for Traumatic Brain Injury (TBI).</p>
    </div>
  </header>
  <main class="container mt-5">
    <p class="lead">Answer the following questions to assess your risk of TBI. Remember, this is not a substitute for professional medical advice. Always consult a doctor for a proper diagnosis and treatment plan.</p>
    <div id="questions">
      <p class="question">1. Best Eye Response (Open eyes spontaneously, Opens to verbal command, Opens to pain only, No response)</p>
      <div class="btn-group" role="group" aria-labelledby="eyeResponse">
        <button type="button" class="btn btn-primary eye-answer" data-value="4">Spontaneously</button>
        <button type="button" class="btn btn-primary eye-answer" data-value="3">Verbal Command</button>
        <button type="button" class="btn btn-primary eye-answer" data-value="2">Pain Only</button>
        <button type="button" class="btn btn-primary eye-answer" data-value="1">No Response</button>
      </div>
      <p class="question" id="last-question">4. Verbal Response (Oriented, Confused, Inappropriate words/sounds, Incomprehensible sounds, No response)</p>
      <div class="btn-group" role="group" aria-labelledby="verbalResponse">
        <button type="button" class="btn btn-primary verbal-answer" data-value="5">Oriented</button>
        <button type="button" class="btn btn-primary verbal-answer" data-value="4">Confused</button>
        <button type="button" class="button btn-primary verbal-answer" data-value="3">Inappropriate</button>
        <button type="button" class="btn btn-primary verbal-answer" data-value="2">Incomprehensible</button>
        <button type="button" class="btn btn-primary verbal-answer" data-value="1">No Response</button>
      </div>
    </div>
    <div id="result" style="display: none;">
      <h2>Your Results</h2>
      <p id="result-text"></p>
    </div>
    <button type="button" class="btn btn-primary btn-lg mt-3" id="submit-button">Submit Answers</button>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERHpONANibvNvt/y1OoQv+mFFw7aNqTp3z8xC0eIlhOFxc4liu9jIK1NznmOM8" crossorigin="anonymous"></script>
  <script>
    const questions = document.getElementById('questions');
    const submitButton = document.getElementById('submit-button');
    const result = document.getElementById('result');
    const resultText = document.getElementById('result-text');
    let score = 0; // Initialize score variable

    // Add click event listener to answer buttons
    const eyeAnswers = document.querySelectorAll('.eye-answer');
    eyeAnswers.forEach(button => button.addEventListener('click', function() {
    score += parseInt(this.dataset.value); // Update score based on button value
    // Hide current question and show next question (if any)
    questions.firstElementChild.style.display = 'none';
    const nextQuestion = questions.querySelector('.question:not([style*="display"])');
    if (nextQuestion) {
        nextQuestion.style.display = 'block';
    }
    }));

    // Add click event listener to submit button
    submitButton.addEventListener('click', function() {
    // Hide questions and show result
    questions.style.display = 'none';
    submitButton.style.display = 'none';
    result.style.display = 'block';

    // Calculate TBI severity based on score
    let severity;
    if (score >= 13) {
        severity = 'Mild';
    } else if (score >= 9) {
        severity = 'Moderate';
    } else {
        severity = 'Severe (Seek immediate medical attention!)';
    }

    // Display result text
    resultText.innerText = `Your score is ${score}. This assessment suggests a potential ${severity} TBI. Remember, this is not a diagnosis. Please consult a doctor for a proper evaluation and treatment plan.`;
    });

