<!-- <a href="../assets/script/php/logout_root.php">s</a> -->
<?php 
    if(!assert($_SESSION['id_root'])) {
        header('location:../');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicial | Beep Administrativo</title>
</head>
<body>
    
</body>
</html>