<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Математичний тест</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="container">
<h2><?php echo $a . " " . $symbol . " " . $b . " = ?"; ?></h2>
    <form method="post" id="test-form">
        <input type="hidden" name="correct_answer" value="<?php echo $correct_answer; ?>">
        <div class="answer-boxes">
            <?php foreach ($answers as $answer): ?>
                <div class="answer-box" onclick="selectAnswer(<?php echo $answer; ?>)">
                    <?php echo $answer; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" id="selected_answer" name="answer" value="">
    </form>
    <p class="score">✅ Вірних: <?php echo $_SESSION['correct']; ?> | ❌ Невірних: <?php echo $_SESSION['incorrect']; ?></p>
    <p id="timer" data-time="<?php echo $remaining_time; ?>">Час залишився: <?php echo $remaining_time; ?> секунд</p>
</div>
<button id="theme-toggle" class="btn-theme">🌙 Темна / ☀️ Світла</button>
<script src="public/script.js"></script>
<script>
    function selectAnswer(answer) {
        document.getElementById("selected_answer").value = answer;
        let boxes = document.querySelectorAll('.answer-box');
        boxes.forEach(box => box.classList.remove('selected'));
        event.target.classList.add('selected');
        document.getElementById("test-form").submit();
    }
</script>
</body>
</html>