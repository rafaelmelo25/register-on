<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
<!-- <script src="assets/bootstrap/boostrstap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php
// Iniciar a sessão
session_start();

// Incluir o arquivo de conexão com o banco de dados
require_once "conect-bd.php";

// Definir as variáveis e inicializar com valores vazios
$email = $senha = "";
$email_err = $senha_err = "";

function verificar_login($conn, $email, $senha){
    $sql = "SELECT * FROM user WHERE email = ? AND passwords = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_senha);
        $param_email = $email;
        $param_senha = $senha;

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }

        mysqli_stmt_close($stmt);
    }
    return false;
}

// Processar os dados do formulário quando for enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verificar se o email foi preenchido
    if(empty(trim($_POST["emailUser"]))){
        $email_err = "Por favor, insira o email.";
    } else{
        $email = trim($_POST["emailUser"]);
    }

    // Verificar se a senha foi preenchida
    if(empty(trim($_POST["passwords"]))){
        $senha_err = "Por favor, insira a senha.";
    } else{
        $senha = trim($_POST["passwords"]);
    }

    // Validar as credenciais
    if(empty($email_err) && empty($senha_err)){
        if(verificar_login($conn, $email, $senha)){
            // Armazenar os dados na sessão
            $_SESSION["loggedin"] = true;
            $_SESSION["emailUser"] = $email;

            // Redirecionar para a página de perfil
            header("location: perfil.php");
            exit();
        } else{
            // Exibir uma mensagem de erro genérica
            $senha_err = "O email ou a senha estão incorretos.";
        }
    }
}
?>

    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div>
            <label>Email</label>
            <input type="email" name="emailUser" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>    
        <div>
            <label>Senha</label>
            <input type="password" name="passwords">
            <span><?php echo $senha_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Entrar">
        </div>
    </form>
    <?php
    // Exibir mensagem de login feito com sucesso
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        echo "<p>Login feito com sucesso!</p>";
    }
    ?>
</body>
</html>

<!-- <div class="container">
    <div class="row">
        <form id="form" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="emailUser" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser">
                <?php //if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['emailUser']) && !empty($email_err)) echo '<div class="alert alert-danger mt-2">' . $email_err . '</div>'; ?>
            </div>
            <div class="mb-3">
                <label for="passwords" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwords" name="passwords" >
                <?php //if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['passwords']) && !empty($senha_err)) echo '<div class="alert alert-danger mt-2">' . $senha_err . '</div>'; ?>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="lembrar_acesso" name="lembrar_acesso">
                <label class="form-check-label" for="lembrar_acesso">Lembrar acesso</label>
            </div>
            <input class="btn btn-primary" name="login" type="submit" value="login">
            
            <a href="new-account.php" target="_blank"><button type="button" class="btn btn-primary">Cadastrar</button></a>
        </form>
    </div>
</div> -->

<?php
// if($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Verifica se o login foi bem-sucedido
//     if(verificar_login($conn, $_POST["emailUser"], $_POST["passwords"])) {
//         // Inicia a sessão
//         session_start();

//         // Armazena os dados na sessão
//         $_SESSION["loggedin"] = true;
//         $_SESSION["emailUser"] = $_POST["emailUser"];

//         // Redireciona para a página perfil.php
//         header("Location: perfil.php");
//         exit();
//     }
// }



?>



<!-- <div class="container">
    <div class="row">
        <form id="form" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="emailUser" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser">
                <?php //if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['emailUser']) && !empty($email_err)) echo '<div class="alert alert-danger mt-2">' . $email_err . '</div>'; ?>
            </div>
            <div class="mb-3">
                <label for="passwords" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwords" name="passwords" >
                <?php //if($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['passwords']) && !empty($senha_err)) echo '<div class="alert alert-danger mt-2">' . $senha_err . '</div>'; ?>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="lembrar_acesso" name="lembrar_acesso">
                <label class="form-check-label" for="lembrar_acesso">Lembrar acesso</label>
            </div>
            <input class="btn btn-primary" name="login" type="submit" value="login">
            
            <a href="new-account.php" target="_blank"><button type="button" class="btn btn-primary">Cadastrar</button></a>
        </form>
    </div>
</div> -->




<!-- <script>
    document.getElementById("form").addEventListener("submit", function(event) {
        var email = document.getElementById("emailUser").value;
        var password = document.getElementById("passwords").value;

        var error = false;
        var errorMsg = "";

        // Validar email
        if(email == "") {
            errorMsg += "Por favor, informe seu email.\n";
            error = true;
        }

        // Validar senha
        if(password == "") {
            errorMsg += "Por favor, informe sua senha.\n";
            error = true;
        }

        // Se houver erro, mostrar mensagem e impedir envio do formulário
        if(error) {
            alert(errorMsg);
            event.preventDefault();
        }
    });
</script> -->

</html>