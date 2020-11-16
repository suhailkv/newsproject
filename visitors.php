<?php
require "pdo.php";

function getRealIpAddr(){

    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$addresseip = getRealIpAddr();
$stmt = $pdo->prepare("SELECT * FROM visitor WHERE ip=:ip");
$stmt->execute(array(':ip' => $addresseip));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (is_null($row['time'])) {
  $stmt = $pdo->prepare("INSERT INTO visitor(ip) VALUES (:ip)");
  $stmt ->execute(array(':ip'=>$addresseip));
}
else {
  date_default_timezone_set("Asia/Kolkata");
  $datetime1 = new DateTime();
  $datetime2 = new DateTime($row['time']);
  $interval = $datetime1->diff($datetime2);
  $elapsed = $interval->format('%i');

  if ($elapsed >10) {
    $count = $row['count']+1;
    $stmt = $pdo->prepare("UPDATE visitor SET time = now(), count = :co WHERE ip=:ip");
    $stmt ->execute(array(':co' => $count,
                          ':ip'=>$addresseip));
  }
}
 ?>
