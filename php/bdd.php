<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=sceptio', 'root', '');
}
catch (PDOException $e) {
    print $e->getMessage();
    die();
}

?>