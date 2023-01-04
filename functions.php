<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Moscow');


function getUsersList()
{
    $f = fopen('./db.php', 'r');
    $contents = fread($f, filesize('./db.php'));
    fclose($f);
    return json_decode($contents, true);
}

function existsUser($login, $arr)
{
    return array_key_exists($login, $arr);
}

function checkPassword($login, $password, $arr)
{
    return md5($password) === $arr[$login]['pass'] ? true : false;
}

function getCurrentUser()
{
    return $_SESSION['login'] ?? null;
}

function getBirthday()
{
    $arr = getUsersList();
    return $arr[$_SESSION['login']]['birthday'] ?? null;
}

function navbar($auth)
{
    echo '
    <header>
        <nav class="navbar">
            <div>
                <a class="navbar-brand" href="./index.php">Spa салон</a>
            </div>
            <div>';
    if ($auth) {
        echo '<span>Здравствуйте, ';
        echo getCurrentUser();
        echo '!</span>';
    }
    echo '<a href="./login.php" class="btn-success">';
    echo (!$auth ? 'Войти' : 'Выйти');
    echo '</a>
            </div>
        </nav>
    </header>
    ';
}
