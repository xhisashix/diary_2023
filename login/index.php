<?php

// loginの処理を追加
require_once('../models/login/LoginClass.php');
session_start();

//すでにログインしている場合は、マイページにリダイレクト
if (isset($_SESSION['user_id'])) {
  header('Location: ../my_page/index.php');
  exit;
}

isset($_POST['email']) ? $email = $_POST['email'] : $email = null;
isset($_POST['password']) ? $password = $_POST['password'] : $password = null;

if (!empty($email) || !empty($password)) {
  $loginClass = new LoginClass($email, $password);
  $sql = "SELECT * FROM users WHERE email = :email";
  $loginClass->loginUser($sql, $email, $password);
}

?>


<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">ログイン</h3>
  <?php if (isset($_SESSION['error_message'])) : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $_SESSION['error_message']; ?>
    </div>
  <?php endif; ?>
  <form action="./index.php" method="post">
    <div class="form-group">
      <label for="email">ログインID</label>
      <input type="text" name="email" id="email" class="form-control" placeholder="ログインIDを入力してください" aria-describedby="helpId">
      <small id="helpId" class="text-muted">ログインIDはメールアドレスです。</small>
    </div>
    <div class="form-group">
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="パスワードを入力してください" aria-describedby="helpId">
    </div>
    <button type="submit" class="btn btn-primary">ログイン</button>
  </form>
</main>


<?php require_once('../global/footer.php') ?>