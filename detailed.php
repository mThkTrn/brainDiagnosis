<!DOCTYPE html>
<html>
<head>
    <title>Traumatic Brain Injury Diagnostics</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        #spectrum {
            width: 100%;
            height: 20px;
            background: linear-gradient(to right, red 0%, red 40%, green 15%, green 30%, blue 30%);
            position: relative;
        }
        #marker {
            width: 2px;
            height: 20px;
            background: black;
            position: absolute;
        }
    </style>

</head>
<body>
    <div class="container">
        <!-- Reaction Time Game -->
        <div id="reaction-card" class="card">
            <div class="card-body">
                <h5 class="card-title">Reaction Time Game</h5>
                <p class="card-text">Click the button as soon as it turns green.</p>
                <button id="reaction-button" style="display: none;">Click Me When Green</button>
                <button id="start-reaction-button">Start</button>
            </div>
        </div>

        <!-- Memory Game -->
        <div id="memory-card" class="card" style="display: none;">
            <div class="card-body">
                <h5 class="card-title">Memory Game</h5>
                <p class="card-text">Memorize the following digits:</p>
                <p id="digits"></p>
                <input type="text" id="user-input" placeholder="Enter the digits you remember" style="display: none;">
                <button id="start-memory-button">Start</button>
                <button id="submit-button">Submit</button>
            </div>
        </div>

        <!-- Results -->
        <div id="results-card" class="card" style="display: none;">
            <div class="card-body">
                <h5 class="card-title">Results</h5>
                <p id="results"></p>
                <div id="spectrum">
                    <div id="marker"></div>
                </div>
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
        userInput.style.display = 'block'; // Show the text field after 3 seconds
    }, 3000);
}


submitButton.onclick = function() {
    let inputDigits = userInput.value;
    document.getElementById('memory-card').style.display = 'none'; // Hide the memory game
    document.getElementById('results-card').style.display = 'block'; // Show the results
    displayResults(inputDigits == memoryDigits); // Display the results
};

//Results
let results = document.getElementById('results');
let marker = document.getElementById('marker');

function displayResults(memorySuccess) {
    let reactionTime = endTime - startTime;
    results.innerText = 'Reaction Time: ' + reactionTime + 'ms\n' +
                        'Memory Success: ' + (memorySuccess ? 'Yes' : 'No');

    // Map the reaction time to a percentage of the spectrum width
    let leftPosition = Math.min(Math.max((reactionTime - 150) / 350 * 100, 0), 100);
    marker.style.left = leftPosition + '%';
}

// Start the first game
document.getElementById('reaction-card').style.display = 'block'; // Show the reaction game

    </script>
</body>
</html>

