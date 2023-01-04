<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Moscow');
session_destroy();
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
require_once 'functions.php';
?>

<?php
// require_once 'db.php';
if ($username !== null && $password !== null) {
    $f = fopen('./db.php', 'r+');
    $contents = fread($f, filesize('./db.php'));
    $temp = json_decode($contents, true);
    var_dump(!existsUser($username, $temp));
    if (existsUser($username, $temp)) {
        goto var_1;
    }
    $temp[$username] = ['id' => count($temp) + 1, 'pass' => md5($password)];
    fclose($f);
    $f = fopen('./db.php', 'w');
    fwrite($f, json_encode($temp));
    fclose($f);
    header('Location: login.php');

    var_1:
    fclose($f);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница регистрации</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="bg-img"></div>
    <?php navbar($auth); ?>
    <div class="container">
        <!-- <img src="./img/bg.jpg" alt="Бамбаук" class="bg-img"> -->
        <div class="promotions">
            <h1>Акции недели</h1>
            <div class="article">
                <div class="description">
                    <h3>БАЛИЙСКИЙ МАССАЖ С МАСЛОМ</h3>
                    <p>Балийский массаж сочетает в себе сразу несколько индонезийских массажных техник и сопровождается дивными ароматами разогретого масла.</p>
                    <p><i>7500 руб.</i> 5000 руб.</p>
                </div>
                <img class="img__hover" src="./img/1.jpg" alt="Массаж">
            </div>
            <div class="article">
                <img class="img__hover" src="./img/2.jpg" alt="Массаж">
                <div class="description">
                    <h3>ТАЙСКИЙ ЭНЕРГЕТИЧЕСКИЙ МАССАЖ "ШИАЦУ"</h3>
                    <p>Шиацу восстанавливает энергетический баланс человека и улучшает циркуляцию энергии в организме. Такая техника отличается от известных на массажей тем, что воздействие на точку происходит за счет строго перпендикулярного нажатия, а не массирования.</p>
                    <p><i>7500 руб.</i> 5000 руб.</p>
                </div>
            </div>
            <div class="article">
                <div class="description">
                    <h3>БАЛИЙСКИЙ МАССАЖ С МАСЛОМ В 4 РУКИ</h3>
                    <p>Балийский массаж — высокоэффективная, безопасная техника целенаправленного воздействия на биологически активные точки организма. Балийский массаж с маслом в 4 руки – удвоенная польза от синхронизации движений мастеров.</p>
                    <p><i>13000 руб.</i> 10000 руб.</p>
                </div>
                <img class="img__hover" src="./img/3.jpg" alt="Массаж">
            </div>
        </div>
    </div>
    <div class="sign__up">
        <?php
        if (isset($temp) && existsUser($username, $temp) && $username !== null) {
            echo '<h2 id="focus" style="color: red">Пользователь с таким именем существует!</h2>';
            echo '<script>
                     if (!location.href.includes("focus")) {
                        location.href = location.href + "#focus";
                     }
                 </script>';
        } else {
            echo '<h2>Для участия в акциях, Вам необходимо зарегистрироваться.</h2>';
        }
        unset($temp);
        ?>
        <!-- <h3>Регистрация</h3> -->
        <br>
        <form method="post">
            <input name="login" type="text" placeholder="Логин" required>
            <input name="password" type="password" placeholder="Пароль" required>
            <input name="submit" type="submit" value="Зарегистрироваться">
        </form>
    </div>
</body>

</html>