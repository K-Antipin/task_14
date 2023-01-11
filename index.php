<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Moscow');
session_start();

$auth = $_SESSION['auth'] ?? null;

require_once 'functions.php';
$username = getCurrentUser();
if (isset($_POST['birthday'])) {
    $f = fopen('./db.php', 'r+');
    $contents = fread($f, filesize('./db.php'));
    $temp = json_decode($contents, true);
    $temp[$username]['birthday'] = $_POST['birthday'];
    $_SESSION['birthday'] = $_POST['birthday'];
    fclose($f);
    $f = fopen('./db.php', 'w');
    fwrite($f, json_encode($temp));
    fclose($f);
    unset($temp);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="bg-img"></div>
    <?php navbar($auth); ?>
    <div class="container__index">
        <?php

        if ($auth) {
            echo '<div class="sidebar">';
            echo '<p>Время входа на сайт: ' . date('H:i:s', $_COOKIE['time']) . '</p>';
            $birthday = getBirthday() !== null ? date_create(getBirthday()) : (isset($_SESSION['birthday']) ? date_create($_SESSION['birthday']) : null);
            // var_dump(isset($birthday));
            if (isset($birthday) && $_COOKIE['firstEntry'] > 1) {
                $end = date_create('tomorrow');
                $dateTimeNow = date_create();
                $today = date_create()->modify('noon')->getTimestamp();
                $birthdayThisYear = mktime(12, 0, 0, $birthday->format('m'), $birthday->format('d'), $dateTimeNow->format('Y'));
                if ($today > $birthdayThisYear) {
                    $y = $dateTimeNow->modify('+1 year')->format('Y');
                    $m = $birthday->format('m');
                    $d = $birthday->modify('+1 day')->format('d');
                } else {
                    $y = $dateTimeNow->format('Y');
                    $m = $birthday->format('m');
                    $d = $birthday->format('d');
                }
                echo "<div class='timer' style='display: none'>
                        <h4>До дня рождения осталось</h4>
                        <div class='timer__items'>
                            <div class='timer__item timer__days'>$d</div>
                            <div class='timer__item timer__hours'>$m</div>
                            <div class='timer__item timer__minutes'>$y</div>
                            <div class='timer__item timer__seconds'>00</div>
                        </div>
                    </div></div>";
                echo "<!-- HTML модального окна -->
                <div id='openModal' class='modal'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h3 class='modal-title'>Для вас персональная скидка!</h3>
                                <a href='#close' title='Close' class='close'>×</a>
                            </div>
                            <div class='modal-body'>
                                <div class='article'>
                                    <div class='description'>
                                        <h3>БАЛИЙСКИЙ МАССАЖ С МАСЛОМ</h3>
                                        <p>Балийский массаж сочетает в себе сразу несколько индонезийских массажных техник и сопровождается дивными ароматами разогретого масла.</p>
                                        <p><i>7500 руб.</i> 5000 руб.</p>
                                    </div>
                                    <img src='./img/1.jpg' alt='Массаж'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href='#openModal' class='openModal'>
                    <div class='modal__img'></div>
                    <div class='timer__gift' style='display: none'>
                        <div class='timer__items__gift'>
                            <div class='timer__hours__gift'>" . $end->format('j') . "</div>:
                            <div class='timer__minutes__gift'>" . $end->format('m') . "</div>:
                            <div class='timer__seconds__gift'>" . $end->format('Y') . "</div>
                        </div>
                    </div>
                </a>";
            } else {
                echo "</div><div class='birthday'>
                     <a title='Close' class='close birthday__close'>×</a>
                     <h3>Здравствуйте, $username!<br>
                     Мы хотим подготовить к Вашему дню рождения персональную акцию.<br>
                     Заполните, пожалуйста, день Вашего рождения.</h3><br>
                     <form id='birthday' method='post'>
                     <input type='date' name='birthday' required>
                     <input type='submit'>
                     </form></div>";
            }
        }

        ?>

        <div class="promotions__index">
            <h1>Услуги Spa салона.</h1>
            <div class="article">
                <div class="description">
                    <h3>БАЛИЙСКИЙ МАССАЖ С МАСЛОМ</h3>
                    <p>Балийский массаж сочетает в себе сразу несколько индонезийских массажных техник и сопровождается дивными ароматами разогретого масла.</p>
                    <p>7500 руб.</p>
                </div>
                <img class="img__hover" src="./img/1.jpg" alt="Массаж">
            </div>
            <div class="article">
                <img class="img__hover" src="./img/2.jpg" alt="Массаж">
                <div class="description">
                    <h3>ТАЙСКИЙ ЭНЕРГЕТИЧЕСКИЙ МАССАЖ "ШИАЦУ"</h3>
                    <p>Шиацу восстанавливает энергетический баланс человека и улучшает циркуляцию энергии в организме. Такая техника отличается от известных на массажей тем, что воздействие на точку происходит за счет строго перпендикулярного нажатия, а не массирования.</p>
                    <p>7500 руб.</p>
                </div>
            </div>
            <div class="article">
                <div class="description">
                    <h3>БАЛИЙСКИЙ МАССАЖ С МАСЛОМ В 4 РУКИ</h3>
                    <p>Балийский массаж — высокоэффективная, безопасная техника целенаправленного воздействия на биологически активные точки организма. Балийский массаж с маслом в 4 руки – удвоенная польза от синхронизации движений мастеров.</p>
                    <p>13000 руб.</p>
                </div>
                <img class="img__hover" src="./img/3.jpg" alt="Массаж">
            </div>
        </div>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>