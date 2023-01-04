<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Moscow');

//username - admin, password - 123456
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

require_once 'functions.php';

$users = getUsersList();

if (checkPassword($username, $password, $users)) {

    setcookie('time', time(), strtotime('+90 days'));
    if (isset($_COOKIE['firstEntry'])) {
        setcookie('firstEntry', $_COOKIE['firstEntry'] + 1, strtotime('+90 days'));
    } else {
        setcookie('firstEntry', 1, strtotime('+90 days'));
    }
    
    // Стартуем сессию:
    session_start();

    // Пишем в сессию информацию о том, что мы авторизовались:
    $_SESSION['auth'] = true;

    // Пишем в сессию логин и id пользователя
    $_SESSION['login'] = $username;
} else {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
}


$auth = $_SESSION['auth'] ?? null;
// var_dump($_COOKIE['time']);

if ($auth) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница аутентификации</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="bg-img"></div>
    <?php navbar($auth); ?>
    <div class="login__in">
        <h3>Введите логин и пароль</h3>
        <form method="post">
            <input name="login" type="text" placeholder="Логин" required>
            <input name="password" type="password" placeholder="Пароль" required>
            <div class="buttons">
                <input name="submit" type="submit" value="Войти">
                <button type="button" id="registration">Регистрация</button>
            </div>
        </form>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>