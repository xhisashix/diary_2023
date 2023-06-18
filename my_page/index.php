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
          <th scope="col">作成日時</th>
          <th scope="col">更新日時</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $post) { ?>
          <tr id="post_<?php $post['id'] ?>">
            <td><?php echo $post['title']; ?></td>
            <td><?php echo $post['content']; ?></td>
            <td><?php echo $post['created_at']; ?></td>
            <td><?php echo $post['updated_at']; ?></td>
            <td>
              <button class="btn btn-primary">
                <a href="../posts/edit.php?id=<?php echo $post['id']; ?>" class="text-white">編集</a>
            </td>
            </button>
            <td>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
              <a href="../posts/delete.php?id=<?php echo $post['id']; ?>" class="text-white">削除</a>
              </button>

            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>