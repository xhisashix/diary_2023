<?php

require_once('../models/posts/PostsClass.php');

$postsClass = new PostsClass(null, null, null);

// 投稿一覧を取得
$posts = $postsClass->getPosts();

?>

<?php require_once('../global/header.php') ?>

<div class="container d-flex">

  <div class="sidebar w-25 mr-5">
    <?php require_once('../global/sidebar.php') ?>
  </div>

  <main class="pt-4 pb-4 w-75">
    <h3 class="fs-3">投稿一覧</h3>
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
  </main>
</div>

<?php require_once('../global/footer.php') ?>