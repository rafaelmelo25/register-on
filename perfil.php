<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
<script> alert('Login feito com sucesso!'); </script>
<body>
    <div class="container">
        <div class="row pt-5">
            <div class="col">
                <input type="text" class="form-control" placeholder="First name" aria-label="First name">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
            </div>
        </div>
    </div>
</body>
</html>

<?php
// header("Location: /register-on/perfil.php");
// exit;
?>
