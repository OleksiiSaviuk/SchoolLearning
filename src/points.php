<?php
function calculateScore($correct, $incorrect) {
    $points_for_correct = $correct * 3;
    $points_for_incorrect = $incorrect * 5;
    $total_points = $points_for_correct - $points_for_incorrect;

    if ($total_points < 0) {
        $total_points = 0;
    }

    return $total_points;
}

$type = $_GET['type'];
$correct_answers = $_SESSION['correct'];
$incorrect_answers = $_SESSION['incorrect'];
$score = calculateScore($correct_answers, $incorrect_answers);

require 'sql_connect.php';

$sql = "SELECT * FROM scores WHERE test_type = '$type' ORDER BY score DESC LIMIT 10";
$result = $conn->query($sql);

$isInTopTen = false;
$lowestTopScore = null;

if ($result->num_rows > 0) {
  $rows = $result->fetch_all(MYSQLI_ASSOC);
  $lowestTopScore = end($rows)['score'];
  if ($result->num_rows < 10 || $score > $lowestTopScore) {
    $isInTopTen = true;
  }
} else {
  $isInTopTen = true; 
}

if ($isInTopTen) {
  echo "<p>Ви увійшли до ТОП-10!</p>";
  echo "<form action='save_score.php' method='post'>
          <p>Введіть своє ім'я: <input type='text' name='name' required></p>
          <p>Введіть свій клас: <input type='text' name='class' required></p>
          <input type='hidden' name='score' value='$score'>
          <input type='hidden' name='test_type' value='$type'>
          <input class='btn test-selection' type='submit' value='Зберегти'>
        </form><hr>";
}

?>