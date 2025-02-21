<?php
$name = htmlspecialchars(substr($_POST['name'], 0, 25));
$class = htmlspecialchars(substr($_POST['class'], 0, 5));
$score = intval($_POST['score']);
$test_type = htmlspecialchars($_POST['test_type']);
$datetime = date("Y-m-d H:i:s");

$stmt = $conn->prepare("INSERT INTO scores (name, class, score, test_type, entry_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $name, $class, $score, $test_type, $datetime);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
    exit;
}
$stmt->close();

session_destroy();
?>