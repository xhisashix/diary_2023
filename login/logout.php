<?php

//logoutの処理を追加

require_once('../models/login/LoginClass.php');
session_start();

isset($_POST['email']) ? $email = $_POST['email'] : $email = null;
isset($_POST['password']) ? $password = $_POST['password'] : $password = null;


$loginClass = new LoginClass($email, $password);

$loginClass->logoutUser();

?>

<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">ログアウト</h3>
  <p>ログアウトしました。</p>
  <a href="../login/index.php">ログイン画面へ</a>
</main>

<?php require_once('../global/footer.php') ?>