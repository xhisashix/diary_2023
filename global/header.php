<?php
// head.phpを読み込み
require_once('head.php');

if (!isset($_SESSION)) {
  session_start();
}

?>
<header class="sticky-top">
  <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">日報投稿システム</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link cl-w" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/posts/list.php">日報一覧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/posts/create.php">日報投稿</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/users/list.php">ユーザー一覧</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if (!isset($_SESSION['user_id'])) { ?>
            <li class="nav-item ml-2">
              <a name="" id="" class="btn btn-dark" href="/register/" role="button">新規登録</a>
            </li>
            <li class="nav-item ml-2">
              <a name="" id="" class="btn btn-outline-light" href="/login/" role="button">ログイン</a>
            </li>
          <?php } else { ?>
            <li class="nav-item ml-2">
              <a name="" id="" class="btn btn-outline-light" href="/my_page/" role="button">マイページ</a>
            </li>
            <li class="nav-item ml-2">
              <form action="../login/logout.php" method="post">
                <button type="submit" class="btn btn-secondary">ログアウト</button>
              </form>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
</header>