<?php

require_once('../models/dbconnect.php');

class RegisterClass extends DBConnect
{

  public function __construct($email, $name, $password)
  {
  }

  public function createUser($sql, $name, $email, $password)
  {
    $password = $this->hashPassword($password);
    // usersテーブルにデータを登録
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
  }

  // パスワードをハッシュ化
  public function hashPassword($password)
  {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
  }

  /**
   * selectUser
   * @return array $users
   */
  public function selectUser()
  {
    // usersの情報をすべて取得
    $sql = "SELECT * FROM users";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }
}
