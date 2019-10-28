<?php

include '../db/connec.php';
$pdo = new PDO(DSN, USER, PASS);

    if(isset($_POST['submit'])) {
        $minBribe = 0;
        $bribe = $_POST['payment'];

        if (empty($_POST['name']) || empty($_POST['payment'])) {
            echo '<h3 style="text-align: center">' . 'Oh no...these is a problem with your bride, your name or payment is empty, please solve this ASAP!' . '</h3>';
        } elseif ($bribe < $minBribe && $bribe == $minBribe) {
            echo '<h3 style="text-align: center">' . 'Oh no...Your bride is too low, if you don\'t solve this problem, you will have to look behind you when you walked outside...' . '</h3>';
        } else {
            $requete = "INSERT INTO bribe (name, payment) VALUES ('" . $_POST['name'] . "', '" . $_POST['payment'] . "')";
            $pdo->exec($requete);
            echo '<h3 style="text-align: center">' . 'Thank you for your cooperation! Your bribe has been added and you will not have any problem with us' . '</h3>';
        }
    }