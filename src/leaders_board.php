<?php


function fetchTopScores($conn, $testType) {
    $sql = "SELECT name, class, score, entry_date FROM scores WHERE test_type = ? ORDER BY score DESC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $testType);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

require 'sql_connect.php';

$testTypes = ['multiplication', 'division', 'addition', 'subtraction'];

echo "<div class='container'>";
foreach ($testTypes as $type) {
    $topScores = fetchTopScores($conn, $type);
    echo "<div class='test-section'>";
    echo "<h3>" . ucfirst($type) . "</h3>";
    echo "<table>";
    echo "<tr><th>Ім'я</th><th>Клас</th><th>Бали</th><th>Дата</th></tr>";
    if ($topScores->num_rows > 0) {
        while ($row = $topScores->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['class']}</td>
                    <td>{$row['score']}</td>
                    <td>" . date("d-m-Y", strtotime($row['entry_date'])) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Немає результатів</td></tr>";
    }
    echo "</table><hr>";
    echo "</div>";    
}
echo "</div>";
?>