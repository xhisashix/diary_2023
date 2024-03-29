<?php

require_once('../models/dbconnect.php');

class PostsClass extends DBConnect
{

  private $title;
  private $content;
  private $user_id;

  public function __construct($title, $content, $user_id)
  {
    $this->title = $title;
    $this->content = $content;
    $this->user_id = $user_id;
  }

  /**
   * 日報投稿処理
   * @param string $sql
   * @param string $title
   * @param string $content
   * @param string $user_id
   * @return void
   */
  public function createPost($title, $content, $user_id)
  {
    $pdo = $this->pdo();
    $sql = "INSERT INTO posts (title, content, user_id, created_at, updated_at) VALUES (:title, :content, :user_id, :created_at, :updated_at)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->execute();

    // 登録したpostsテーブルのidを取得
    $id = $pdo->lastInsertId();

    $post_data = $this->getPost($id);

    // 日報詳細ページへ遷移するときに登録した情報も一緒に渡す
    $_SESSION['post_data'] = $post_data;
    header('Location: ./edit.php?id=' . $id);
    exit;
  }

  /**
   * 日報一覧取得処理
   * @param string $sql
   * @return array
   */
  public function getPosts()
  {
    // usersテーブルと結合
    $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * 日報詳細取得処理
   * @param string $sql
   * @param string $id
   * @return array
   */
  public function getPost($id)
  {
    $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * 日報編集処理
   * @param string $sql
   * @param string $title
   * @param string $content
   * @param string $id
   * @return void
   */
  public function updatePost($title, $content, $id)
  {
    $sql = "UPDATE posts SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->execute();

    // 更新成功のメッセージをセッションに格納
    $_SESSION['success'] = '正常に更新されました。';
    header('Location: ./edit.php?id=' . $id);
    exit;
  }

  /**
   * 日報削除処理
   * @param string $sql
   * @param string $id
   * @return void
   */
  public function deletePost($id)
  {
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: /my_page/index.php');
    exit;
  }

  /**
   * ユーザーの日報一覧取得処理
   * @param string $sql
   * @param string $user_id
   * @return array
   */
  public function getUserPosts($user_id)
  {
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  /**
   * 日報検索処理
   * @param string $sql
   * @param string $search_word
   * @return array
   */
  public function searchPosts($search_word)
  {
    $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE title LIKE :search_word OR content LIKE :search_word";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':search_word', '%' . $search_word . '%', PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * 特定のユーザーの日報を取得
   * @param string $sql
   * @param string $user_id
   * @return array
   */
  public function getUserPostsByUserId($user_id)
  {
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
