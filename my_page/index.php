<?php
require_once('../models/login/LoginClass.php');
require_once('../models/posts/PostsClass.php');
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login/index.php');
  exit;
}

isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : $user_id = null;
isset($_SESSION['user_name']) ? $user_name = $_SESSION['user_name'] : $user_name = null;
isset($_SESSION['user_email']) ? $email = $_SESSION['user_email'] : $email = null;

$postsClass = new PostsClass(null, null, $user_id);
$posts = $postsClass->getPosts($user_id);

?>

<?php require_once('../global/header.php') ?>

<main class="container">
  <div class="container pt-4 pb-4">
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
  </div>
  <!-- 投稿の一覧を表示 -->
  <div class="container pt-4 pb-4">
    <h3 class="fs-3">投稿一覧</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">タイトル</th>
          <th scope="col">内容</th>
          <th scope="col">投稿日時</th>
          <th scope="col">編集</th>
          <th scope="col">削除</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $post) { ?>
          <tr>
            <td><?php echo $post['title']; ?></td>
            <td><?php echo $post['content']; ?></td>
            <td><?php echo $post['created_at']; ?></td>
            <td><a href="../posts/edit.php?id=<?php echo $post['id']; ?>">編集</a></td>
            <td><a href="../posts/delete.php?id=<?php echo $post['id']; ?>">削除</a></td>
          </tr>
        <?php } ?>
      </tbody>
  </div>
</main>