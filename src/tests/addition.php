<?php
function generate_question() {
    $a = rand(1, 100);
    $b = rand(1, 100 - $a);
    $correct_answer = $a + $b;
    return array($a, $b, $correct_answer, "+");
}

function generate_answers($correct_answer) {
    $max_answer_value = 100;
    $answers = array($correct_answer);
    
    while (count($answers) < 4) {
        $wrong_answer = rand(max(1, $correct_answer - 10), min($max_answer_value, $correct_answer + 10));
        if (!in_array($wrong_answer, $answers)) {
            $answers[] = $wrong_answer;
        }
    }
    
    shuffle($answers);
    return $answers;
}
?>