<?php

// Detecta protocolo
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

// Host (localhost, 127.0.0.1, localhost:8080 etc.)
$host = $_SERVER['HTTP_HOST'];

// Pasta do projeto (ajusta automaticamente)
$basePath = dirname($_SERVER['SCRIPT_NAME']);

// Base URL dinâmica
define('BASE_URL', $protocol . "://" . $host . $basePath . "/");

