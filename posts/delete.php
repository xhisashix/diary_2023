<?php

// 削除処理を追加
require_once('../models/posts/PostsClass.php');

session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login/index.php');
  exit;
}

$postsClass = new PostsClass(null, null, null);

// 削除処理
if (isset($_POST['delete'])) {
  $postsClass->deletePost($_POST['id']);
}

?>

<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3 class="fs-3">削除確認画面</h3>
  <div class="alert alert-danger" role="alert">
    <p>本当に削除しますか？</p>
    <p>この処理は取り消しすることができません。</p>
  </div>
  <form action="delete.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <button type="submit" class="btn btn-danger" name="delete">削除</button>
    <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
  </form>
</main>

<?php require_once('../global/footer.php') ?>