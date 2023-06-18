<?php

require_once('../models/posts/PostsClass.php');

if(!isset($_SESSION)) {
  session_start();
}

isset($_POST['title']) ? $title = $_POST['title'] : $title = null;
isset($_POST['content']) ? $content = $_POST['content'] : $content = null;
isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : $user_id = null;


// ログインしていない場合はログイン画面へ
if(!isset($_SESSION['user_id'])) {
  header('Location: ../login/index.php');
  exit;
}

$error_messages = [];
// バリデーション
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(empty($_POST['title'])) {
    $error_messages['content_title'] =  'タイトルを入力してください';
  }
  if(empty($_POST['content'])) {
    $error_messages['content'] =  '内容を入力してください';
  }
  if(count($error_messages) > 0) {
    $_SESSION['error_messages'] = $error_messages;
    header('Location: ./create.php');
    exit;
  }else {
    $_SESSION['error_messages'] = [];
    // エラーがない場合、投稿処理を実行
    $postsClass = new PostsClass($title, $content, $user_id);
    $postsClass->createPost($title, $content, $user_id);
  }
}

?>

<?php require_once('../global/header.php') ?>

<main class="container pt-4 pb-4">
  <h3>日報投稿</h3>
  <form action="./create.php" method="post">
    <div class="form-group">
      <label for="title">タイトル</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="タイトルを入力してください">
    </div>
    <div class="form-group">
      <label for="content">内容</label>
      <textarea class="form-control" id="content" name="content" rows="3" placeholder="内容を入力してください"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">投稿</button>
  </main>

  <?php require_once('../global/footer.php') ?>