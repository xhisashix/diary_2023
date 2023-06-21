<?php

require_once('../models/user/UserClass.php');

$userClass = new UserClass();
$users = $userClass->getUsers();

?>

<?php require_once('../global/header.php') ?>

<div class="container d-flex">

  <div class="sidebar w-25 mr-5">
    <?php require_once('../global/sidebar.php') ?>
  </div>

  <main class="pt-4 pb-4 w-75">
    <h3 class="fs-3">ユーザー一覧</h3>
    <ul class="list-unstyled">
      <?php foreach ($users as $user) { ?>
        <li class="mt-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-2"><?php echo $user['name'] ?></h5>
              <p class="card-text"><?php echo $user['email'] ?></p>
              <a href="/posts/diary.php?user_id=<?php echo $user['id'] ?>" class="card-link">投稿をみる</a>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
  </main>
</div>

<?php require_once('../global/footer.php') ?>