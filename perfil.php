<?php
session_start();

if(!isset($_SESSION["id"]) || !isset($_SESSION["email"])){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <title>Perfil</title>
</head>
<body>
<script src="assets/bootstrap/boostrstap.bundle.min.js"></script>
<p>Seu ID de usuário é: <?php echo $_SESSION["id"]; ?></p>
    <a href="logout.php">Sair</a>
<div class="container">
    <div class="row">
        <form method="post">
            <div class="mb-3">
                <label for="emailUser" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailUser" name="emailUser" value="<?php echo $email_salvo ?>">
            </div>
            <div class="mb-3">
                <label for="passwords" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwords" name="passwords" value="<?php echo $senha_salva ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="lembrar_acesso" name="lembrar_acesso">
                <label class="form-check-label" for="lembrar_acesso">Lembrar acesso</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Entrar</button>
            <a href="new-account.php" target="_blank"><button type="button" class="btn btn-primary">Cadastrar</button></a>
        </form>
    </div>
</div>
</body>
</html>