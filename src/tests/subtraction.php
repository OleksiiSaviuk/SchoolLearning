<?php
function generate_question() {
    $a = rand(1, 100);
    $b = rand(1, $a);  // Гарантуємо позитивний результат не більше 100
    $correct_answer = $a - $b;
    return array($a, $b, $correct_answer, "-");
}

function generate_answers($correct_answer) {
    $answers = array($correct_answer);
    $min_answer_value = 1;  // відповіді зберігаються позитивними

    while (count($answers) < 4) {
        $wrong_answer = rand($min_answer_value, max($correct_answer + 10, $min_answer_value));
        if (!in_array($wrong_answer, $answers)) {
            $answers[] = $wrong_answer;
        }
    }
    
    shuffle($answers);
    return $answers;
}
?>