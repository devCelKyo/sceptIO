<?php

class Question {
    public $id;
    public $enonce;
    public $theme;

    public function __construct($data) {
        $this->id = utf8_encode($data['id']);
        $this->enonce = utf8_encode($data['enonce']);
        $this->theme = utf8_encode($data['theme']);
        $this->experience = utf8_encode($data['experience']);
    }

    public function getId() {
        return $this->id;
    }

    public function getEnonce() {
        return $this->enonce;
    }

    public function getTheme() {
        return $this->theme;
    }

    public function getExperience() {
        return $this->experience;
    }
}

?>