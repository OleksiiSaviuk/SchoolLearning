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
?>