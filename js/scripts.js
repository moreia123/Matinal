// Função para gerar o QR Code
function generateQRCode(day) {
    var qrCodeDiv = document.getElementById('qr-code-' + day);
    qrCodeDiv.innerHTML = ''; // Limpa o conteúdo anterior
    const url = `https://seu-usuario.github.io/seu-repositorio/quiz.html?day=${day}`;
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

// Inicializa com o primeiro dia visível
document.getElementById('segunda').classList.add('active');
