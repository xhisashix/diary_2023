<?php

require_once('../models/user/UserClass.php');

$usersClass = new UserClass();

// ログインのしているユーザーの情報を取得
$user = $usersClass->getUser($_SESSION['user_id']);

?>

<div class="mt-4" class="sticky-top">
    <nav class="sidebar">
      <div class="card">
        <div class="card-header">
          マイページ
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $user['name'] ?></h5>
          <a href="/my_page/index.php" class="btn btn-primary">マイページ</a>
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