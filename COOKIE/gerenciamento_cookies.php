<?php

function setCookieCustom($name, $value, $expiration = 0, $path = '/') {
    setcookie($name, $value, ($expiration == 0) ? 0 : time() + $expiration, $path);
}


function getCookie($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}


function deleteCookie($name, $path = '/') {
    setcookie($name, "", time() - 3600, $path);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    
    setCookieCustom('usuario', $username, 3600);
}


$currentUser = getCookie('usuario');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Perfil</title>
    <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
    <link rel="stylesheet" href="Style.css">

</head>
<body>

<div class="container">
    <?php if ($currentUser): ?>
        <h2>Bem-vindo, <?php echo $currentUser; ?>!</h2>

    <p><a href="?logout=true">
    <lord-icon
    src="https://cdn.lordicon.com/gwvmctbb.json"
    trigger="hover"
    style="width:100px;height:100px">
    </lord-icon>
    </p> 
</a>

    <?php else: ?>
     <lord-icon
    src="https://cdn.lordicon.com/xzalkbkz.json"
    trigger="in"
    delay="1000"
    style="width:100px;height:100px">
    </lord-icon>

        
        <form method="post" action="">
            <label for="username">Nome de usuário:</label>
            <input type="text" name="username" required>
            <input type="submit" name="login" value="Login">
        </form>
    <?php endif; 
    ?>

    <?php
    
    if (isset($_GET['logout'])) {
        
        deleteCookie('usuario');
        
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>
</div>

</body>
</html>