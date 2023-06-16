<?php
// head.phpを読み込み
require_once('head.php');
?>
<header>
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
            <a class="nav-link" href="/list">日報一覧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/post">日報投稿</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a name="" id="" class="btn btn-dark" href="/register/" role="button">新規登録</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>