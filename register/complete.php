<?php
require_once('../models/register/RegisterClass.php');
session_start();

isset($_POST['email']) ? $email = $_POST['email'] : $email = null;
isset($_POST['name']) ? $name = $_POST['name'] : $name = null;
isset($_POST['password']) ? $password = $_POST['password'] : $password = null;
isset($_POST['password_confirmation']) ? $password_confirmation = $_POST['password_confirmation'] : $password_confirmation = null;

if (!empty($email) || !empty($name) || !empty($password) || !empty($password_confirmation)) {
  $registerClass = new RegisterClass($email, $name, $password);
  $sql = "INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at)";
  $registerClass->createUser($sql, $name, $email, $password);
}


// formの値で利用したセッションをすべて削除
unset($_SESSION['email']);
unset($_SESSION['name']);
unset($_SESSION['password']);
unset($_SESSION['password_confirmation']);
unset($_SESSION['error_message']);

if($_SERVER["REQUEST_METHOD"]==="POST"){
  //処理
  header("location: ./complete.php");
  exit;
}

?>


<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">登録完了画面</h3>
  <div class="alert alert-success" role="alert">
    登録が完了しました。
  </div>
  <a href="../login/index.php" class="btn btn-primary">ログイン画面へ</a>
</main>


<?php require_once('../global/footer.php') ?>