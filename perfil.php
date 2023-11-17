<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;


}
?>
<?php require_once('header.php');?>
    <div class="container">
        <div class="row pt-5">
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Primeiro nome" aria-label="Primeiro nome">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Sobre nome" aria-label="obre nome">
            </div>
        </div>
        
        <div class="row pt-5">
            <div class="col-6">
                <input type="text" class="form-control" placeholder="E-mail" aria-label="E-mail">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Telefone" aria-label="Telefone">
            </div>            
        </div>
        <div class="row">
            <div class="col-4 pt-5">
                <input type="text" class="form-control" placeholder="Endereço" aria-label="Endereço">                
            </div>
            <div class="col-2 pt-5">
                <input type="text" class="form-control" placeholder="Nº" aria-label="Nº">                
            </div>
            <div class="col-3 pt-5">
                <input type="text" class="form-control" placeholder="UF" aria-label="UF">            
            </div>
            <div class="col-3 pt-5">
                <input type="text" class="form-control" placeholder="Cidade" aria-label="Cidade">                
            </div>
            <!-- <div class="col-3 pt-5">
                <input type="text" class="form-control" placeholder="Endereço" aria-label="Endereço">
                
            </div>
            <div class="col-3 pt-5">
                <input type="text" class="form-control" placeholder="Endereço" aria-label="Endereço">
                
            </div> -->
        </div>
        
        <div class="row pt-5">
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Setor" aria-label="Setor">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Departamento" aria-label="Departamento">
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-12">
                <div class="dashboard">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

<?php
// header("Location: /register-on/perfil.php");
// exit;
?>
