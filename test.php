<?php
include 'php/bdd.php';
include 'php/Entities/User.php';
session_start();

$_SESSION['user']->giveExp($bdd, 10);