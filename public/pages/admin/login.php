<?php

declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/config.php';
require_once PRIVATE_BASE_PATH . '/config.private.php';

$error = null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = trim($_POST['user']);
    $pass = trim($_POST['password']);

    if($user = ADMIN_USERNAME && password_verify($pass,ADMIN_PASSWORD)){
        $_SESSION['is_admin'] = true;
        header('Location: /index.php');
        exit;
    }
    else
        $error = "Hibás felhasználónév vagy jelszó!";

}

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumble weblap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <div class="container">
        <h1 class="m-3">Magyar <span class="mini-color">Rumble</span> admin bejelentkezés</h1>
        <div class="h-100 d-flex flex-column align-items-center justify-content-center">
            <?php if ($error) echo '<div>' . $error . '</div>'; ?>
            <form method="POST" action="/pages/admin/login.php">
                <div class="form-floating mb-3">
                    <input name="user" type="text" class="form-control" id="floatingInput" placeholder="Felhasználónév">
                    <label for="floatingInput">Felhasználónév</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Jelszó</label>
                </div>
                <button type="submit" class="btn my-2">Bejelentkezés</button>
            </form>
        </div>
    </div>
</body>

</html>