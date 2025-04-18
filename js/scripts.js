// Função para gerar o QR Code
function generateQRCode(day) {
    var qrCodeDiv = document.getElementById('qr-code-' + day);
    qrCodeDiv.innerHTML = ''; // Limpa o conteúdo anterior
    const url = `https://moreia123.github.io/Matinal/quiz.html?day=${day}`;
    var qrCode = new QRCode(qrCodeDiv, {
        text: url,
        width: 200,
        height: 200
    });
}

// Função para abrir o quiz
function openQuiz(day) {
    var contents = document.querySelectorAll('.content, .quiz-page');
    contents.forEach(function(content) {
        content.classList.remove('active');
    });
    document.getElementById('quiz-' + day).classList.add('active');
    generateQRCode(day);
}

// Função para voltar ao conteúdo
function goBack() {
    var contents = document.querySelectorAll('.content, .quiz-page');
    contents.forEach(function(content) {
        content.classList.remove('active');
    });
    var selectedDay = document.getElementById('day').value;
    document.getElementById(selectedDay).classList.add('active');
}

// Função para mudar o conteúdo ao selecionar o dia
function changeDay() {
    var selectedDay = document.getElementById('day').value;
    var contents = document.querySelectorAll('.content');
    contents.forEach(function(content) {
        content.classList.remove('active');
    });
    document.getElementById(selectedDay).classList.add('active');
}

// Inicializa com o primeiro dia visível
document.getElementById('segunda').classList.add('active');

// Adiciona o evento de mudança ao select
document.getElementById('day').addEventListener('change', changeDay);
