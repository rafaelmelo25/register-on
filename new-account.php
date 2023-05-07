<?php require_once('conect-bd.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <title>Novo cadastro</title>
</head>
<body>
<script src="assets/bootstrap/boostrstap.bundle.min.js"></script>
<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o valor do input "nameUser" foi enviado
    if (isset($_POST['nameUser']) && isset($_POST['emailUser']) && isset($_POST['passwords']) && isset($_POST['confirm_password'])) {
        // Acessa os valores dos inputs
        $name = $_POST['nameUser'];
        $email_user = $_POST['emailUser'];
        $passwords = $_POST['passwords'];
        $confirm_password = $_POST['confirm_password'];

        // Conexão com o banco de dados
        $conn = mysqli_connect($servername, $username, $password, $dbname);        
        // Verifica se houve erro na conexão com o banco de dados
        if (!$conn) {
            die("Conexão falhou: " . mysqli_connect_error());
        }

        // Escapa caracteres especiais para prevenir SQL injection
        $name = mysqli_real_escape_string($conn, $name);
        $email_user = mysqli_real_escape_string($conn, $email_user);
        $passwords = mysqli_real_escape_string($conn, $passwords);
        $confirm_password = mysqli_real_escape_string($conn, $confirm_password);

        // Verifica se as senhas são iguais
        if ($passwords !== $confirm_password) {
            die("Erro: as senhas não coincidem.");
        }

        // Executa a consulta SQL de inserção
        $sql = "INSERT INTO user (nome, email, passwords) VALUES ('$name', '$email_user', '$passwords')";
        $resultado = mysqli_query($conn, $sql);

        // Verifica se houve erro na execução da consulta
        if (!$resultado) {
            die("Erro na inserção: " . mysqli_error($conn));
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conn);

        // echo "Usuário cadastrado com sucesso!";
    } else {
        // echo "Erro: dados de usuário incompletos.";
    }
}
?>


<div class="container">
    <div class="row">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="nameUser" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="Example input placeholder">
            </div>
            <div class="mb-3">
                <label for="emailUser" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
                <label for="passwords" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwords" name="passwords">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirme Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Cadastrar</button>
            <button type="reset" class="btn btn-secondary" name="reset" value="Reset">Limpar</button>
        </form>
    </div>
</div>

</body>
</html>