<?php

require_once('../models/posts/PostsClass.php');

isset($_POST['title']) ? $title = $_POST['title'] : $title = null;
isset($_POST['content']) ? $content = $_POST['content'] : $content = null;
isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : $user_id = null;

$postsClass = new PostsClass($title, $content, $user_id);
if(!isset($_SESSION)) {
  session_start();
}

// ログインしていない場合はログイン画面へ
if(!isset($_SESSION['user_id'])) {
  header('Location: ../login/index.php');
  exit;
}

isset($_GET['id']) ? $id = $_GET['id'] : $id = null;

// セッションのpost_dataがある場合は、その値を変数に格納
if(isset($_SESSION['post_data'])) {
  $post_data = $_SESSION['post_data'];
  $title = $post_data['title'];
  $content = $post_data['content'];
  unset($_SESSION['post_data']);
}else {
  // セッションのpost_dataがない場合は、DBから取得
  $post_data = $postsClass->getPost($id);
  $title = $post_data['title'];
  $content = $post_data['content'];
}

// $contentの空白を削除
$content = str_replace(array("\r\n","\r","\n"), '', $content);

?>


<?php require_once('../global/header.php') ?>
<main class="container pt-4 pb-4">
  <h3>日報編集</h3>
  <form action="./create.php" method="post">
    <div class="form-group">
      <label for="title">タイトル</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="タイトルを入力してください" value="<?php echo $title; ?>">
    </div>
    <div class="form-group">
      <label for="content">内容</label>
      <textarea class="form-control" id="content" name="content" rows="3" placeholder="内容を入力してください">
        <?php echo $content; ?>
      </textarea>
    </div>
    <button type="submit" class="btn btn-primary">投稿</button>
  </main>

  <?php require_once('../global/footer.php') ?>