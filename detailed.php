
<!DOCTYPE html>
<html>
<?php include "header.php"; ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traumatic Brain Injury Diagnostics</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        #spectrum {
            width: 100%;
            height: 20px;
            background: linear-gradient(to right, blue 0%, red 100%);
            position: relative;
        }
        #marker {
            width: 2px;
            height: 20px;
            background-color: black;
            position: absolute;
        }
        #results-text{
            position: absolute;
            background-color: red;
        }
    </style>

</head>
<body>
<div class="mycont">
    <header class="container-fluid bg-primary text-white py-3">
        <div class="container">
        <h1 class="display-4">Traumatic Brain Injury Detailed Assessment</h1>
        <p class="lead">This measures key indicators of brain health, like reaction time and memory</p>
        </div>
    </header>

    <div class="container mt-5">
    <p><a href="index.php">Back to Home</a></p>
        <!-- Reaction Time Game -->
        <div id="reaction-card" class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Reaction Time Test</h5>
                <p class="card-text">Once you begin the game, there will be a blue button that pops up. Click that button as soon as it turns green</p>
                <button id="reaction-button" class = "btn btn-primary" style="display: none;">Click Me When Green</button>
                <button id="start-reaction-button" type = "button" class = "btn btn-primary">Start</button>
            </div>
        </div>

        <!-- Memory Game -->
        <div id="memory-card" class="card" style="display: none;">
            <div class="card-body">
                <h5 class="card-title">Memory Test</h5>
                <p class="card-text">Once you begin the game, there will be a few digits that will be on the screen for 3 seconds. Then, after a 3 second wait, you will have to write down what you remember.</p>
                <p id="digits"></p>
                <input type="text" id="user-input" placeholder="Enter the digits you remember" style="display: none;" class = "form-control">
                <button id="start-memory-button" class = "btn btn-primary">Start</button>
                <button id="submit-button" style = "display: none;" class = "btn btn-success">Submit</button>
            </div>
        </div>

        <!-- Results -->
        <div id="results-card" class="card" style="display: none;">
            <div class="card-body">
                <h5 class="card-title">Results</h5>
                <p id="results"></p>
                <h6>Reaction Time:</h6>
                <div id="spectrum">
                    <div id="marker"></div>
                </div>
                <p id="diagnosis"></p>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include your custom JS -->
    <script>
        // Reaction Time Game
let reactionButton = document.getElementById('reaction-button');
let startReactionButton = document.getElementById('start-reaction-button');
let startTime, endTime;

startReactionButton.onclick = function() {
    startReactionButton.style.display = 'none';
    startReactionGame();
};

function startReactionGame() {
    reactionButton.style.display = 'block';
    let time = Math.random() * 4000 + 1000; // Random time between 1-5 seconds
    setTimeout(function() {
        reactionButton.style.backgroundColor = 'green'; // Change the button color to green
        startTime = Date.now();
    }, time);
}


reactionButton.onclick = function() {
    reactionButton.style.display = 'none';
    endTime = Date.now();
    document.getElementById('reaction-card').style.display = 'none'; // Hide the reaction game
    document.getElementById('memory-card').style.display = 'block'; // Show the memory game
};

// Memory Game
let digits = document.getElementById('digits');
let userInput = document.getElementById('user-input');
let submitButton = document.getElementById('submit-button');
let startMemoryButton = document.getElementById('start-memory-button');
let memoryDigits;

startMemoryButton.onclick = function() {
    startMemoryButton.style.display = 'none';
    startMemoryGame();
};

function startMemoryGame() {
    memoryDigits = Math.floor(10000 + Math.random() * 90000); // Generate a 5-digit number
    digits.innerText = memoryDigits;
    userInput.style.display = 'none'; // Initially hide the text field
    setTimeout(function() {
        digits.innerText = '';
    }, 3000);
    setTimeout(function(){
        userInput.style.display = 'block'; // Show the text field after 3 seconds
        document.getElementById("submit-button").style.display = "block";
    }, 6000)
}


submitButton.onclick = function() {
    let inputDigits = userInput.value;
    document.getElementById('memory-card').style.display = 'none'; // Hide the memory game
    document.getElementById('results-card').style.display = 'block'; // Show the results
    memoryCorrect = 0
    for (digit = 0; digit < inputDigits.length; digit++){
        console.log(inputDigits[digit], memoryDigits[digit])
        if (inputDigits[digit] ==   (memoryDigits).toString()[digit]){memoryCorrect++}
    }
    displayResults()
};

//Results
let results = document.getElementById('results');
let marker = document.getElementById('marker');

function displayResults() {
    let reactionTime = endTime - startTime;
    results.innerText = 'Reaction Time: ' + reactionTime + 'ms\n' +
                        'Memory Success: ' + memoryCorrect + "/5 correct";
    if(memoryCorrect >= 4){
        results.innerText+=" (Average Memory)"
    }
    else if (memoryCorrect == 3){
        results.innerText+=" (Impaired Memory)"
    }
    else{
        results.innerText+= " (Severely Impaired Memory)"
    }

    // Map the reaction time to a percentage of the spectrum width
    let leftPosition = Math.min(Math.max((reactionTime - 300) / 300 * 100, 0), 100);
    marker.style.left = leftPosition + '%';
    // document.getElementById("results-text").style.left =leftPosition + '%';
    let score = memoryCorrect + Math.round((100-leftPosition)/10)
    let diagnosis = document.getElementById("diagnosis")
    if(score > 12){
        diagnosis.innerHTML = "<br>Diagnosis: No Concussion"
    }
    else if (score > 7){
        diagnosis.innerHTML = "<br>Diagnosis: Mild Concussion <br><br> A concussion is a form of mild Traumatic Brain Injury. It is recommended you consult a medical professional. For more information, look at the <a href = 'https://www.cdc.gov/headsup/basics/concussion_whatis.html#:~:text=A%20concussion%20is%20a%20type,move%20rapidly%20back%20and%20forth.'>CDC's</a> website on concussions."
    }
    else{
        diagnosis.innerHTML = "<br>Diagnosis: Serious Concussion or Traumatic Brain Injury <br><br> You display significant impairment in memory and/or reaction time, indicating a concussion or more serious traumatic brain injury. It is recommended you seek a medical professional immediately. For more information, look at the <a href = 'https://www.cdc.gov/headsup/basics/concussion_whatis.html#:~:text=A%20concussion%20is%20a%20type,move%20rapidly%20back%20and%20forth.'>CDC's</a> website on concussions."
    }
}

// Start the first game
document.getElementById('reaction-card').style.display = 'block'; // Show the reaction game

    </script>
</div>
<?php include "footer.php" ?>
</body>
</html>
