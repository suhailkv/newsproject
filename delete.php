<?php
  session_start();
  if (! isset($_SESSION['admin'])) {
    header("Location:main.php");
    return;
  }
  require "pdo.php";

  if(isset($_GET['news_id'])) {
    $id = htmlentities($_GET['news_id']);

    $stmt = $pdo->query('DELETE FROM news WHERE news_id='.$id);
    $_SESSION['success']='Successfully removed from database';
    header('Location:Indexview.php');
    return;
  }
 ?>
