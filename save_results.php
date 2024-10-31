<?php
$pdo = new PDO("mysql:host=localhost;dbname=survey_app", "root", "");

foreach ($_POST['answers'] as $question_id => $answer_id) {
    $stmt = $pdo->prepare("INSERT INTO results (answer_id) VALUES (?)");
    $stmt->execute([$answer_id]);
}

echo "Thank you for participating!";
?>
