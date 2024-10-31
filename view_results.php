<?php
$pdo = new PDO("mysql:host=localhost;dbname=survey_app", "root", "");

$survey_id = $_GET['survey_id'];
$stmt = $pdo->prepare("SELECT * FROM questions WHERE survey_id = ?");
$stmt->execute([$survey_id]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $question) {
    echo "<h3>{$question['question_text']}</h3>";

    $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->execute([$question['id']]);
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($answers as $answer) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM results WHERE answer_id = ?");
        $stmt->execute([$answer['id']]);
        $count = $stmt->fetchColumn();

        echo "{$answer['answer_text']}: {$count} votes<br>";
    }
}
?>
