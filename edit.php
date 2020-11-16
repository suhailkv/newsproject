<?php
  session_start();
  if (! isset($_SESSION['admin'])) {
    header("Location:main.php");
    return;
  }
  require "pdo.php";

if (isset($_POST['edit'])) {
  if ($_FILES['img']['size'] == 0) {
    $imgNameNew = $_POST['image'];
  }
  else {
    $allowed = array('jpg','jpeg','png' );

    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];
    $imgType = $_FILES['img']['type'];
    $imgError = $_FILES['img']['error'];

    $imgSplit = explode('.', $imgName);
    $imgExt = strtolower(end($imgSplit));

    if (in_array($imgExt, $allowed)) {
      if ($imgError === 0) {
        if ($imgSize < 1000000) {
          $imgNameNew = "factcheck".uniqid('',true).".".$imgExt;
          $imgDestination = './news_img/'.$imgNameNew;
          move_uploaded_file($imgTmpName, $imgDestination);
        }
        else {
          $_SESSION['error'] = 'File is too big <br> Maximum file size is 1Mb';
          header("Location:./Indexview.php");
          return;
        }
      }
      else {
        $_SESSION['error']='Error in uploading image';
        header("Location:./Indexview.php");
        return;
      }
    }
    else {
      $_SESSION[error]= 'Uploaded image is not an image file';
      header("Location:./Indexview.php");
      return;
    }
  }

  $stmt = $pdo->prepare('UPDATE news SET Heading=:hd,Description=:ds,Category=:ca,imgname=:im,createdDate=:dt WHERE news_id=:id');
  $stmt ->execute(array(
                        ":hd" =>$_POST['headline'],
                        ":ds" =>$_POST['content'],
                        ":ca" =>$_POST['category'],
                        ":im" =>$imgNameNew,
                        ":dt" =>$_POST['date'],
                        ":id" =>$_POST['id']
                      ));
  $_SESSION['success'] = 'Profile updated successfully';
  header('Location:./Indexview.php');
  return;
}
 ?>
