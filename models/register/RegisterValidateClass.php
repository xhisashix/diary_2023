<?php

class RegisterValidateClass
{
  public function __construct($email, $name, $password, $password_confirmation)
  {
    $this->validate($email, $name, $password, $password_confirmation);
  }

  /**
   * validate
   * @param string $email メールアドレス
   * @param string $name ユーザー名
   * @param string $password パスワード
   * @param string $password_confirmation パスワード（確認）
   * @return void session data
   */
  public function validate($email, $name, $password, $password_confirmation)
  {
    $error_message = [];

    // null check
    if (empty($email)) {
      $error_message['email'] = 'メールアドレスを入力してください。';
    }
    if (empty($name)) {
      $error_message['name'] = 'ユーザー名を入力してください。';
    }
    if (empty($password)) {
      $error_message['password'] = 'パスワードを入力してください。';
    }
    if (empty($password_confirmation)) {
      $error_message['password_confirmation'] = 'パスワード（確認）を入力してください。';
    }

    // validate name
    if ($password != $password_confirmation) {
      $error_message['password_confirmation'] = 'パスワードが一致しません。';
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_message['email'] = 'メールアドレスの形式が正しくありません。';
    }

    // validate password
    if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
      $error_message['password_format'] = 'パスワードは英数字8文字以上100文字以下にしてください。';
    }

    if (isset($error_message)) {
      // セッションのデータを前の画面に戻す
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $name;
      $_SESSION['password'] = $password;
      $_SESSION['password_confirmation'] = $password_confirmation;
      // エラーメッセージをセッションに保存
      $_SESSION['error_message'] = $error_message;

      return $_SESSION;
    }
  }
}
