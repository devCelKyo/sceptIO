<?php

class User {
    public $id;
    public $pseudo;
    public $password;
    public $email;
    public $niveau;
    public $experience;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->pseudo = $data['pseudo'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->niveau = $data['niveau'];
        $this->experience = $data['experience'];
    }

    public function persist($bdd) {
        $req = $bdd->prepare('UPDATE users SET pseudo = ?, password = ?, email = ?, niveau = ?, experience = ? WHERE id = ?');
        $req->execute(array($this->pseudo, $this->password, $this->email, $this->niveau, $this->experience, $this->id));
    }

    public function setPlainPassword($bdd, $password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->persist($bdd);
    }

    public function giveExp($bdd, $exp) {
        $this->experience += $exp;
        $this->checkLevel($bdd);
    }

    public function checkLevel($bdd) {
        $this->niveau += intdiv($this->experience, 100);
        $this->experience = $this->experience%100;
        $this->persist($bdd);
    }
}