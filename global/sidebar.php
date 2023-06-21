<?php

require_once('../models/user/UserClass.php');

$usersClass = new UserClass();

if (!isset($_SESSION['user_id'])) {
  $user['name'] = 'ゲスト';
} else {
  $user = $usersClass->getUser($_SESSION['user_id']);
}

?>

<div class="mt-4" class="sticky-top">
  <nav class="sidebar">
    <div class="card">
      <div class="card-header">
        マイページ
      </div>
      <div class="card-body">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle mb-3" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
          <h5 class="card-title"><?php echo $user['name'] ?></h5>
        </svg>
        <?php if(!isset($_SESSION['user_id'])) { ?>
          <a href="/register/index.php" class="btn btn-dark">新規登録</a>
        <?php } else { ?>
          <a href="/my_page/index.php" class="btn btn-primary">マイページ</a>
        <?php } ?>
      </div>
    </div>
    <ul class="nav flex-column mt-3">
      <li class="nav-item">
        <a class="nav-link active" href="/my_page/index.php">
          ホーム
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/my_page/posts/list.php">
          日報一覧
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/my_page/posts/create.php">
          日報投稿
        </a>
      </li>
    </ul>
  </nav>
</div>