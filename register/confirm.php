<?php
require_once('../models/register/RegisterValidateClass.php');

session_start();
isset($_POST['email']) ? $email = $_POST['email'] : $email = null;
isset($_POST['name']) ? $name = $_POST['name'] : $name = null;
isset($_POST['password']) ? $password = $_POST['password'] : $password = null;
isset($_POST['password_confirmation']) ? $password_confirmation = $_POST['password_confirmation'] : $password_confirmation = null;


$registerValidateClass = new RegisterValidateClass($email, $name, $password, $password_confirmation);

$validate = $registerValidateClass->validate($email, $name, $password, $password_confirmation);

if ($validate['error_message'] != []) {
  header('Location: ./index.php');
  exit();
} else {
  unset($_SESSION['error_message']);
}

?>

<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">確認画面</h3>

  <form action="./complete.php" method="post">
    <input type="hidden" name="email" value="<?php echo $email ?>">
    <input type="hidden" name="name" value="<?php echo $name ?>">
    <input type="hidden" name="password" value="<?php echo $password ?>">
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">ユーザー名</label>
      <div class="col-sm-10">
        <input type="text" id="name" disabled class="form-control" aria-describedby="helpId" value="<?php echo $name ?>">
      </div>
    </div>
    <div class="form-group row">
      <label  class="col-sm-2 col-form-label">メールアドレス</label>
      <div class="col-sm-10">
        <input type="text"  id="email" disabled class="form-control" aria-describedby="helpId" value="<?php echo $email ?>">
      </div>
    </div>
    <div class="form-group row">
      <label  class="col-sm-2 col-form-label">パスワード</label>
      <div class="col-sm-10">
        <input type="password"  id="password" disabled class="form-control" value="<?php echo $password; ?>">
      </div>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">登録</button>
      <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
    </div>
  </form>
</main>

<?php require_once('../global/footer.php') ?>