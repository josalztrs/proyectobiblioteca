<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include'php\login.php';
?>
<script>
    window.onload=function(){
        window.history.pushState(null, null, window.location.href);}
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
   
        <!-- login form -->

    <div class="login-form">  
        <h1>Biblioteca Luis Beltrán Prieto Figueroa</h1>

        <div class="container">

            <div class="main">

                <div class="content">
                    <h2>Iniciar Sesión</h2>

                    <?php
                    if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
                    echo '<p style="color:red; text-align:center;">Usuario o Contraseña incorrectos.</p>';
                    }
                ?>
    
                    <form action="php/login.php" method="POST">
                        <input type="text" name="username" placeholder="usuario" maxlength="11" required>
                        <input type="password" name="password" placeholder="password" maxlength="11" required>

                        <div class="btn">
                            <button type="submit">Iniciar</button>
                            <button type="reset" id="cancelar">Limpiar</button>
                        </div>
    
                    </form>

                </div>

                <div class="form-img">
                    <div class="content-carta">
                        <div class="carta front">
                            <img src="imagenes\logo-unefa.png" id="logo-unefa" alt="logo-unefa">
                        </div>
                        <div class="carta back">
                            <img src="imagenes/Luis_Beltran_Figueroa.png" alt="luis-beltran" id="img2">
                               <h3>Luis B. Prieto</h3>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
  
</body>
</html>