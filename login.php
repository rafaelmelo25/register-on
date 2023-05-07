<?php //require_once('conect-bd.php');?>

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

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["emailUser"];
    $password = $_POST["passwords"];
    $lembrar_acesso = isset($_POST["lembrar_acesso"]);

    // Verificar se a conexão com o banco de dados foi estabelecida com sucesso
    if ($conn === false) {
        die("Não foi possível conectar ao banco de dados. Erro: " . mysqli_connect_error());
    }

    $sql = "SELECT id, passwords FROM user WHERE email = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $email);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id, $hash);

            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hash)){
                    $_SESSION["id"] = $id;
                    $_SESSION["email"] = $email;

                    if($lembrar_acesso){
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

var_dump($_POST);
?>
<div class="container">
    <div class="row">
        <form id="form" action="/register-on/perfil.php" method="post">
            <div class="mb-3">
                <label for="emailUser" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="passwords" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwords" name="passwords" value="<?php echo $password; ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="lembrar_acesso" name="lembrar_acesso">
                <label class="form-check-label" for="lembrar_acesso">Lembrar acesso</label>
            </div>
            
            <input class="btn btn-primary" name="login" type="submit" value="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            
            <a href="new-account.php" target="_blank"><button type="button" class="btn btn-primary">Cadastrar</button></a>
        </form>
    </div>
</div>

</body>
</html>