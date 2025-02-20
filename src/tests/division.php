<?php
function generate_question() {
    $b = rand(1, 10);
    $correct_answer = rand(1, 10);
    $a = $b * $correct_answer;
    return array($a, $b, $correct_answer, ":");
}

function generate_answers($correct_answer) {
    $answers = array($correct_answer);
    while (count($answers) < 4) {
        $wrong_answer = rand(1, 10);
        if (!in_array($wrong_answer, $answers)) {
            $answers[] = $wrong_answer;
        }
    }
    shuffle($answers);
    return $answers;
}
?>