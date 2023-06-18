<?php

require_once('../models/dbconnect.php');

class LoginClass  extends DBConnect
{

  private $email;
  private $password;

  public function __construct($email, $password)
  {
    $this->email = $email;
    $this->password = $password;
  }

  /**
   * ログイン処理
   * @param string $sql
   * @param string $email
   * @return void
   */
  public function loginUser($sql, $email, $password)
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->pdo()->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      if (password_verify($password, $result['password'])) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['name'];
        $_SESSION['user_email'] = $result['email'];
        header('Location: ../my_page/index.php');
        exit;
      } else {
        $_SESSION['error_message'] = 'メールアドレスまたはパスワードが間違っています。';
        header('Location: ./index.php');
        exit;
      }
    } else {
      $_SESSION['error_message'] = 'メールアドレスまたはパスワードが間違っています。';
      header('Location: ./index.php');
      exit;
    }
  }

  /**
   * ログアウト処理
   * @return void
   */
  public function logoutUser()
  {
    $_SESSION = array(
      'user_id' => '',
      'user_name' => '',
      'user_email' => '',
    );
    session_destroy();
    header('Location: ./index.php');
    exit;
  }
}
