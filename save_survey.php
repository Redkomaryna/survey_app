<?php
$pdo = new PDO("mysql:host=localhost;dbname=survey_app", "root", "");

// Зберігаємо опитування
$title = $_POST['survey_title'];
$stmt = $pdo->prepare("INSERT INTO surveys (title) VALUES (?)");
$stmt->execute([$title]);
$survey_id = $pdo->lastInsertId();

// Зберігаємо питання та відповіді
foreach ($_POST['questions'] as $index => $question_text) {
    $stmt = $pdo->prepare("INSERT INTO questions (survey_id, question_text) VALUES (?, ?)");
    $stmt->execute([$survey_id, $question_text]);
    $question_id = $pdo->lastInsertId();

    foreach ($_POST['answers'][$index] as $answer_text) {
        $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text) VALUES (?, ?)");
        $stmt->execute([$question_id, $answer_text]);
    }
}

echo "Survey created successfully!";
?>
