<?php

require_once('../models/posts/PostsClass.php');

isset($_POST['title']) ? $title = $_POST['title'] : $title = null;
isset($_POST['content']) ? $content = $_POST['content'] : $content = null;
isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : $user_id = null;
isset($_POST['id']) ? $post_id = $_POST['id'] : $post_id = null;
isset($_GET['id']) ? $id = $_GET['id'] : $id = null;

$postsClass = new PostsClass($title, $content, $user_id);
if (!isset($_SESSION)) {
  session_start();
}

// ログインしていない場合はログイン画面へ
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login/index.php');
  exit;
}

// ポストされたデータがある場合は、日報編集処理を実行
if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])) {
  $postsClass->updatePost($title, $content, $post_id);
}


// セッションのpost_dataがある場合は、その値を変数に格納
if (isset($_SESSION['post_data'])) {
  $post_data = $_SESSION['post_data'];
  $title = $post_data['title'];
  $content = $post_data['content'];
  unset($_SESSION['post_data']);
} else {
  // セッションのpost_dataがない場合は、DBから取得
  $post_data = $postsClass->getPost($id);
  if($post_data !== false) {
    $id = $post_data['id'];
    $title = $post_data['title'];
    $content = $post_data['content'];
  }
}
?>


<?php require_once('../global/header.php') ?>
<main class="container pt-4 pb-4">
  <h3>日報編集</h3>
  <div class="text-right mb-2">
    <button type="button" class="btn btn-primary ml-auto" id="enable-fields-btn">フィールドを有効にする</button>
  </div>
  <!-- 成功メッセージ -->
  <?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
    </div>
  <?php endif; ?>
  <form action="./edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label for="title">タイトル</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="タイトルを入力してください" value="<?php echo $title; ?>" disabled>
    </div>
    <div class="form-group">
      <label for="content">内容</label>
      <textarea class="form-control" id="content" name="content" rows="3" placeholder="内容を入力してください" disabled><?php echo $content; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" id="update_btn" disabled>更新</button>
  </form>

  <script>
    // フィールドの有効無効を切り替える
    const enableFieldsBtn = document.getElementById('enable-fields-btn');
    const title = document.getElementById('title');
    const content = document.getElementById('content');
    const updateBtn = document.getElementById('update_btn');

    enableFieldsBtn.addEventListener('click', function() {
      if (title.disabled && content.disabled) {
        enableFieldsBtn.textContent = 'フィールドを無効にする';
        title.disabled = false;
        content.disabled = false;
        updateBtn.disabled = false;
      } else {
        enableFieldsBtn.textContent = 'フィールドを有効にする';
        title.disabled = true;
        content.disabled = true;
        updateBtn.disabled = true;
      }
    })
  </script>

</main>

<?php require_once('../global/footer.php') ?>