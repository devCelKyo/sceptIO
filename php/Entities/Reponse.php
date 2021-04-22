<?php 

class Reponse {
    public $id;
    public $id_question;
    public $reponse;
    public $correcte;

    public function __construct($data) {
        $this->id = utf8_encode($data['id']);
        $this->id_question = utf8_encode($data['id_question']);
        $this->reponse = utf8_encode($data['reponse']);
        $this->correcte = utf8_encode($data['correcte']);
    }

    public function getId() {
        return $this->id;
    }

    public function getIdQuestion() {
        return $this->id_question;
    }

    public function getReponse() {
        return $this->reponse;
    }

    public function getCorrecte() {
        return $this->correcte;
    }
}