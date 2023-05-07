<?php //require_once('conect-bd.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<script src="assets/bootstrap/boostrstap.bundle.min.js"></script>
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

    $sql = "SELECT id, senha FROM usuarios WHERE email = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $email);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id, $hash);

            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hash)){
                    $_SESSION["id"] = $id;
                    $_SESSION["email"] = $email;

                    if($lembrar_acesso){
                        setcookie("emailUser", $email, time() + (86400 * 30), "/");
                        setcookie("passwords", $password, time() + (86400 * 30), "/");
                    } else {
                        setcookie("emailUser", "", time() - 3600, "/");
                        setcookie("passwords", "", time() - 3600, "/");
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);

                    header("Location: perfil.php");
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

    // Verificar se os dados de login são válidos
    $login_valido = true; // Substitua por sua lógica de verificação de login
    
    if ($login_valido) {
        // Redirecionar para a página perfil.php
        header("Location: " . dirname($_SERVER['PHP_SELF']) . '/perfil.php');
        exit();
    }

    mysqli_close($conn);
}
var_dump($_POST);
?>
<div class="container">
    <div class="row">
        <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
            
            <input class="btn btn-primary" name="login" type="submit" value="login" formaction=""/>
            
            <a href="new-account.php" target="_blank"><button type="button" class="btn btn-primary">Cadastrar</button></a>
        </form>
    </div>
</div>
<script>

var form = document.querySelector('form');
var inputDiv = document.querySelector('input[type="submit"]');
var urls = {
    // cadastrar: 'paginas/cadastro.php',
    login: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>',
};
function verificarDestino(e){
    e.preventDefault();
    console.log(e.target);
    var tipo = e.target.value;
    var url = urls[tipo];
    form.action = url;
    alert(url); // só para verificar
    form.submit();
}
inputDiv.addEventListener('click', verificarDestino);
</script>


</body>
</html>