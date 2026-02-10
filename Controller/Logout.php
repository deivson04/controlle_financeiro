<?php
session_start();
session_destroy();
header("Location: /git_controlle_financeiro/controlle_financeiro/index.php");
exit();