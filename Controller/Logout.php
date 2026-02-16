<?php

require_once __DIR__ . '/../Config/config.php';

session_start();
session_destroy();
header("Location: " . BASE_URL);
exit();