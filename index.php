<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $name; ?></title>
</head>
<body>
  <header class="container-fluid bg-primary text-white py-3">
    <div class="container">
      <h1 class="display-4"><?php echo $name; ?></h1>
      <p class="lead">This web app screens for Traumatic Brain Injury (TBI).</p>
    </div>
  </header>
  <main class="container mt-5">
    <p class="lead">Have you experienced a blow to the head and are concerned about a potential TBI (Traumatic Brain Injury)? This app can help with a preliminary assessment. Answer a series of questions to better understand your risk of TBI. Remember, this assessment is not a substitute for professional medical advice. Always consult a doctor for a proper diagnosis and treatment plan.</p>
    <a href="prelim.php" class="btn btn-primary btn-lg mt-3">Begin Diagnosis</a>
  </main>
</body>
</html>
