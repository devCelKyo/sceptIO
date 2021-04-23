<?php
include 'bdd.php';
// A améliorer

function password_check($pass1, $pass2) {
    if (strlen($pass1) < 5) {
        return 1;
    }
    if ($pass1 !== $pass2) {
        return 2;
    }
    return 0;
}

function login_check($bdd, $login) {
    $req = $bdd->prepare('SELECT id FROM users WHERE pseudo = ?');
    $req->execute(array($login));
    
    $data = $req->fetch();
    if (!$data) {
        return false;
    }
    return true;
}

$request_type = $_POST['request_type'];

if ($request_type == 'CREATE_ACCOUNT') {
    $pseudo = $_POST['pseudo'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $email = $_POST['email'];

    $retour = new stdClass();
    $retour->error = 'false';
    $retour->error_list = array();
    
    $pass_check = password_check($pass1, $pass2);
    if ($pass_check == 1) {
        $retour->error_list[] = "Mot de passe trop court. (5 caractères au moins !)";
        $retour->error = 'true';
    }
    if ($pass_check == 2) {
        $retour->error_list[] = "Les deux mots de passe ne correspondent pas.";
        $retour->error = 'true';
    }
    if (login_check($bdd, $pseudo)) {
        $retour->error_list[] = "Ce pseudo est déjà pris.";
        $retour->error = 'true';
    }

    if ($retour->error == 'false') {
        $req = $bdd->prepare('INSERT INTO users (pseudo, password, email) VALUES (?, ?, ?)');
        $req->execute(array($pseudo, password_hash($pass1, PASSWORD_DEFAULT), $email));
    }

    echo json_encode($retour, JSON_UNESCAPED_UNICODE);
}