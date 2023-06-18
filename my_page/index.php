<?php
require_once('../models/login/LoginClass.php');
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login/index.php');
  exit;
}

isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : $user_id = null;
isset($_SESSION['user_name']) ? $user_name = $_SESSION['user_name'] : $user_name = null;
isset($_SESSION['user_email']) ? $email = $_SESSION['user_email'] : $email = null;

?>

<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">マイページ</h3>
  <p class="text-end">ようこそ、<?php echo $_SESSION['user_name']; ?>さん</p>
  <table class="table">
    <tr>
      <th scope="row">ユーザーID</th>
      <td><?php echo $_SESSION['user_id']; ?></td>
    </tr>
    <tr>
      <th scope="row">ユーザー名</th>
      <td><?php echo $_SESSION['user_name']; ?></td>
    </tr>
    <tr>
      <th scope="row">メールアドレス</th>
      <td><?php echo $_SESSION['user_email']; ?></td>
    </tr>
  </table>
  <!-- ログアウト -->
  <form action="../login/logout.php" method="post">
    <button type="submit" class="btn btn-secondary">ログアウト</button>
  </form>
</main>

<?php require_once('../global/footer.php') ?>