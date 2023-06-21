<?php

require_once('../models/posts/PostsClass.php');

$postsClass = new PostsClass(null, null, null);

//検索機能
if (isset($_GET['search_word'])) {
  $search_word = $_GET['search_word'];
  $posts = $postsClass->searchPosts($search_word);
} else {
  $posts = $postsClass->getPosts();
}

// 5件ずつページネーションする
$posts = array_chunk($posts, 5);

// ページネーションのページ数を取得
$page_count = count($posts);

// ページネーションの現在のページ数を取得
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// 現在のページ数の投稿一覧を取得
$posts = $posts[$page - 1];

?>

<?php require_once('../global/header.php') ?>

<div class="container d-flex">

  <div class="sidebar w-25 mr-5">
    <?php require_once('../global/sidebar.php') ?>
  </div>

  <main class="pt-4 pb-4 w-75">
    <h3 class="fs-3">投稿一覧</h3>
    <!-- 検索フォーム -->
    <div>
      <form action="./list.php" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="検索したいワードを入力してください" name="search_word">
          <button class="btn btn-primary ml-2" type="submit" id="button-addon2">検索</button>
        </div>
      </form>
    </div>
    <ul class="list-unstyled">
      <?php foreach ($posts as $post) { ?>
        <li class="mt-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-start align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <span class="card-title mb-0 ml-2"><?php echo $post['name'] ?></span>
              </div>
              <h5 class="card-title mt-2"><?php echo $post['title'] ?></h5>
              <p class="card-text"><?php echo $post['content'] ?></p>
              <a href="/posts/detail.php?id=<?php echo $post['id'] ?>" class="card-link">詳細</a>
              <h6 class="card-subtitle mb-2 text-right"><?php echo $post['updated_at'] ?></h6>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
    <!-- ページネーション -->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <!-- 先頭へ戻る -->
        <!-- 最初のページのときは非表示 -->
        <?php if ($page != 1) { ?>
          <li class="page-item"><a class="page-link" href="/posts/list.php?page=1">First</a></li>
        <?php } ?>
        <?php for ($i = 1; $i <= $page_count; $i++) { ?>
          <!-- 現在のページはリンクなし -->
          <?php if ($i == $page) { ?>
            <li class="page-item active"><a class="page-link" href="#"><?php echo $i ?></a></li>
            <?php continue; ?>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="/posts/list.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
          <?php } ?>
        <?php } ?>
        <!-- 最後へ進む -->
        <!-- 最後のページのときは非表示 -->
        <?php if ($page != $page_count) { ?>
          <li class="page-item"><a class="page-link" href="/posts/list.php?page=<?php echo $page_count ?>">Last</a></li>
        <?php } ?>
      </ul>
    </nav>
  </main>
</div>

<?php require_once('../global/footer.php') ?>