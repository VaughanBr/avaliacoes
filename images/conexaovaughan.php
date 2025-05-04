<?php
$servername = "localhost";
$username = "root";
$password = "575611";
$dbname = "vaughan-store-bd";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Receber dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anuncio_Id = $_POST['anuncio_Id'];
    $comment = $_POST['comment'];
    $status = 'approved'; // Ou 'pending', dependendo da lógica de aprovação

    // Inserir avaliação na tabela 'avaliacoes'
    $sql = "INSERT INTO avaliacoes (anuncio_Id, comment, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $anuncio_Id, $comment, $status);

    if ($stmt->execute() === TRUE) {
        echo "Avaliação adicionada com sucesso";
    } else {
        echo "Erro ao adicionar avaliação: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
