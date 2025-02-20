<?php
require 'sql_connect.php';

$name = htmlspecialchars($_POST['name']);
$class = htmlspecialchars($_POST['class']);
$score = intval($_POST['score']);
$test_type = htmlspecialchars($_POST['test_type']);
$datetime = date("Y-m-d H:i:s");

$sql = "INSERT INTO scores (name, class, score, test_type, entry_date) VALUES ('$name', '$class', '$score', '$test_type', '$datetime')";
if ($conn->query($sql) === TRUE) {
  echo "Результат успішно збережено!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
require 'template_start.php';
?>