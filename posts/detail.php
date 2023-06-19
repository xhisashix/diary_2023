<?php

require_once('../models/posts/PostsClass.php');

$postsClass = new PostsClass(null, null, null);

// idをもとに投稿を取得
$post = $postsClass->getPost($_GET['id']);

?>

<?php require_once('../global/header.php') ?>

<main class="container mt-4 mb-4">
  <table>
    <tr>
      <th>タイトル</th>
      <td><?php echo $post['title'] ?></td>
    </tr>
    <tr>
      <th>内容</th>
      <td><?php echo $post['content'] ?></td>
    </tr>
    <tr>
      <th>投稿者</th>
      <td><?php echo $post['name'] ?></td>
    </tr>
    <tr>
      <th>投稿日時</th>
      <td><?php echo $post['updated_at'] ?></td>
    </tr>
  </table>
</main>


<?php require_once('../global/footer.php') ?>