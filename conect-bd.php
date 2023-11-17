<?php
$servername = "localhost"; // nome do servidor
$username = "root"; // nome de usuário
$password = ""; // senha
$dbname = "register_on"; // nome do banco de dados

// Criando uma conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificando a conexão
if (!$conn) {
  die("Falha na conexão: " . mysqli_connect_error());
}
// echo "Conexão bem-sucedida!";
?>


<?php 

// // Cria a tabela "user"
// $sql = "CREATE TABLE user (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     nome VARCHAR(50) NOT NULL,
//     telefone VARCHAR(20) NOT NULL,
//     email VARCHAR(50) NOT NULL,
//     password VARCHAR(50) NOT NULL
//     )";
    
//     // Executa a instrução SQL
//     if (mysqli_query($conn, $sql)) {
//         echo "Tabela criada com sucesso!";
//     } else {
//         echo "Erro ao criar tabela: " . mysqli_error($conn);
//     }
    
//     // Fecha a conexão com o banco de dados
//     mysqli_close($conn);

$sql = "ALTER TABLE user
    ADD COLUMN cep VARCHAR(50) NOT NULL,
    ADD COLUMN numero_residencia VARCHAR(50) NOT NULL,
    ADD COLUMN bairro VARCHAR(50) NOT NULL,
    ADD COLUMN cidade VARCHAR(50) NOT NULL,
    ADD COLUMN estado VARCHAR(50) NOT NULL";

// Executa a instrução SQL
if (mysqli_query($conn, $sql)) {
    echo "Tabela alterada com sucesso!";
} else {
    echo "Erro ao alterar tabela: " . mysqli_error($conn);
}

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);

?>