<?php 

require_once('../models/dbconnect.php');

class UserClass extends DBConnect {

  /**
   * ユーザー情報を取得
   */
  public function getUser($user_id){
    $sql = "SELECT * FROM users WHERE id = :user_id";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

}

?>