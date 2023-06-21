<?php

require_once('../models/posts/PostsClass.php');
require_once('../models/user/UserClass.php');

$postsClass = new PostsClass(null, null, null);
$userClass = new UserClass();

if (!isset($_GET['user_id'])) {
  $_SESSION['error_message'] = 'ユーザーIDが指定されていません。';
  header('Location: ../users/list.php');
  exit;
}
$user_id = $_GET['user_id'];

// 投稿一覧を取得
$posts = $postsClass->getUserPostsByUserId($user_id);
$user = $userClass->getUser($user_id);

?>

<?php require_once('../global/header.php') ?>

<div class="container d-flex">

  <div class="sidebar w-25 mr-5">
    <?php require_once('../global/sidebar.php') ?>
  </div>

  <main class="pt-4 pb-4 w-75">
    <h3 class="fs-3"><?php echo $user['name'] ?>の投稿一覧</h3>
    <ul class="list-unstyled">
      <?php foreach ($posts as $post) { ?>
        <li class="mt-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-2"><?php echo $post['title'] ?></h5>
              <p class="card-text"><?php echo $post['content'] ?></p>
              <a href="/posts/detail.php?id=<?php echo $post['id'] ?>" class="card-link">詳細</a>
              <h6 class="card-subtitle mb-2 text-right"><?php echo $post['updated_at'] ?></h6>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
  </main>
</div>

<?php require_once('../global/footer.php') ?>