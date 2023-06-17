<?php
/* データベースに接続するクラス */
class DBConnect
{
  /* プロパティ(定数)の宣言 */
  const DB_NAME ='diary';
  const HOST    ='localhost';
  const UTF     ='utf8';
  const USER    ='root';
  const PASS    ='root';

  /* データベースに接続する メソッド(関数) */
  public function pdo(){
    $dsn  = "mysql:dbname=" .self::DB_NAME. "; host=" .self::HOST. "; charset=" .self::UTF;
    $user = self::USER;
    $pass = self::PASS;
    try{
      $pdo = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.SELF::UTF));
    }catch(Exception $e){
      echo 'エラー '.$e->getMessage;
      die();
    }
    return $pdo;
  }
}