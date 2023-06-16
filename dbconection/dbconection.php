<?php

// DB接続
$host = 'localhost';
$dbname = 'diary';
$dbuser = 'root';
$password = 'root';

// MySQL用のDSN文字列
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $password);

if($pdo == false){
  echo '接続失敗';
  exit();
}else{
  echo '接続成功';
}

// エラーが起きた時のモード設定
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>