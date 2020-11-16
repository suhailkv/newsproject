<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=rapro', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//to show malayalam font
$pdo->exec("SET NAMES 'utf8';");
