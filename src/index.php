<?php
session_start();

function processAnswer($user_choice, $correct_value) {
    if ($user_choice === intval($correct_value)) {
        $_SESSION['correct']++;
    } else {
        $_SESSION['incorrect']++;
    }
}

function resetSession() {
    session_destroy();
    session_start();
    $_SESSION['start_time'] = time();
    $_SESSION['correct'] = 0;
    $_SESSION['incorrect'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_type'])) {
    resetSession();
    $test_type = $_POST['test_type'];
    header("Location: " . $_SERVER['PHP_SELF'] . "?type=$test_type");
    exit;
}

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $test_file = "tests/{$type}.php";

    if (file_exists($test_file)) {
        require $test_file;
    } else {
        session_destroy();
        header("Location: /");
    }
}

$generate_question = 'generate_question';
$generate_answers = 'generate_answers';

$test_active = isset($_SESSION['start_time']);

if ($test_active && (time() - $_SESSION['start_time']) >= 60) {
    require 'template_end.php';
    exit;
}

if (!$test_active) {
    require 'template_start.php';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'], $_POST['correct_answer'])) {
        processAnswer(intval($_POST['answer']), intval($_POST['correct_answer']));
        header("Location: " . $_SERVER['PHP_SELF'] . '?type=' . ($_GET['type'] ?? 'multiplication'));
        exit;
    }
    $remaining_time = 60 - (time() - $_SESSION['start_time']);
    list($a, $b, $correct_answer, $symbol) = $generate_question();
    $answers = $generate_answers($correct_answer);
    require 'template_test.php';
}
?>