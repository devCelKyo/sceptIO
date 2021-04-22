<?php

class Question {
    public $id;
    public $enonce;
    public $theme;

    public function __construct($data) {
        $this->id = utf8_encode($data['id']);
        $this->enonce = utf8_encode($data['enonce']);
        $this->theme = utf8_encode($data['theme']);
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
}

?>