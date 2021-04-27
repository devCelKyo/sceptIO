<?php
include 'bdd.php';
include 'Entities/Question.php';
include 'Entities/Reponse.php';

function get_random_question($bdd) {
    $req = $bdd->query('SELECT * FROM questions ORDER BY RAND() LIMIT 1');
    $data = $req->fetch();
    $question = new Question($data);
    return $question;
}

function get_reponses($bdd, $question) {
    $id_question = $question->getId();
    $req = $bdd->prepare('SELECT * FROM reponses WHERE id_question = ?');
    $req->execute(array($id_question));
    $reponses = array();

    while ($data = $req->fetch()) {
        $reponse = new Reponse($data);
        array_push($reponses, $reponse);
    }

    return $reponses;
}

function check_reponse($bdd, $id) {
    $req = $bdd->prepare('SELECT * FROM reponses WHERE id = ?');
    $req->execute(array($id));
    $data = $req->fetch();

    if ($data['correcte']) {
        return true;
    }
    else {
        return false;
    }
}

function get_experience($bdd, $id_reponse) {
    $req = $bdd->prepare('SELECT * FROM questions, reponses WHERE questions.id = reponses.id_question AND reponses.id = ? LIMIT 1');
    $req->execute(array($id_reponse));
    $data = $req->fetch();
    
    return $data['experience'];
}
?>