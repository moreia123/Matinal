<?php
// Carrega as respostas
$data = [];
if (file_exists('data/respostas.json')) {
    $data = json_decode(file_get_contents('data/respostas.json'), true);
}

// Exibe o ranking
echo "<h1>Ranking dos Vendedores</h1>";
foreach ($data as $entry) {
    echo "<p>Dia: " . $entry['day'] . " - Respostas: " . json_encode($entry['answers']) . "</p>";
}
?>