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
    <h2>Тест завершено</h2>
    <p>✅ Вірних відповідей: <?php echo $_SESSION['correct']; ?></p>
    <p>❌ Невірних відповідей: <?php echo $_SESSION['incorrect']; ?></p>
    <form method="post" action="?start">
        <button class="btn test-selection" type="submit" name="test_type" value="multiplication">Множення</button>
        <button class="btn test-selection" type="submit" name="test_type" value="division">Ділення</button>
        <button class="btn test-selection" type="submit" name="test_type" value="addition">Додавання</button>
        <button class="btn test-selection" type="submit" name="test_type" value="subtraction">Віднімання</button>
    </form>
</div>
<script src="public/script.js"></script>
</body>
</html>