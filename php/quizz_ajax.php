<?php
include 'quizz.php';
include 'Entities/User.php';
session_start();

 $request_type = $_POST['request_type'];

if ($request_type == 'GET_QUESTION')
{
    $question = get_random_question($bdd);
    $reponses = get_reponses($bdd, $question);

    $pre = new stdClass();
    $pre->question = $question;
    $pre->reponses = $reponses;

    echo json_encode($pre, JSON_UNESCAPED_UNICODE);
}

if ($request_type == 'CHECK_REPONSE') {
    $id_reponse = $_POST['reponse'];

    $retour = 'false';
    if (check_reponse($bdd, $id_reponse)) {
        $retour = 'true';
        if (isset($_SESSION['user'])) {
            $exp = get_experience($bdd, $id_reponse);
            $_SESSION['user']->giveExp($bdd, $exp);
        }
    }

    $pre = new stdClass();
    $pre->retour = $retour;
    $pre->logged = 'false';
    if (isset($_SESSION['user'])) {
        $pre->logged = 'true';
        $pre->new_xp = $_SESSION['user']->experience;
        $pre->new_lvl = $_SESSION['user']->niveau;
    }

    echo json_encode($pre, JSON_UNESCAPED_UNICODE);
}
?>