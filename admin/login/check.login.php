<?php
require dirname(__DIR__) . "../../include/config.php";
require dirname(__DIR__) . "/inc/session.php";
include APP_ADM . "/inc/commFunction.php";
include APP_PATH . "/include/fn_post.php";
include APP_PATH . "/include/function.php";
include APP_PATH . "/include/md5.php";

//************************
//0：验证成功							**
//1：信息不完整			  		**
//2：用户名或密码不正确		**
//3：验证码不正确      		**
//4：用户被禁用						**
// ***********************

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $user = convert(getPost("u"));
  $pass = convert(getPost("p"));
  $code = convert(getPost("c"));

  if(strtolower($_SESSION["code"]) !== strtolower($code)) { exit("3"); }

  if(is_null($user) || $user == "" || is_null($pass) || $pass == ""){ exit("1"); }
  $sql = "select * from `admuser` where `username`='".$user."'";
  $result = $db->query($sql);
  if(mysqli_num_rows($result) == 0){
    exit("2");
  }else{
    while($rows = mysqli_fetch_array($result)){
      if($rows["password"] == md5str($pass)){
        if($rows["isallow"] == 0){
          exit("4");
        }else{
          $sql = "Update `user` set `last_ip`='".get_client_ip()."',`logintime`=".time()." where `username`='".$user."''";
          $db->query($sql);
          $_SESSION["id"] = $rows["id"];
          $_SESSION["username"] = $rows["username"];
          $_SESSION["truename"] = $rows["truename"];
          exit("0");
        }
      }else{
        exit("2");
      }
    }
  }
}else{
  exit("1");
}

?>