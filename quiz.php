<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'];
    $answers = [
        'q1' => $_POST['q1'],
        'q2' => $_POST['q2'],
        'q3' => $_POST['q3'],
        'q4' => $_POST['q4'],
        'q5' => $_POST['q5']
    ];

    // Carrega as respostas existentes
    $data = [];
    if (file_exists('data/respostas.json')) {
        $data = json_decode(file_get_contents('data/respostas.json'), true);
    }

    // Adiciona as novas respostas
    $data[] = [
        'day' => $day,
        'answers' => $answers,
        'timestamp' => time()
    ];

    // Salva as respostas no arquivo JSON
    file_put_contents('data/respostas.json', json_encode($data));

    // Redireciona para o ranking
    header('Location: ranking.php');
    exit;
}

// Carrega as perguntas do dia
$day = $_GET['day'];
$questions = [
    'segunda' => [
        [
            'question' => "1. Qual é o principal objetivo do planejamento semanal?",
            'options' => [
                ['text' => "a) Apenas definir metas.", 'value' => "a"],
                ['text' => "b) Definir metas e planejar estratégias.", 'value' => "b"],
                ['text' => "c) Ignorar as metas da semana anterior.", 'value' => "c"],
                ['text' => "d) Focar apenas em vendas.", 'value' => "d"]
            ],
            'correctAnswer' => "b"
        ],
        // Adicione mais perguntas aqui...
    ],
    // Repetir para os outros dias...
];

$currentQuestions = $questions[$day];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Rotina Matinais Maxcell</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Quiz: <?php echo ucfirst($day); ?></h1>
        <form id="quiz-form" method="POST" action="quiz.php">
            <input type="hidden" name="day" value="<?php echo $day; ?>">
            <?php foreach ($currentQuestions as $index => $question): ?>
                <div class="question">
                    <p><?php echo $question['question']; ?></p>
                    <ul>
                        <?php foreach ($question['options'] as $option): ?>
                            <li>
                                <label>
                                    <input type="radio" name="q<?php echo $index + 1; ?>" value="<?php echo $option['value']; ?>">
                                    <?php echo $option['text']; ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <button type="submit">Enviar Respostas</button>
        </form>
        <div class="timer" id="timer">20</div>
    </div>

    <script>
        // Função para iniciar o cronômetro
        function startTimer(duration, display) {
            var timer = duration, seconds;
            var interval = setInterval(function () {
                seconds = parseInt(timer % 60, 10);
                display.textContent = seconds;
                if (--timer < 0) {
                    clearInterval(interval);
                    alert("Tempo esgotado!");
                    document.getElementById('quiz-form').submit();
                }
            }, 1000);
        }

        // Inicia o cronômetro quando a página é carregada
        window.onload = function () {
            startTimer(20, document.getElementById('timer'));
        };
    </script>
</body>
</html>