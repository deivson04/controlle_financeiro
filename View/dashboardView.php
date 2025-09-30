<?php

 session_start();


echo 'Olá, ' .  $_SESSION["nome"];

echo '<br><br><a href="../Controller/logout.php">Sair</a>';

