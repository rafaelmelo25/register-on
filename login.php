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
session_start();
require_once('conect-bd.php');

$email = "";
$password = "";
$email_err = "";
$senha_err = "";

// Verifica se o formulário foi submetido
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Valida o email
    if(empty(trim($_POST["emailUser"]))){
        $email_err = "Por favor, digite o seu email.";
    } else{
        $email = trim($_POST["emailUser"]);
    }

    // Valida a senha
    if(empty(trim($_POST["passwords"]))){
        $senha_err = "Por favor, digite a sua senha.";
    } else{
        $password = trim($_POST["passwords"]);
    }

    // Verifica se não há erros de validação
    if(empty($email_err) && empty($senha_err)){

        $sql = "SELECT id, email, passwords FROM user WHERE email = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $email);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt, $id, $email, $hash);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hash)){
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;
                        $_SESSION["password"] = $password;

                        if(isset($_POST["lembrar_acesso"]) && $_POST["lembrar_acesso"] == "on"){
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            setcookie("emailUser", $email, time() + (86400 * 30), "/");
                            setcookie("passwords", $hashed_password, time() + (86400 * 30), "/");
                        } else {
                            setcookie("emailUser", "", time() - 3600, "/");
                            setcookie("passwords", "", time() - 3600, "/");
                        }

                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);

                        header("Location: /register-on/perfil.php");
                        exit;
                    } else {
                        $senha_err = "Senha incorreta.";
                    }
                } else {
                    $email_err = "Nenhuma conta encontrada com este e-mail.";
                }
            } else {
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
    }
}

?>
<div class="container">
    <div class="row">
        <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="emailUser" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser">
                <?php if(!empty($email_err) && isset($_POST['login'])) echo '<div class="alert alert-danger mt-2">' . $email_err . '</div>'; ?>
            </div>
            <div class="mb-3">
                <label for="passwords" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwords" name="passwords" >
                <?php if(!empty($senha_err) && isset($_POST['login'])) echo '<div class="alert alert-danger mt-2">' . $senha_err . '</div>'; ?>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="lembrar_acesso" name="lembrar_acesso">
                <label class="form-check-label" for="lembrar_acesso">Lembrar acesso</label>
            </div>
            <!-- <input class="btn btn-primary" name="login" type="submit" value="login" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> -->
            <input class="btn btn-primary" name="login" type="submit" value="login">
            
            <a href="new-account.php" target="_blank"><button type="button" class="btn btn-primary">Cadastrar</button></a>
        </form>
    </div>
</div>

</body>

<script>
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
</script>

</html>