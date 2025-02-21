<?php
function fetchTopScores($conn, $testType) {
    $sql = "SELECT name, class, score, entry_date FROM scores WHERE test_type = ? ORDER BY score DESC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $testType);
    $stmt->execute();
    return $stmt->get_result();
}

function translateTestType($type) {
    $translations = [
        'multiplication' => 'Множення',
        'division' => 'Ділення',
        'addition' => 'Додавання',
        'subtraction' => 'Віднімання'
    ];
    
    return $translations[$type] ?? ucfirst($type);
}

$testTypes = ['multiplication', 'division', 'addition', 'subtraction'];

foreach ($testTypes as $type) {
    $topScores = fetchTopScores($conn, $type);
    echo "<div class='container'>";
    echo "<h3>" . translateTestType($type) . "</h3>";
    echo "<table>";
    echo "<tr><th>Ім'я</th><th>Клас</th><th>Бали</th><th>Дата</th></tr>";
    
    if ($topScores && $topScores->num_rows > 0) {
        while ($row = $topScores->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['class']) . "</td>
                    <td>" . htmlspecialchars($row['score']) . "</td>
                    <td>" . date("d-m-Y", strtotime($row['entry_date'])) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Немає результатів</td></tr>";
    }
    echo "</table>";
    echo "<hr>";
    echo "</div>";    
}
?>