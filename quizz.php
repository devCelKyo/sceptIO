<?php 
include 'php/Entities/User.php';
session_start();
if (isset($_SESSION['user'])) {
    $_SESSION['user'] = unserialize($_SESSION['user']);
}
 ?>

<!DOCTYPE html>
<head>
    <title>Quizz</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js"></script>
    <script src="js/quizz.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <h1>Questions - Logged in as <?php if (!isset($_SESSION['user'])) { echo 'Anon'; ?> <h2><a href="login.php">Se connecter</a></h2> <?php } else { echo $_SESSION['user']->pseudo; 
    ?> <h2><a href="php/logout.php">Se déconnecter</a></h2> <?php } ?></h1>
    <div id="quizz-threshold">
        <div id="question-threshold">
            <h2 id="question">Question</h2>
        </div>

        <div class="reponse-threshold">
            <h3 id="reponse-a" class="reponse" id-reponse="">Réponse A</h3>
        </div>

        <div class="reponse-threshold">
            <h3 id="reponse-b" class="reponse" id-reponse="">Réponse B</h3>
        </div>

        <div class="reponse-threshold">
            <h3 id="reponse-c" class="reponse" id-reponse="">Réponse C</h3>
        </div>

        <div class="reponse-threshold">
            <h3 id="reponse-d" class="reponse" id-reponse="">Réponse D</h3>
        </div>
    </div>
</body>
</html>