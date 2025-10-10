<?php

 session_start();
if (isset($_SESSION["nome"])) {
   echo 'Olá, ' .  $_SESSION["nome"];
}


echo '<br><br><a href="../Controller/logout.php">Sair</a>';

