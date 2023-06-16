<?php
session_start();
isset($_POST['email']) ? $email = $_POST['email'] : $email = null;
isset($_POST['name']) ? $name = $_POST['name'] : $name = null;
isset($_POST['password']) ? $password = $_POST['password'] : $password = null;
isset($_POST['password_confirmation']) ? $password_confirmation = $_POST['password_confirmation'] : $password_confirmation = null;


$error_message = [];

if ($email == null || $password == null || $password_confirmation == null) {
  if ($email == null) {
    $error_message['email'] = 'メールアドレスを入力してください。';
  }
  if ($password == null) {
    $error_message['password'] = 'パスワードを入力してください。';
  }
  if ($password_confirmation == null) {
    $error_message['password_confirmation'] = 'パスワード（確認）を入力してください。';
  }
}

if ($password != $password_confirmation) {
  $error_message['password_confirmation'] = 'パスワードが一致しません。';
}

// validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error_message['email'] = 'メールアドレスの形式が正しくありません。';
}

// validate password
if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
  $error_message['password'] = 'パスワードは英数字8文字以上100文字以下にしてください。';
}

if (isset($error_message)) {
  // セッションのデータを前の画面に戻す
  $_SESSION['email'] = $email;
  $_SESSION['name'] = $name;
  $_SESSION['password'] = $password;
  $_SESSION['password_confirmation'] = $password_confirmation;
  // エラーメッセージをセッションに保存
  $_SESSION['error_message'] = $error_message;
  // redirect to index.php
  header('Location: ./index.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>

<body>
  <h1>確認画面</h1>

  <form action="./register.php" method="post">
    <div>
      <label for="email">メールアドレス</label>
      <?php echo $email ?>
    </div>
    <div>
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password" value="<?php echo $password; ?>">
    </div>
    <div>
      <label for="password_confirmation">パスワード（確認）</label>
      <input type="password" name="password_confirmation" id="password_confirmation" value="<?php echo $password_confirmation; ?>">
    </div>
    <div>
      <input type="submit" value="登録">
    </div>
  </form>
</body>

</html>