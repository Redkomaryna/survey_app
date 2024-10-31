<!DOCTYPE html>
<html>
<head>
    <title>Create Survey</title>
</head>
<body>
    <h2>Create a New Survey</h2>
    <form action="save_survey.php" method="post">
        <label>Survey Title:</label>
        <input type="text" name="survey_title" required><br><br>
        
        <div id="questions">
            <h3>Questions</h3>
            <div class="question">
                <label>Question:</label>
                <input type="text" name="questions[]" required>
                
                <div class="answers">
                    <h4>Answers</h4>
                    <input type="text" name="answers[0][]" required>
                    <input type="text" name="answers[0][]" required>
                </div>
                <button type="button" onclick="addAnswer(this)">Add Answer</button>
            </div>
        </div>
        
        <button type="button" onclick="addQuestion()">Add Question</button><br><br>
        <input type="submit" value="Save Survey">
    </form>

    <script>
        let questionCount = 1;

        function addQuestion() {
            let questionDiv = document.createElement('div');
            questionDiv.classList.add('question');
            questionDiv.innerHTML = `
                <label>Question:</label>
                <input type="text" name="questions[]" required>
                <div class="answers">
                    <h4>Answers</h4>
                    <input type="text" name="answers[${questionCount}][]" required>
                    <input type="text" name="answers[${questionCount}][]" required>
                </div>
                <button type="button" onclick="addAnswer(this)">Add Answer</button>
            `;
            document.getElementById('questions').appendChild(questionDiv);
            questionCount++;
        }

        function addAnswer(button) {
            let answerInput = document.createElement('input');
            answerInput.type = 'text';
            answerInput.name = `answers[${questionCount - 1}][]`;
            answerInput.required = true;
            button.previousElementSibling.appendChild(answerInput);
        }
    </script>
</body>
</html>
