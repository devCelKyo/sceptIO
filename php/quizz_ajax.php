<?php
include 'quizz.php';

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
    }

    $pre = new stdClass();
    $pre->retour = $retour;

    echo json_encode($pre, JSON_UNESCAPED_UNICODE);
}
?>