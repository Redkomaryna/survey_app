<?php
$pdo = new PDO("mysql:host=localhost;dbname=survey_app", "root", "");

// Вибираємо опитування
$survey_id = $_GET['survey_id'];
$stmt = $pdo->prepare("SELECT * FROM questions WHERE survey_id = ?");
$stmt->execute([$survey_id]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="save_results.php" method="post">
    <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
    <?php foreach ($questions as $question): ?>
        <h3><?php echo $question['question_text']; ?></h3>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
        $stmt->execute([$question['id']]);
        $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($answers as $answer): ?>
            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="<?php echo $answer['id']; ?>" required>
            <?php echo $answer['answer_text']; ?><br>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <input type="submit" value="Submit">
</form>
