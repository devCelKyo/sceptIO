<?php

include 'bdd.php';
include 'Entities/User.php';

function user_exists($bdd, $login) {
    $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $req->execute(array($login));

    $data = $req->fetch();
    if (!$data) {
        return false;
    }
    return true;
}

function check_password($bdd, $login, $password) {
    $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $req->execute(array($login));

    $data = $req->fetch();
    $selected_user = new User($data);
    if (password_verify($password, $selected_user->password)) {
        return true;
    }
    return false;
}

if (!isset($_POST['login'])) {
    header('Location: ../login.php');
    exit;
}
else {
    if (!user_exists($bdd, $_POST['login'])) {
        header('Location: ../login.php?error=1');
    }
    else if (!check_password($bdd, $_POST['login'], $_POST['password'])) {
        header('Location: ../login.php?error=2');
    }
    else {
        session_start();
        $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute(array($_POST['login']));
    
        $data = $req->fetch();
        $_SESSION['user'] = new User($data);
        header('Location: ../quizz.php');
    }
}