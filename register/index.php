<?php
session_start();

if (isset($_SESSION['error_message'])) {
  $error_message = $_SESSION['error_message'];
  unset($_SESSION['error_message']);
}
?>

<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">新規登録</h3>
  <?php if (isset($error_message)) { ?>
    <div class="alert alert-danger" role="alert">
      <ul class="mb-0">
        <?php foreach ($error_message as $value) { ?>
          <li><?php echo $value; ?></li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>
  <form action="confirm.php" method="post" class="container-sm">
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">ユーザー名</label>
      <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" placeholder="名前を入力してください。" aria-describedby="helpId" value="<?php
                                                                                                                                  if (isset($_SESSION['name'])) echo $_SESSION['name'] ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
      <div class="col-sm-10">
        <input type="mail" name="email" id="email" class="form-control" placeholder="メールアドレスを入力してください。" aria-describedby="helpId" value="<?php
                                                                                                                                          if (isset($_SESSION['email'])) echo $_SESSION['email'] ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password" value="<?php
                                                                                                      if (isset($_SESSION['password'])) echo $_SESSION['password'] ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="password_confirmation" class="col-sm-2 col-form-label">確認用パスワード</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="password_confirmation" placeholder="もう一度パスワードを入力してください" value="<?php
                                                                                                                        if (isset($_SESSION['password_confirmation'])) echo $_SESSION['password_confirmation'] ?>">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">送信</button>
  </form>
</main>

<?php require_once('../global/footer.php') ?>